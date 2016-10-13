@extends('layouts.app')

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
                <p>{{ $product->launched_at }}</p>
            </div>
        </div>

        <!--標籤-->
    @include('products._partials.tags')

    <!--需要登入才可操作項目-->
    @if(auth()->check())
        <!--評分-->
            <div class="form-group text-center">
                @include('products._funcs.emojis')
            </div>

            <!--收藏集-->
        @include('products._forms.collections')

        <!--願望清單-->
        @include('products._funcs.wishes')

        <!--最愛-->
        @include('products._funcs.favorites')


        <!--評論表單-->
        @if (! auth()->user()->hasBeenCommentByProduct($product->id))
            @include('comments._partials.create')
        @endif
    @endif

        <!--評論清單-->
        @if ($product->isEmoji(auth()->user()))
            @include('comments.lists')
        @else
            <h3>Oops 需要先給予評分才能看評論喔</h3>
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