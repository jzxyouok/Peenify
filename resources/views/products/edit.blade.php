@extends('backend.layouts.app')

@section('content')
    <div class="container" id="app">
        <div class="text-center">
            <h2 style="padding-bottom: 20px;">
                編輯產品
            </h2>
        </div>

        <div class="row">
            <form action="{{ route('products.update', $product->id) }}" method="post" role="form" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="col-md-6">
                    @inject('categories', 'App\Services\CategoryService')

                    <label for="name">選擇分類</label>
                    <select class="form-control" name="category_id" v-model="category">
                        @foreach($categories->all() as $category)
                            <option value="{{ $category->id }}"  {{ $product->category->id == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
                        @endforeach
                    </select>

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name">產品名稱 <span style="color: red">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') ?? $product->name }}">

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        <label for="description">產品描述 <span style="color: red">*</span></label>
                        <textarea name="description" rows="4" cols="50" placeholder="請輸入產品描述..."
                                  class="form-control">{{ old('description') ?? $product->description }}</textarea>

                        @if ($errors->has('description'))
                            <span class="help-block">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('site') ? ' has-error' : '' }}">
                        <label for="name">產品網址</label>
                        <input type="text" name="site" class="form-control" value="{{ old('site') ?? $product->site }}">

                        @if ($errors->has('site'))
                            <span class="help-block">
                                <strong>{{ $errors->first('site') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('cover') ? ' has-error' : '' }}">
                        <span>Preview</span>
                        <div>
                            <img style="width: 200px" src="{{ ($product->cover) ? image_path('products', $product->cover):'holder.js/800x600' }}">
                        </div>

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
                                   value="{{ old('launched_at') ?? $product->launched_at }}"/>
                        </div>

                        @if ($errors->has('launched_at'))
                            <span class="help-block">
                                <strong>{{ $errors->first('launched_at') }}</strong>
                            </span>
                        @endif
                    </div>
                        <div class="form-group">
                            <label for="tags">標籤 <span style="color: red">*</span></label>
                            <div>
                                標籤目前沒時間做編輯，待日後有空更新....
                            </div>
                            @foreach($product->tags as $tag)
                                <span style="background-color: #1b6d85; padding: 5px 5px; color: #FFFFFF">{{ $tag->name }}</span>
                            @endforeach
                        </div>
                </div>

                <div class="col-md-6">
                    <div>
                        目前也沒時間做編輯額外選項...
                    </div>
                </div>

                    <div class="form-group text-right" style="padding-top: 20px">
                        <input type="submit" value="編輯" class="btn btn-default">
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