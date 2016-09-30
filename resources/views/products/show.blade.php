@extends('layouts.app')
@section('style')
    <style>
        .emoji {
        }

        .image-size {
            width: 50%;
            height: 50%;
        }
    </style>
@endsection

@section('content')

    <div class="container">
        <img class="image-size"
             src="{{ ($product->cover) ? image_path('products', $product->cover):'holder.js/800x600' }}">

        <!--標籤-->
    @include('products._partials.tags', [
        'product' => $product
        ])

    <!--電影額外選項-->
        @include('products._partials.movies', [
            'movie' => $product->movie()
        ])

        <h1>
            {{ $product->name }}
            @if($product->wishes->count())
                <div id="wish" class="btn btn-danger" data-id={{ $product->id }} data-token={{ csrf_token() }}>從願望清單移除
                </div>
            @else
                <div id="wish" class="btn btn-default" data-id={{ $product->id }} data-token={{ csrf_token() }}>加到願望清單
                </div>
            @endif
        </h1>
        <p>{{ $product->description }}</p><br>

        @if (auth()->check())
            @include('products._forms.collections', [
                'product' => $product,
            ])
        @endif

        @include('products._partials.collections', [
                    'product' => $product,
                ])

        @if ($product->category->name == '電影')
            @include('products._partials.authors')
            @include('products._partials.actors')
        @endif

        <div class="form-group">
            @include('_partials.emojis', [
                'relation' => $product,
                'type' => 'product',
                'emoji' => 'like',
                'icon' => '&#x1F44D;',
                ])
            <span class="badge emoji-count">{{ $product->emojis()->where('type', 'like')->count() }}</span>

            @include('_partials.emojis', [
                'relation' => $product,
                'type' => 'product',
                'emoji' => 'bad',
                'icon' => '&#x1F44E;',
                ])
            <span class="badge emoji-count">{{ $product->emojis()->where('type', 'bad')->count() }}</span>
        </div>

        @if (auth()->check())
            @if($product->favorites()->where('user_id', auth()->user()->id)->count())
                <div class="favorite btn btn-danger"
                     data-id={{ $product->id }} data-token={{ csrf_token() }}> 取消最愛
                </div>
            @else
                <div class="favorite btn btn-default"
                     data-id={{ $product->id }} data-token={{ csrf_token() }}> 最愛
                </div>
            @endif
        @endif

        @include('comments._partials.create', [
            'product' => $product,
        ])

        @include('comments._partials.show', [
            'comments' => $product->comments
        ])
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $(document).on('click', '#wish', function () {
                var $this = $(this);
                var token = $this.data('token');
                var id = $this.data('id');
                $.post('/users/wishes/' + id, {
                    '_token': token
                }, function (result) {
                    if (result.status == 'create') {
                        swal("Good job!", "已經把產品加進去囉", "success");
                        $this.addClass('btn-danger').removeClass('btn-default').text("從願望清單移除");
                    } else {
                        swal("Wwwwwwww...", "產品被移除了", "success");
                        $this.addClass('btn-default').removeClass('btn-danger').text("加到願望清單");
                    }
                });
            });

            $(document).on('click', '.emoji', function () {
                var $this = $(this);
                var token = $this.data('token');
                var id = $this.data('id');
                var type = $this.data('type');
                var emoji = $this.data('emoji');
                $.post('/emojis/' + type + '/' + id, {
                    '_token': token,
                    'type': emoji
                }, function (result) {
                    if (result.status == 'create') {
                        $this.addClass('btn-danger').removeClass('btn-default');
                    } else {
                        $(".emoji").removeClass('btn-danger').addClass('btn-default');
                        $this.addClass('btn-danger').removeClass('btn-default');
                    }
                });
            });

            $(document).on('click', '.favorite', function () {
                var $this = $(this);
                var token = $this.data('token');
                var id = $this.data('id');
                $.post('/favorites/' + id, {
                    '_token': token
                }, function (result) {
                    if (result.status == 'create') {
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