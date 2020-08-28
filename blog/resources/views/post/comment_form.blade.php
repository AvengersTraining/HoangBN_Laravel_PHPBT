<div class="comment-form" comment-url="{{ route('comments.store') }}">
    <div class="tabs">
        <div class="mt-3">
            <div class="tab-pane">
                <div class="row">
                    <div class="col-md-1 owner-avatar">
                        <a href="{{ route('users.show', Auth::user()->id) }}"><img src="{{ Auth::user()->avatar }}" alt="User avatar"></a>
                    </div>
                    <div class="editor-line col-md-11">
                        <textarea class="comment-content p-2" rows="3" placeholder="Write comment..."></textarea>
                    </div>
                </div>
            </div>
            <div class="comment-form-action mt-2">
                <button type="button" class="btn btn-primary post-comment">Post comment</button>
            </div>
        </div>
    </div>
</div>
