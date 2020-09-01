<div class="comments">
    <h5 class="mb-2"><strong>Comments</strong></h5>
    <div class="comment-threads card p-2">
        @if (Auth::check())
            @include('post.comment_form')
        @else
        <div class="comment-no-login">
            <span>You can write comment after login.</span>
            <a href="{{ route('login', ['redirectUrl' => url()->full()]) }}">Click here!</a>
        </div>
        @endif
    </div>
    <div class="card mt-4">
        @if (count($comments) > 0)
        <div class="list-transition">
            @foreach ($comments as $comment)
            <div class="comment-thread-root p-3">
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
                    <span class="mr-05 reply" data-comment-id="{{ $comment->id }}">Reply</span>
                    @if (Auth::check() && $comment->user->id == Auth::user()->id)
                    <span class="mr-05 delete-comment ml-2" delete-url="{{ route('comments.destroy', $comment->id) }}">Delete</span>
                    @endif
                </footer>
                @if(!empty($replies[$comment->id]))
                @foreach ($replies[$comment->id] as $key => $reply)
                <div class="list-reply-transition pl-4 pt-2">
                    <hr>
                    <div class="reply-thread-root" parent-comment-id="{{ $comment->id }}">
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
                            @if (Auth::check() && $reply->user->id == Auth::user()->id)
                            <span class="mr-05 delete-reply" delete-url="{{ route('comments.destroy', $reply->id) }}">Delete</span>
                            @endif
                        </footer>
                    </div> 
                </div>
                @endforeach
                @endif
            </div> 
            @endforeach
        </div>
        @else
        <div class="no-comment">
            <i aria-hidden="true" class="fa fa-comment-o"></i>
            {{ __('No comments, yet') }}
        </div>
        @endif
    </div>
</div>

@auth
<script>
    $(document).on('click', '.reply', function () {
        let parentId = $(this).attr('data-comment-id');
            isFormExisted = document.querySelector('[form-id="' + parentId + '"]');

        if (isFormExisted) {
            return;
        }
        
        let commentForm = `<div class="reply-form m-2" form-id="${parentId}" reply-url="{{ route('comments.store') }}">
                                <div class="tabs">
                                    <div class="mt-3">
                                        <div class="tab-pane">
                                            <div class="row">
                                                <div class="col-md-1 owner-avatar">
                                                    <a href="{{ route('users.show', Auth::user()->id) }}"><img src="{{ Auth::user()->avatar }}" alt="User avatar"></a>
                                                </div>
                                                <div class="editor-line col-md-11">
                                                    <textarea class="reply-content p-2" rows="3" placeholder="Write comment..."></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane"></div>
                                        <div class="reply-form-action mt-2">
                                            <button type="button" class="btn btn-secondary discard-comment">Discard</button>
                                            <button type="button" class="btn btn-primary post-reply">Reply</button>
                                        </div>
                                    </div>
                                </div>
                            </div>`;

        $(this).parent().after(commentForm);
    });

    $(document).on('click', '.discard-comment', function () {
        $(this).closest('.reply-form').first().remove();
    });

    $('.post-comment').click(function () {
        let commentContent = $(this).closest('.comment-form').find('.comment-content').val();
            commentUrl = $(this).closest('.comment-form').attr('comment-url');
            noComment = $(this).closest('.comments').find('.no-comment');

        if (noComment.length) {
            let element = $('.comment-threads');
            firstComment(commentContent, commentUrl, element, noComment);
        } else {
            let element = $('.comment-thread-root').last();
            handleComment(commentContent, commentUrl, element);
        }
    });

    $(document).on('click', '.post-reply', function () {
        let replyContent = $(this).closest('.reply-form').first().find('.reply-content').val();
            replyUrl = $(this).closest('.reply-form').attr('reply-url');
            parentCommentId = $(this).closest('.reply-form').attr('form-id');
            element = $(this).closest('.comment-thread-root').first().find('.list-reply-transition').last();

            if (!element.length) {
                element = $(this).closest('.comment-thread-root').first().find('footer');
            }
            replyForm = $(this).closest('.reply-form').first();

        handleComment(replyContent, replyUrl, element, replyForm, parentCommentId);
    });

    function firstComment (content, commentUrl, element, noComment) {
        if (content == "") {
            return;
        }
        
        let data = {
                user_id:"{{ Auth::user()->id }}",
                post_id:"{{ $post->id }}",
                content: content
            };

        $.ajax ({
            url: commentUrl,
            type: 'POST',
            data: {
                comment: data
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (result) {
                if (!result.success) return;
                let comment = result.success;
                    commentHtml = `<div class="card mt-4">
                                        <div class="list-transition">
                                            <div class="comment-thread-root p-3">
                                                <header class="d-flex flex-wrap justify-content-between">
                                                    <div class="user--inline d-inline-flex flex-shrink-0 commenter-avatar">
                                                        <a href="#" class="d-flex mr-1">
                                                            <img src="{{ Auth::user()->avatar }}" alt="User avatar">
                                                        </a>
                                                        <span>
                                                            <a href="#">{{ Auth::user()->display_name }}</a>
                                                        </span>
                                                    </div>
                                                    <div class="comment-meta word-break">
                                                        <span class="text-muted">${comment.updated_at }</span>
                                                    </div>
                                                </header>
                                                <div class="md-contents mt-2">
                                                    <p>${comment.content}</p>
                                                </div>
                                                <footer class="d-flex text-muted">
                                                    <span class="mr-05 reply" data-comment-id="${comment.id}">Reply</span>
                                                    <span class="mr-05 delete-comment ml-2" delete-url="${comment.delete_url}">Delete</span>
                                                </footer>
                                            </div> 
                                        </div>
                                    </div>`;

                element.after(commentHtml);
                $('.comment-content').val('');
                noComment.parent().remove();
            },
        });
    }

    function handleComment (content, commentUrl, element, form = null, parentCommentId = null) {
        if (content == "") {
            return;
        }
        
        let data = {
                user_id:"{{ Auth::user()->id }}",
                post_id:"{{ $post->id }}",
                content: content
            };
        if (parentCommentId != null) {
            data["parentCommentId"] = parentCommentId;
        }

        $.ajax ({
            url: commentUrl,
            type: 'POST',
            data: {
                comment: data
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (result) {
                if (!result.success) return;
                
                let html='';
                    comment = result.success;

                if (parentCommentId != null) {
                    html = `<div class="list-reply-transition pl-4 pt-2">
                                <hr>
                                <div class="reply-thread-root" parent-comment-id="${parentCommentId}">
                                    <header class="d-flex flex-wrap justify-content-between">
                                        <div class="user--inline d-inline-flex flex-shrink-0 commenter-avatar">
                                            <a href="#" class="d-flex mr-1">
                                                <img src="{{ Auth::user()->avatar }}" alt="User avatar">
                                            </a>
                                            <span>
                                                <a href="#">{{ Auth::user()->display_name }}</a>
                                            </span>
                                        </div>
                                        <div class="comment-meta word-break">
                                            <span class="text-muted">${comment.updated_at}</span>
                                        </div>
                                    </header>
                                    <div class="md-contents mt-2">
                                        <p>${comment.content}</p>
                                    </div>
                                    <footer class="d-flex text-muted">
                                        <span class="mr-05 delete-reply" delete-url="${comment.delete_url}">Delete</span>
                                    </footer>
                                </div>
                            </div>`;
                    
                    if (form != null) {
                        form.remove();
                    }
                } else {
                    html =  `<div class="comment-thread-root p-3">
                                <header class="d-flex flex-wrap justify-content-between">
                                    <div class="user--inline d-inline-flex flex-shrink-0 commenter-avatar">
                                        <a href="#" class="d-flex mr-1">
                                            <img src="{{ Auth::user()->avatar }}" alt="User avatar">
                                        </a>
                                        <span>
                                            <a href="#">{{ Auth::user()->display_name }}</a>
                                        </span>
                                    </div>
                                    <div class="comment-meta word-break">
                                        <span class="text-muted">${comment.updated_at}</span>
                                    </div>
                                </header>
                                <div class="md-contents mt-2">
                                    <p>${comment.content}</p>
                                </div>
                                <footer class="d-flex text-muted">
                                    <span class="mr-05 reply" data-comment-id="${comment.id}">Reply</span>
                                    <span class="mr-05 delete-comment ml-2" delete-url="${comment.delete_url}">Delete</span>
                                </footer>
                            </div>`;

                    $('.comment-content').val('');
                }
                element.after(html);
            },
        });
    }

    $(document).on('click', '.delete-comment', function () {
        let deleteUrl = $(this).attr('delete-url');
            element = $(this).closest('.comment-thread-root').first();

            deleteComment(deleteUrl, element);
    });

    $(document).on('click', '.delete-reply', function () {
        let deleteUrl = $(this).attr('delete-url');
            element = $(this).closest('.reply-thread-root').first();

            deleteComment(deleteUrl, element);
    });

    function deleteComment (deleteUrl, element) {
        let isConfirm = confirm("Are you sure to delete this comment?");

        if (isConfirm) {     
            $.ajax ({
                url: deleteUrl,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (result) {
                    if (result.success) {
                        element.remove();
                    }
                },
            });
        }
    }
</script>
@endauth
