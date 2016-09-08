@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Product</h1>
        <form action="{{ route('products.store') }}" method="post" role="form" enctype="multipart/form-data">
            <h3>Choose Category</h3>
            <select name="category_id">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">產品名稱</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="description">產品描述</label>
                <textarea name="description" rows="4" cols="50" placeholder="請輸入產品描述..."
                          class="form-control"></textarea>
            </div>
            {{--<div class="form-group">--}}
            {{--<label for="name">產品網址</label>--}}
            {{--<input type="text" name="site" class="form-control">--}}
            {{--</div>--}}
            <div class="form-group">
                <label for="name">產品封面</label>
                <input type="file" name="cover" class="form-control">
            </div>
            <div class="form-group">
                <label for="name">Tags</label>
                <select name="tags[]" id="tags" class="form-control">

                </select>
            </div>
            <div class="form-group">
                <input type="submit" value="建立" class="btn btn-default">
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        $('#tags').select2({
            tags: true,
            multiple: true,
            ajax: {
                url: '/api/tags/ajaxTags',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        term: params.term,
                    };
                },
                processResults: function (data, params) {
                    return {
                        results: $(data).map(function (index, text) {
                            return {
                                id: text,
                                text: text
                            }
                        }).get()
                    };
                },
                cache: true
            }
        });
    </script>
@endsection