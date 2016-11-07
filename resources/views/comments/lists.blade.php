<div class="comment_container col-centered">
    <h5>評論</h5>
    @foreach($comments = $product->paginateComments() as $comment)
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
                     class="emoji_comment fa fa-thumbs-{{ $comment->isEmoji(auth()->user(), 'like') ? 'up like__color' : 'o-up' }}"
                     data-type="comment" data-emoji="like" data-id={{ $comment->id }} data-token={{ csrf_token() }}>
                    <span class="amount">
                        {{ $comment->countEmoji('like') }}
                    </span>
                </div>

                <div id="bad_comment{{ $comment->id }}"
                     class="emoji_comment fa fa-thumbs-{{ $comment->isEmoji(auth()->user(), 'bad') ? 'down bad__color' : 'o-down' }}"
                     data-type="comment" data-emoji="bad" data-id={{ $comment->id }} data-token={{ csrf_token() }}>
                    <span class="amount">
                        {{ $comment->countEmoji('bad') }}
                    </span>
                </div>

                @if($comment->owns())
                    <a href="{{ route('comments.edit', [
                    'comment' => $comment,
                    'pid' => $product->id,
                    ]) }}">編輯</a>
                @endif

            @endif
        </div>
    @endforeach

    <div class="text-center">
        {!! $comments->links() !!}
    </div>
</div>