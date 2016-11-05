@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">修改個人資料</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('users.update') }}"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group">
                            <img class="avatar img-responsive" src="{{ ($user->avatar) ? image_path('avatars.users', $user->avatar):'holder.js/300x300' }}">
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">大頭貼</label>

                            <div class="col-md-6">
                                <input type="file" name="avatar" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">名稱</label>

                            <div class="col-md-6">
                                <input type="text" name="name" value="{{ old('name') ?? $user->name }}" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">簡介</label>

                            <div class="col-md-6">
                                <textarea name="description" rows="4" cols="50"
                                          class="form-control">{{ old('description') ?? $user->description }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-default">
                                    更新
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection