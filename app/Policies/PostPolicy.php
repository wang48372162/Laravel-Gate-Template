<?php

namespace App\Policies;

use App\User;
use App\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return $user->hasAccess('create-post');
    }

    public function update(User $user, Post $post)
    {
        return $user->hasAccess('update-post') or $user->id == $post->user_id;
    }

    public function publish(User $user, Post $post)
    {
        return $user->hasAccess('publish-post') or $user->id == $post->user_id;
    }

    public function delete(User $user, Post $post)
    {
        return $user->hasAccess('delete-post') or $user->id == $post->user_id;
    }

    public function drafts(User $user)
    {
        return $user->inRole('editor');
    }
}
