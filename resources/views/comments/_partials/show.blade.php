<div>
    <h4>Comments</h4>
    @foreach($comments as $comment)
        <p>{{ $comment->description }}</p>
        <a href="{{ route('comments.edit', $comment) }}">Edit</a>
    @endforeach
</div>