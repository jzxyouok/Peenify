<form action="{{ route('comments.store', ['commentable_type' => $commentable_type, 'commentable_id' => $commentable_id]) }}" method="post" role="form">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="description">為 {{ $relation->name }} 寫下評論...</label>
        <textarea name="description" rows="4" cols="50" placeholder="請輸入評論..." class="form-control"></textarea>
    </div>
    <div class="form-group">
        <input type="submit" value="評論" class="btn btn-default">
    </div>
</form>