<div>
    <h4>Comments</h4>
    @foreach($comments as $comment)
        <p>{{ $comment->description }}</p>
        <a href="{{ route('comments.edit', $comment) }}">Edit</a>

        @include('_partials.emojis', [
        'relation' => $comment,
        'type' => 'comment',
        'emoji' => 'like',
        'icon' => '&#x1F44D;',
        ])

        @include('_partials.emojis', [
        'relation' => $comment,
        'type' => 'comment',
        'emoji' => 'normal',
        'icon' => '&#x1F466;',
        ])

        @include('_partials.emojis', [
        'relation' => $comment,
        'type' => 'comment',
        'emoji' => 'bad',
        'icon' => '&#x1F44E;',
        ])

    @endforeach
</div>