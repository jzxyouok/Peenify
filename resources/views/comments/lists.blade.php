<div class="form-group">
    <h4>評論</h4>
    @foreach($product->comments as $comment)
        <p>{{ $comment->description }}</p>
        @if(auth()->check())
            <a class="btn btn-default" href="{{ route('comments.edit', $comment) }}">Edit</a>
            <div id="emoji" class="btn btn-{{ $comment->existEmojiByAuth('like') ? 'danger' : 'default' }}"
                 data-type="comment" data-emoji="like"
                 data-id={{ $comment->id }} data-token={{ csrf_token() }}> 喜歡
                （{{ $comment->countEmojis('like') }}）
            </div>

            <div id="emoji" class="btn btn-{{ $comment->existEmojiByAuth('bad') ? 'danger' : 'default' }}"
                 data-type="comment" data-emoji="bad"
                 data-id={{ $comment->id }} data-token={{ csrf_token() }}> 不喜歡
                （{{ $comment->countEmojis('bad') }}）
            </div>
        @endif
    @endforeach
</div>