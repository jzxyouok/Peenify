<form action="{{ route('permissions.destroy', $permission->id) }}" method="post">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <input type="submit" value="刪除" class="btn btn-danger">
</form>