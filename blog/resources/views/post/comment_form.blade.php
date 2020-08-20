<div class="comment-form">
    <div class="tabs">
        <ul class="nav nav-tabs nav-fill nav-tag">
            <li class="nav-item nav-tag-item">
                <div class="nav-link tab-comment active">{{ __('Write') }}</div>
            </li>
            <li class="nav-item nav-tag-item">
                <div class="nav-link tab-comment">{{ __('Preview') }}</div>
            </li>
        </ul>
        <div class="mt-3">
            <div class="tab-pane">
                <div class="comment-form-write row">
                    <div class="col-md-1 owner-avatar">
                        <a href="{{ route('users.show', $post->user->id) }}"><img src="{{ $post->user->avatar }}" alt="User avatar"></a>
                    </div>
                    <div class="editor-line col-md-11">
                        <textarea class="comment-content p-2" rows="3" placeholder="Write comment..."></textarea>
                    </div>
                </div>
            </div>
            <div class="tab-pane"></div>
            <div class="comment-form-action mt-2">
                <button type="button" class="btn btn-primary">Post comment</button>
            </div>
        </div>
    </div>
</div>
