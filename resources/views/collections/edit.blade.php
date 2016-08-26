@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Edit Collection</h1>
        <form action="{{ route('collections.update', $collection->id) }}" method="post" role="form" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="form-group">
                <label for="name">名稱</label>
                <input type="text" name="name" value="{{ $collection->name }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="description">描述</label>
                <textarea name="description" rows="4" cols="50"
                          class="form-control">{{ $collection->description }}</textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="更新" class="btn btn-default">
            </div>
        </form>
    </div>

@endsection