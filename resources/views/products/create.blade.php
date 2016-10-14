@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <h1>建立產品</h1>
        <form action="{{ route('products.store') }}" method="post" role="form" enctype="multipart/form-data">
        {{ csrf_field() }}

        <!--類別清單-->
        @include('products._lists.categories')

            <div class="form-group">
                <label for="name">產品名稱</label>
                <input type="text" name="name" class="form-control">
            </div>

            <div class="form-group">
                <label for="description">產品描述</label>
                <textarea name="description" rows="4" cols="50" placeholder="請輸入產品描述..."
                          class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="name">產品網址</label>
                <input type="text" name="site" class="form-control">
            </div>

            <div class="form-group">
                <label for="name">產品封面</label>
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
                <label for="tags">標籤</label>
                <select name="tags[]" id="tags" class="form-control"></select>
            </div>

            <!--額外的電影選項-->
            @include('products._forms.movies')

            <!--額外的影集選項-->
            影集
            @include('products._forms.series')

            <!--額外的遊戲選項-->
            遊戲
            @include('products._forms.games')

            <div class="form-group">
                <input type="submit" value="建立" class="btn btn-default">
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

            $('#datetimepicker2').datetimepicker({
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
                        term: params.term
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