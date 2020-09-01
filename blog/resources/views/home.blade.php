@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <ul class="nav nav-tabs nav-fill nav-tag">
                <li class="nav-item nav-tag-item">
                    <a class="nav-link active" id="followings" href="{{ route('home', ['type' => 'followings'] )}}">{{ __('Followings') }}</a>
                </li>
                <li class="nav-item nav-tag-item">
                    <a class="nav-link" id="newest" href="{{ route('home', ['type' => 'newest'] )}}">{{ __('Newest') }}</a>
                </li>
            </ul>
        </div>
        <div class="col-md-2"></div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-2"></div>
        <div class="col-md-6"></div>
        <div class="col-md-2"></div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-2"></div>
        @if(count($posts))
        <div class="col-md-5">
            @foreach ($posts as $key => $post)
            <a href="{{ route('posts.show', $post->id) }}" class="post-item">
                <div class="flex-container mb-2">
                    <div class="article" style="flex-grow: 8">
                        <article>
                            <h4 id="title">{{ $post->title }}</h4>
                            <p>{{ $post->content }}</p>
                            <p id="author">{{ __('Author: ' . $post->user->full_name) }}</p>
                            <p id="last-update">{{ __('Last update: ' . $post->updated_at) }}</p>
                        </article>
                    </div>
                    <div style="flex-grow: 2" id="thumbnail-article">
                        <img src="{{ $post->thumbnail }}" alt="This is thumbnail image">
                    </div>
                </div>
            </a>
            @endforeach
            <div class="row justify-content-center margin-zero">
                {{ $posts->links() }}
            </div>
        </div>
        @else
        <div class="col-md-5 no-post">
            <p>{{ __('There are no posts') }}</p>
        </div>
        @endif
        <div class="col-md-2">
            <div class="card">
                <div class="card-header popular-header">
                    <h5>{{ __('Popular article') }}</h5>
                </div>
                <div class="card-body card-post">
                    @foreach ($popularPosts as $key => $popular)
                    <a href="{{ route('posts.show', $popular->id) }}" class="post-item">
                        <div class="popular-post">
                            <article>
                                <h5 id="title">{{ $popular->title }}</h5>
                                <p>{{ $popular->content }}</p>
                                <p id="author">{{ __('Author: ' . $popular->user->full_name) }}</p>
                            </article>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
@endsection
