@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Edit Category</h1>

        <form action="{{ route('categories.update', $category->id) }}" method="post" role="form" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="form-group">
                <label for="name">類別名稱</label>
                <input type="text" name="name" value="{{ $category->name }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="description">類別描述</label>
                <textarea name="description" rows="4" cols="50"
                          class="form-control">{{ $category->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="name">類別封面</label>
                <img src="{{ image_path($category->cover) }}" alt="">
                <input type="file" name="cover" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" value="更新" class="btn btn-default">
            </div>
        </form>
    </div>

@endsection