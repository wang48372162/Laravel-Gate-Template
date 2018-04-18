<?php

namespace App\Http\Controllers;

use Auth;
use Gate;
use App\Post;
use App\Http\Requests\StorePostRequest as StorePostRequest;
use App\Http\Requests\UpdatePostRequest as UpdatePostRequest;
use App\Services\FuncService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $func;

    public function __construct(FuncService $funcService)
    {
        $this->func = $funcService;
    }

    private function getPostSlug($slug)
    {
        return Post::where('slug', $slug)->first();
    }

    public function index()
    {
        $posts = Post::published()->latest()->paginate();
        return view('posts.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = $this->getPostSlug($slug);
        if ($post->published || $post->user_id == @Auth::user()->id) {
            return view('posts.show', compact('post'));
        }
        abort(403, 'Unauthorized.');
    }

    public function drafts()
    {
        $postsQuery = Post::unpublished();
        if (Gate::denies('see-all-drafts')) {
            $postsQuery = $postsQuery->where('user_id', Auth::user()->id);
        }
        $posts = $postsQuery->paginate();
        return view('posts.drafts', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->only('title', 'body');
        $data['slug'] = $this->func->slug($data['title']);
        $data['user_id'] = Auth::user()->id;
        $post = Post::create($data);
        return redirect()->route('show_post', ['slug' => $post->slug]);
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Post $post, UpdatePostRequest $request)
    {
        $data = $request->only('title', 'body');
        $data['slug'] = $this->func->slug($data['title']);
        $post->fill($data)->save();
        return redirect()->route('show_post', ['slug' => $post->slug]);
    }

    public function publish(Post $post)
    {
        $post->published = true;
        $post->save();
        return redirect()->route('show_post', ['slug' => $post->slug]);
    }

    public function unpublish(Post $post)
    {
        $post->published = false;
        $post->save();
        return back();
    }

    public function destory(Post $post)
    {
        $post->delete();
        return redirect()->route('list_posts');;
    }
}
