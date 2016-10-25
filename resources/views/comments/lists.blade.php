<div class="comment_container col-centered">
    <h5>評論</h5>
    @foreach($product->comments as $comment)
        <div class="Comment__box">
            <span style="margin: auto">
                <img class="Comment__avatar" src="{{ ($comment->user->avatar) ? image_path('avatars.users', $comment->user->avatar):'holder.js/20x20' }}">
                {{ $comment->user->name }}
            </span>
            <div class="Comment__description">
                {{ $comment->description }}
            </div>
            @if(auth()->check())
                <div id="like_comment{{ $comment->id }}"
                     class="emoji_comment glyphicon glyphicon-thumbs-up{{ $comment->isEmoji(auth()->user(), 'like') ? ' like__color' : '' }}"
                     data-type="comment" data-emoji="like" data-id={{ $comment->id }} data-token={{ csrf_token() }}>
                    <span class="amount">
                        {{ $comment->countEmoji('like') }}
                    </span>
                </div>

                <div id="bad_comment{{ $comment->id }}"
                     class="emoji_comment glyphicon glyphicon-thumbs-down{{ $comment->isEmoji(auth()->user(), 'bad') ? ' bad__color' : '' }}"
                     data-type="comment" data-emoji="bad" data-id={{ $comment->id }} data-token={{ csrf_token() }}>
                    <span class="amount">
                        {{ $comment->countEmoji('bad') }}
                    </span>
                </div>

                @if($comment->owns())
                    <a href="{{ route('comments.edit', $comment) }}">編輯</a>
                @endif
            @endif
        </div>
    @endforeach
</div>