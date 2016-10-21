<style>
    .emoji_comment {
        cursor: pointer;
        padding: auto;
        margin-right: 10px;
    }

    .comment_box {
        border: 1px solid #ccc;
        margin-bottom: 10px;
        padding: 10px 10px;
    }

    .col-centered {
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
            <span style="margin: auto">
                <img style="width: 20px;height: 20px; border-radius: 20px 20px"
                         src="{{ ($comment->user->avatar) ? image_path('avatars.users', $comment->user->avatar):'holder.js/20x20' }}">
                {{ $comment->user->name }}
            </span>
            <div style="padding: 10px 10px">
                {{ $comment->description }}
            </div>
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