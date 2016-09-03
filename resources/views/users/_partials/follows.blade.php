<div>
    <form action="{{ route('follows.sync', ['followable_type' => $type, 'followable_id' => $id]) }}" method="post">
        {{ csrf_field() }}
        <input type="submit" value="關注" class="btn btn-danger">
    </form>
</div>