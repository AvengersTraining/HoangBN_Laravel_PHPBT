@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <div class="card">
                <div class="card-header">Actions</div>
                <div class="card-body">
                    <ul class="nav nav-pills flex-column nav-justified">
                        <li class="nav-item nav-tag-item">
                            <a class="nav-link active" id="drafts" href="{{ route('posts.index', ['type' => 'drafts'] )}}">{{ __('Drafts') }}</a>
                        </li>
                        <li class="nav-item nav-tag-item mt-2">
                            <a class="nav-link" id="publish" href="{{ route('posts.index', ['type' => 'publish'] )}}">{{ __('Public') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div></div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">{{ __('Type') }}</div>
                <div class="card-body">
                    @foreach ($posts as $key => $post)
                    <div class="d-flex">
                        <div class="post-items mb-2 mr-2">
                            <div>
                                <h6>
                                    <a href="{{ route('posts.show', $post->id) }}"><span>{{ $post->title }}</span></a>
                                </h6>
                                @foreach ($post->tags as $key => $tag)
                                <span class="tags">
                                    <span href="#" class="tag-items ml-1">{{ $tag->tag_name }}</span>
                                </span>
                                @endforeach
                            </div>
                            <div class="d-flex">
                                <div class="text-muted">
                                    <span>{{ __('Last edit: ') . $post->updated_at }}</span>
                                    <div class="el-dropdown">
                                        <i class="el-dropdown"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="post-action">
                            <a id="navbarDropdown" class="icon-action fa fa-ellipsis-v" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('posts.edit', $post->id) }}">{{ __('Edit') }}</a>
                                <a class="dropdown-item" href="#">{{ __('Delete') }}</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
@endsection
