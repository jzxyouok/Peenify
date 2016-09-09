@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>編輯產品</h1>
        <form action="{{ route('products.update', $product->id) }}" method="post" role="form"
              enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <h3>選擇分類</h3>
            <select class="form-control" name="category_id">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category->id == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
                @endforeach
            </select>

            <div class="form-group">
                <label for="name">產品名稱</label>
                <input type="text" name="name" value="{{ $product->name }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="description">產品描述</label>
                <textarea name="description" rows="4" cols="50"
                          class="form-control">{{ $product->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="name">產品網址</label>
                <input type="text" name="site" class="form-control">
            </div>

            <div class="form-group">
                <label for="name">產品封面</label>
                <img class="form-control"
                     src="{{ ($product->cover) ? image_path('cover.product', $product->id, $product->cover):'holder.js/800x600' }}">
                <input type="file" name="cover" class="form-control">
            </div>

            <div class="form-group">
                <label for="name">釋出時間</label>
                <div class='input-group date' id='datetimepicker1'>
                    <input name="launched_at" type='text' class="form-control"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label for="name">標籤</label>
                <select name="tags[]" id="tags" class="form-control"></select>
            </div>

            <div class="form-group">
                <input type="submit" value="更新" class="btn btn-default">
            </div>
        </form>
    </div>

@endsection

@section('script')
    <script>
        $(function () {
            $('#datetimepicker1').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss'
            });
        });

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