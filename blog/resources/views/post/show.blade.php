@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="post-vote">
            <div class="container">
                <div class="col-md-1">
                    <div class="votes" post-vote-url="{{ route('posts.vote', $post->id) }}">
                        <button class="btn voted {{ (!empty($userVoted) && $userVoted->pivot->type) ? 'voted-btn' : ''}}" id="up-vote"><i class="fa fa-caret-up"></i></button>
                        <div class="points-vote {{ !empty($userVoted) ? 'voted-btn' : '' }}">{{ $totalVote }}</div>
                        <button class="btn voted {{ (!empty($userVoted) && !$userVoted->pivot->type) ? 'voted-btn' : ''}}" id="down-vote"><i class="fa fa-caret-down"></i></button>
                    </div>
                </div>
                <div class="col-md-7"></div>
                <div class="col-md-4"></div>
            </div>
        </div>
        <div class="card col-md-6 offset-md-3">
            <div>
                <h3>{{ $post->title }}</h3>
            </div>

            <div class="post-tags">
                @foreach ($tags as $key => $tag)
                <a href="#" class="tag-items">{{ $tag->tag_name }}</a>
                @endforeach
            </div>

            <div class="row author-post mt-4">
                <div class="col-md-1 user-avatar">
                    <img src="{{ $post->user->avatar }}" alt="Avatar">
                </div>
                <div class="col-md-10 author-detail">
                    <a href="{{ route('users.show', $post->user->id) }}" class="author-name">{{ $post->user->full_name }}</a>
                    <p>{{ $post->created_at }}</p>
                </div>
            </div>

            <div class="post-detail-thumbnail mt-2">
                <img src="{{ $post->thumbnail }}" alt="This is a thumbnail">
            </div>

            <div class="content-detail mt-2">
                <p>{{ $post->content }}</p>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>

    <div class="row justify-content-center mt-5">
        <div class="col-md-1"></div>
        <div class="col-md-7">
            @include('post.comment')
        </div>
        <div class="col-md-1"></div>
    </div>
</div>
@endsection
