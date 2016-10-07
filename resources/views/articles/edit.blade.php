@extends('backend.layouts.app')

@section('content')

    <div class="container">
        <h1>編輯文章</h1>

        <form action="{{ route('articles.update', $article->id) }}" method="post" role="form" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="form-group">
                <label for="name">名稱</label>
                <input type="text" name="title" value="{{ $article->title }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="description">描述</label>
                <textarea name="description" rows="4" cols="50"
                          class="form-control">{{ $article->description }}</textarea>
            </div>

            <div class="form-group">
                <input type="submit" value="更新" class="btn btn-default">
            </div>
        </form>
    </div>

@endsection