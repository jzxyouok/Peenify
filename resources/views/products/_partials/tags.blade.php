<style>
    .tag {
        background: rgba(0, 0, 0, 0.0470588);
        color: rgba(0, 0, 0, 0.6);
        text-decoration: none;
        -webkit-tap-highlight-color: transparent;
        cursor: pointer;
        display: inline-block;
        margin-right: 0px;
        margin-bottom: 8px;
        position: relative;
        border-radius: 3px;
        padding: 5px 10px;
        line-height: 22px;
        font-size: 13px;
        letter-spacing: 0px;
        border: none;
    }
</style>

<div class="text-center" style="padding: 0.5em 0.5em;font-size: 12px; letter-spacing: 0px;">
    @foreach($product->tags as $tag)
        <a class="tag" href="{{ route('tags.show', $tag->id) }}">
            {{ $tag->name }}
        </a>
    @endforeach
</div>