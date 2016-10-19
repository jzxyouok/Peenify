<style>
    .emoji_comment {

    }

    .comment_box {

    }
</style>

<div class="form-group">
    <h4>評論</h4>
    @foreach($product->comments as $comment)
        <p>{{ $comment->description }}</p>
        <p>{{ $comment->user->name }}</p>
        @if(auth()->check())
            @if($comment->owns())
                <a class="btn btn-default" href="{{ route('comments.edit', $comment) }}">編輯</a>
            @endif
                <div class="comment_box">
                    <div id="like_comment{{ $comment->id }}" class="emoji_comment glyphicon glyphicon-thumbs-up{{ $comment->isEmoji(auth()->user(), 'like') ? ' Favorite__heart__color' : '' }}"
                         data-type="comment" data-emoji="like" data-id={{ $comment->id }} data-token={{ csrf_token() }}>
                    <span class="amount">
                        {{ $comment->countEmoji('like') }}
                    </span>
                    </div>

                    <div id="bad_comment{{ $comment->id }}" class="emoji_comment glyphicon glyphicon-thumbs-up{{ $comment->isEmoji(auth()->user(), 'bad') ? ' Favorite__heart__color' : '' }}"
                         data-type="comment" data-emoji="bad" data-id={{ $comment->id }} data-token={{ csrf_token() }}>
                    <span class="amount">
                        {{ $comment->countEmoji('bad') }}
                    </span>
                    </div>
                </div>
        @endif
    @endforeach
</div>