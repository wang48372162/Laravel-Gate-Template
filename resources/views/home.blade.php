@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (Auth::check())
                        <h1 class="text-center">Hello! {{ Auth::user()->name }}</h1>
                    @else
                        <h1 class="text-center">歡迎光臨 {{ config('app.name') }}</h1>
                        <h4 class="text-center">更多<a href="{{ route('list_posts') }}">文章</a>...</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
