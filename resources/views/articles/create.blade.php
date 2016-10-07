@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <h1>建立文章</h1>
        <form action="{{ route('articles.store') }}" method="post" role="form" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">標題</label>
                <input type="text" name="title" class="form-control">
            </div>

            <div class="form-group">
                <label for="description">描述</label>
                <textarea name="description" rows="4" cols="50" placeholder="請輸入..." class="form-control"></textarea>
            </div>

            <div class="form-group">
                <input type="submit" value="建立" class="btn btn-default">
            </div>
        </form>
    </div>
@endsection