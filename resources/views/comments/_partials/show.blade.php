<div>
    <h4>Comments</h4>
    @foreach($comments as $comment)
        <p>{{ $comment->description }}</p>
{{--        <a href="{{ route('comments.edit', [$comment->id, 'pid' => $product_id]) }}">編輯評論</a>--}}
    @endforeach
</div>