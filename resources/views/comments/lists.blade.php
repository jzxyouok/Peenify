<div class="form-group">
    <h4>評論</h4>
    @foreach($product->comments as $comment)
        <p>{{ $comment->description }}</p>
        <p>{{ $comment->user->name }}</p>
        @if(auth()->check())
            @if($comment->owns())
                <a class="btn btn-default" href="{{ route('comments.edit', $comment) }}">編輯</a>
            @endif
            <div id="emoji" class="btn btn-{{ $comment->isEmoji(auth()->user(), 'like') ? 'danger' : 'default' }}"
                 data-type="comment" data-emoji="like"
                 data-id={{ $comment->id }} data-token={{ csrf_token() }}> 喜歡
                （{{ $comment->countEmoji(auth()->user(), 'like') }}）
            </div>

            <div id="emoji" class="btn btn-{{ $comment->isEmoji(auth()->user(), 'bad') ? 'danger' : 'default' }}"
                 data-type="comment" data-emoji="bad"
                 data-id={{ $comment->id }} data-token={{ csrf_token() }}> 不喜歡
                （{{ $comment->countEmoji(auth()->user(), 'bad') }}）
            </div>
        @endif
    @endforeach
</div>