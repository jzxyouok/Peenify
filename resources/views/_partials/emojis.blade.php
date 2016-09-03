<div>
    <form action="{{ route('emojis.sync', ['emojiable_type' => $type, 'emojiable_id' => $relation->id]) }}" method="post">
        {{ csrf_field() }}
        <h3>Like: {{ $relation->emojis()->where('type', 'like')->count() }}</h3>
        <h3>Normal: {{ $relation->emojis()->where('type', 'normal')->count() }}</h3>
        <h3>Bad: {{ $relation->emojis()->where('type', 'bad')->count() }}</h3>
        <input type="radio" name="type" value="like"> Like <br />
        <input type="radio" name="type" value="normal"> Normal <br />
        <input type="radio" name="type" value="bad"> Bad <br />
        <input type="submit" value="評分" class="btn btn-danger">
    </form>
</div>