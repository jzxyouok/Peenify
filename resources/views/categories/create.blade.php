@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <div class="text-center">
            <h2>建立分類</h2>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <form action="{{ route('categories.store') }}" method="post" role="form" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">類別名稱</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="description">類別描述</label>
                        <textarea name="description" rows="4" cols="50" placeholder="請輸入類別描述..."
                                  class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="name">類別封面</label>
                        <input type="file" name="cover" class="form-control">
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" value="建立" class="btn btn-default">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection