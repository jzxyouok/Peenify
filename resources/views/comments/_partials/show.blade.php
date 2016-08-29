<div>
    <h4>Comments</h4>
    @foreach($comments as $comment)
        <p>{{ $comment->description }}</p>
    @endforeach
</div>