@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    草稿 <a class="btn btn-sm btn-default pull-right" href="{{ route('list_posts') }}">返回</a>
                </div>

                <div class="panel-body">
                    <div class="row">
                    @foreach($posts as $post)
                        <div class="col-sm-6 col-md-4">
                            <div class="thumbnail">
                            <div class="caption">
                                <h3><a href="{{ route('show_post', ['slug' => $post->slug]) }}">{{ $post->title }}</a></h3>
                                <p>{{ str_limit($post->body, 50) }}</p>
                                <p>
                                @can('publish-post', $post)
                                    <a href="{{ route('publish_post', ['post' => $post->id]) }}" class="btn btn-default" role="button">發布</a> 
                                @endcan
                                    <a href="{{ route('edit_post', ['post' => $post->id]) }}" class="btn btn-default" role="button">修改</a> 
                                </p>
                            </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection