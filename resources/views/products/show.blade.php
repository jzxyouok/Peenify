@extends('layouts.app')

@section('style')
    <style>
        .image-size {
            width: 50%;
            height: 50%;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <!--圖片-->
        <img class="image-size"
             src="{{ ($product->cover) ? image_path('products', $product->cover):'holder.js/400x400' }}">

        <!--產品名稱-->
        <h1>{{ $product->name }}</h1>

        <!--產品描述-->
        <div class="form-group">
            {{ $product->description }}
        </div>

        <!--標籤-->
        @include('products._partials.tags')

        <!--作者-->
        <h3>作者</h3>
        @include('products._partials.authors')

        <!--作者-->
        <h3>演員</h3>
        @include('products._partials.actors')

        <!------------------------------------->

        <!--電影額外選項-->
        @include('products._partials.movies')

        <!--劇集額外選項-->
        @include('products._partials.series')

        <!--需要登入才可操作項目-->
        @if(auth()->check())
            <!--願望清單-->
            @include('products._funcs.wishes')

            <!--最愛-->
            @include('products._funcs.favorites')

            <!--收藏集-->
            @include('products._forms.collections')

            <!--評分-->
            @include('products._funcs.emojis')

            <!--評論表單-->
            @if (! auth()->user()->hasBeenCommentByProduct($product->id))
                @include('comments._partials.create')
            @endif
        @endif

        <!--評論清單-->
        @include('comments.lists')
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $(document).on('click', '#wish', function () {
                var $this = $(this);
                var token = $this.data('token');
                var type = $this.data('type');
                var id = $this.data('id');
                $.post('/wishes/' + type + '/' + id, {
                    '_token': token
                }, function (result) {
                    if (result.status == 'wish') {
                        $this.addClass('btn-danger').removeClass('btn-default').text('取消願望');
                    } else {
                        swal({
                            title: "Are you sure?",
                            text: "你要取消願望這個嗎？？",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "對，我不想看到了",
                            closeOnConfirm: false
                        }, function () {
                            swal("取消願望成功!", "你已經取消願望囉", "success");
                            $this.addClass('btn-default').removeClass('btn-danger').text('願望');
                        });
                    }
                });
            });

            $(document).on('click', '#emoji', function () {
                var $this = $(this);
                var token = $this.data('token');
                var id = $this.data('id');
                var type = $this.data('type');
                var emoji = $this.data('emoji');
                $.post('/emojis/' + type + '/' + id, {
                    '_token': token,
                    'emoji': emoji
                }, function (result) {
                    if (result.status == 'emoji') {
                        $this.addClass('btn-danger').removeClass('btn-default');
                    } else {
                        $("#emoji").removeClass('btn-danger').addClass('btn-default');
                        $this.addClass('btn-danger').removeClass('btn-default');
                    }
                });
            });

            $(document).on('click', '#favorite', function () {
                var $this = $(this);
                var token = $this.data('token');
                var type = $this.data('type');
                var id = $this.data('id');
                $.post('/favorites/' + type + '/' + id, {
                    '_token': token
                }, function (result) {
                    if (result.status == 'favorite') {
                        $this.addClass('btn-danger').removeClass('btn-default').text('取消最愛');
                    } else {
                        swal({
                            title: "Are you sure?",
                            text: "你要取消最愛這個嗎？？",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "對，我不想看到了",
                            closeOnConfirm: false
                        }, function () {
                            swal("取消最愛成功!", "你已經取消最愛囉", "success");
                            $this.addClass('btn-default').removeClass('btn-danger').text('最愛');
                        });
                    }
                });
            });
        });
    </script>
@endsection