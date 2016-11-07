@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>編輯評論</h1>

        <form action="{{ route('comments.update', $comment->id) }}" method="post" role="form" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="form-group">
                <label for="description">類別描述</label>
                <textarea name="description" rows="4" cols="50"
                          class="form-control">{{ old('description') ?? $comment->description }}</textarea>
            </div>
            <div class="form-group">
                <input type="hidden" name="product_id" value="{{ $product_id }}">
                <input type="submit" value="更新" class="btn btn-default">
            </div>
        </form>
    </div>

@endsection