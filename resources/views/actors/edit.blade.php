@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Edit Actor</h1>

        <form action="{{ route('actors.update', $actor->id) }}" method="post" role="form" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="form-group">
                <label for="name">類別名稱</label>
                <input type="text" name="name" value="{{ $actor->name }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="description">類別描述</label>
                <textarea name="description" rows="4" cols="50"
                          class="form-control">{{ $actor->description }}</textarea>
            </div>

            <div class="form-group">
                <input type="radio" name="gender" value="male" {{ ($actor->gender == 'male') ? 'checked' : ''}}> 男 <br />
                <input type="radio" name="gender" value="female" {{ ($actor->gender == 'female') ? 'checked' : ''}}> 女 <br />
            </div>
            <div class="form-group">
                國家：<input type="text" name="country" class="form-control" value="{{ $actor->country }}">
            </div>

            <div class="form-group">
                <input type="submit" value="更新" class="btn btn-default">
            </div>
        </form>
    </div>

@endsection