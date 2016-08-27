@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Edit User</h1>
        <form action="{{ route('users.update') }}" method="post" role="form" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="form-group">
                <label for="name">名稱</label>
                <input type="text" name="name" value="{{ $user->name }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="description">描述</label>
                <textarea name="description" rows="4" cols="50"
                          class="form-control">{{ $user->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="name">大頭貼</label>
                <img src="{{ !$user->avatar ?: image_path('avatar.user', $user->id, $user->avatar) }}">
                <input type="file" name="avatar" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" value="更新" class="btn btn-default">
            </div>
        </form>
    </div>

@endsection