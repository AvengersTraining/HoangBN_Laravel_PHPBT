<div class="comments">
    <h5 class="mb-2"><strong>Comments</strong></h5>
    <div class="comment-threads card p-2">
        @include('post.comment_form')
    </div>
    <div class="card mt-4">
        @if (count($comments) > 0)
        @foreach ($comments as $comment)
        <div class="list-transition p-3">
            <div class="comment-thread-root">
                <header class="d-flex flex-wrap justify-content-between">
                    <div class="user--inline d-inline-flex flex-shrink-0 commenter-avatar">
                        <a href="#" class="d-flex mr-1">
                            <img src="{{ $comment->user->avatar }}" alt="User avatar">
                        </a>
                        <span>
                            <a href="#">{{ $comment->user->display_name }}</a>
                        </span>
                    </div>
                    <div class="comment-meta word-break">
                        <span class="text-muted">{{ $comment->updated_at }}</span>
                    </div>
                </header>
                <div class="md-contents mt-2">
                    <p>{{  $comment->content }}</p>
                </div>
                <footer class="d-flex text-muted">
                    <a class="mr-05 cursor-pointer">Reply</a>
                    @if ($comment->user->id == Auth::user()->id)
                    <a class="mr-05 cursor-pointer ml-2">Delete</a>
                    @endif
                </footer>
                @if(!empty($replies[$comment->id]))
                @foreach ($replies[$comment->id] as $key => $reply)
                <div class="list-transition pl-4 pt-2">
                    <hr>
                    <div class="comment-thread-root">
                    <header class="d-flex flex-wrap justify-content-between">
                        <div class="user--inline d-inline-flex flex-shrink-0 commenter-avatar">
                            <a href="#" class="d-flex mr-1">
                                <img src="{{ $reply->user->avatar }}" alt="User avatar">
                            </a>
                            <span>
                                <a href="#">{{ $reply->user->display_name }}</a>
                            </span>
                        </div>
                        <div class="comment-meta word-break">
                            <span class="text-muted">{{ $reply->updated_at }}</span>
                        </div>
                    </header>
                    <div class="md-contents mt-2">
                        <p>{{  $reply->content }}</p>
                    </div>
                    <footer class="d-flex text-muted">
                        <a class="mr-05 cursor-pointer">Reply</a>
                        @if ($reply->user->id == Auth::user()->id)
                        <a class="mr-05 cursor-pointer ml-2">Delete</a>
                        @endif
                    </footer>
                    </div> 
                </div>
                @endforeach
                @endif
            </div> 
        </div>
        <hr>
        @endforeach
        @else
        <div class="commented">
            <i aria-hidden="true" class="fa fa-comment-o"></i>
            {{ __('No comments, yet') }}
        </div>
        @endif
    </div>
</div>
