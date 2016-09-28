@inject('permissions', 'App\Services\PermissionService')

<h3>選擇權限</h3>
@foreach($permissions->all() as $permission)
    <input class="form-group" name="permissions[]" type="checkbox" value="{{ $permission->id }}">
    <div>{{ $permission->name }}</div>
@endforeach