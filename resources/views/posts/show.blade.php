@inject('pr', 'App\Presenters\AppPresenter')

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ $post->title }}

                    @can('update-post', $post)
                        <a href="{{ route('edit_post', ['post' => $post->id]) }}" class="pull-right btn btn-sm btn-default" role="button">修改</a> 
                    @endcan
                </div>

                <div class="panel-body">
                    {!! $pr->parsedown($post->body) !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
