<style>
    .emoji_comment {
        cursor: pointer;
    }

    .comment_box {
        border: 1px solid #ccc;
        margin-bottom: 10px;
        padding: 10px 10px;
    }

    .col-centered{
        float: none;
        margin: 0 auto;
        max-width: 500px;
    }

    .comment_container {
        position: relative;
        min-height: 1px;
    }
</style>

<div class="comment_container col-centered">
    <h5>評論</h5>
    @foreach($product->comments as $comment)
        <div class="comment_box">
            <p>{{ $comment->user->name }}</p>
            <p>{{ $comment->description }}</p>
            @if(auth()->check())
                <div id="like_comment{{ $comment->id }}"
                     class="emoji_comment glyphicon glyphicon-thumbs-up{{ $comment->isEmoji(auth()->user(), 'like') ? ' Favorite__heart__color' : '' }}"
                     data-type="comment" data-emoji="like" data-id={{ $comment->id }} data-token={{ csrf_token() }}>
                    <span class="amount">
                        {{ $comment->countEmoji('like') }}
                    </span>
                </div>

                <div id="bad_comment{{ $comment->id }}"
                     class="emoji_comment glyphicon glyphicon-thumbs-up{{ $comment->isEmoji(auth()->user(), 'bad') ? ' Favorite__heart__color' : '' }}"
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