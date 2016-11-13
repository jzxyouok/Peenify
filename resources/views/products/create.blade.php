@extends('backend.layouts.app')

@section('content')
    <div class="container" id="app">
        <div class="text-center">
            <h2 style="padding-bottom: 20px;">
                建立產品
            </h2>
        </div>

        <div class="row">
            <form action="{{ route('products.store') }}" method="post" role="form" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="col-md-6">
                    <!--類別清單-->
                    @include('products._lists.categories')

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name">產品名稱 <span style="color: red">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        <label for="description">產品描述 <span style="color: red">*</span></label>
                        <textarea name="description" rows="4" cols="50" placeholder="請輸入產品描述..."
                                  class="form-control">{{ old('description') }}</textarea>

                        @if ($errors->has('description'))
                            <span class="help-block">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('site') ? ' has-error' : '' }}">
                        <label for="name">產品網址</label>
                        <input type="text" name="site" class="form-control" value="{{ old('site') }}">

                        @if ($errors->has('site'))
                            <span class="help-block">
                                <strong>{{ $errors->first('site') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('cover') ? ' has-error' : '' }}">
                        <label for="name">產品封面</label>
                        <input type="file" name="cover" class="form-control">

                        @if ($errors->has('cover'))
                            <span class="help-block">
                                <strong>{{ $errors->first('cover') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('launched_at') ? ' has-error' : '' }}">
                        <label for="name">釋出時間 <span style="color: red">*</span></label>
                        <div class='input-group date' id='datetimepicker1'>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>

                            <input name="launched_at" type='text' class="form-control"
                                   value="{{ old('launched_at') }}"/>
                        </div>

                        @if ($errors->has('launched_at'))
                            <span class="help-block">
                                <strong>{{ $errors->first('launched_at') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('tags') ? ' has-error' : '' }}">
                        <label for="tags">標籤 <span style="color: red">*</span></label>
                        <select name="tags[]" id="tags" class="form-control"></select>

                        @if ($errors->has('tags'))
                            <span class="help-block">
                                <strong>{{ $errors->first('tags') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="col-md-6">
                    <!--額外的電影選項-->
                    <div style="color: #FFFFFF;background-color: #1f648b; padding: 10px 10px" v-if="category == 1">
                        額外的電影選項
                        @include('products._forms.movies')
                    </div>

                    <!--額外的影集選項-->
                    <div style="color: #FFFFFF;background-color: #ad4844; padding: 10px 10px" v-if="category == 2">
                        額外的影集選項
                        @include('products._forms.series')
                    </div>

                    <!--額外的動畫選項-->
                    <div style="color: #FFFFFF;background-color: #3A558E; padding: 10px 10px" v-if="category == 3">
                        額外的動畫選項
                        @include('products._forms.animes')
                    </div>

                    <!--額外的遊戲選項-->
                    <div style="color: #FFFFFF;background-color: #5cb85c; padding: 10px 10px" v-if="category == 4">
                        額外的遊戲選項
                        @include('products._forms.games')
                    </div>

                    <div class="form-group text-right" style="padding-top: 20px">
                        <input type="submit" value="建立" class="btn btn-default">
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        new Vue({
            el: '#app',
            data: {
                category: '1'
            }
        });

        $(function () {
            $('#datetimepicker1').datetimepicker({
                format: 'YYYY-MM-DD'
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