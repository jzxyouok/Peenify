@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('/css/card-style.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="text-center">
            <!--產品名稱-->
            <h1 style="border-bottom: 1px solid #000000; display: inline-block">{{ $product->name }}</h1>
        </div>

        <!--圖片-->
        <div class="row">
            <img class="img-responsive" style="width: 800px; max-height:300px; display: block; margin: 0 auto;"
                 src="{{ ($product->cover) ? image_path('products', $product->cover):'holder.js/800x300' }}">

            <!--產品描述-->
            <div style="margin: 0 auto;display: block;max-width:800px;padding: 0.5em 0.5em;">
                <p>{{ $product->description }}</p>
            </div>

            <div class="text-center" style="margin: 0 auto;display: block;max-width:800px;padding: 0.5em 0.5em;">
                發行日期:<p>{{ $product->launched_at }}</p>
            </div>
        </div>

        <!--標籤-->
    @include('products._partials.tags')

    <!--需要登入才可操作項目-->
        @if(auth()->check())
            <div class="form-group text-center">
                <!--評分-->
                @include('products._funcs.emojis')
            </div>

            <div class="form-group text-center">
                <!--收藏集-->
                <a class="btn btn-default" href="{{ route('collections.addProduct', $product->id) }}">加入收藏集</a>

                <!--願望清單-->
            @include('products._funcs.wishes')

            <!--最愛-->
                @include('products._funcs.favorites')
            </div>

            <!--評論表單-->
            @if (! auth()->user()->hasBeenCommentByProduct($product->id))
                @include('comments._partials.create')
            @endif

        <!--評論清單-->
            @if ($product->isEmoji(auth()->user()))
                @include('comments.lists')
            @else
                <h3>Oops! 需要先給予評分才能看評論喔</h3>
            @endif
        @endif
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
                        window.location.reload();
                    } else {
                        $("#emoji").removeClass('btn-danger').addClass('btn-default');
                        $this.addClass('btn-danger').removeClass('btn-default');
                    }
                });
            });

            $(document).on('click', '#favorite', function () {
                var $this = $(this);
                var $amount = parseInt($('#favorite_amount').text());
                var token = $this.data('token');
                var type = $this.data('type');
                var id = $this.data('id');
                $.post('/favorites/' + type + '/' + id, {
                    '_token': token
                }, function (result) {
                    if (result.status == 'favorite') {
                        $this.addClass('glyphicon-heart').addClass('Favorite__heart__color').removeClass('glyphicon-heart-empty');
                        $('#favorite_amount').html($amount + 1);
                    } else {
                        $this.addClass('glyphicon-heart-empty').removeClass('Favorite__heart__color').removeClass('glyphicon-heart');
                        $('#favorite_amount').html($amount - 1);
                    }
                });
            });
        });
    </script>
@endsection