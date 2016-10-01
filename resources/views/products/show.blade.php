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
        <!--產品基本項目-->
        <img class="image-size"
             src="{{ ($product->cover) ? image_path('products', $product->cover):'holder.js/400x400' }}">
        <h1>{{ $product->name }}</h1>
        <p>{{ $product->description }}</p>
        <!--標籤-->
        @include('products._partials.tags', [
        'product' => $product
        ])

        <!------------------------------------->

        <!--電影額外選項-->
        @if (! empty($product->movie()->first()))
            <h3>電影額外選項</h3>
            <p>{{ $product->movie()->origin_name }}</p>
            <p>{{ $product->movie()->runtime }}</p>
            <p>{{ $product->movie()->trailer }}</p>
        @endif

        <!--願望清單-->
        @if(auth()->check())
            <div class="form-group">
                <div id="wish" class="btn btn-{{ $product->existWishByAuth() ? 'danger' : 'default' }}"
                     data-id={{ $product->id }} data-token={{ csrf_token() }}>
                    {{ $product->existWishByAuth() ? '從願望清單移除' : '加到願望清單'}}
                </div>
            </div>
        @endif

        <!--最愛-->
        @if (auth()->check())
            <div class="form-group">
                <div class="favorite btn btn-{{ $product->existFavoriteByAuth() ? 'danger' : 'default' }}"
                     data-id={{ $product->id }} data-token={{ csrf_token() }}>
                    {{ $product->existWishByAuth() ? '取消最愛' : '最愛'}}
                </div>
            </div>
        @endif

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

        @if(auth()->check())
            <div class="form-group">
                <div id="emoji" class="btn btn-{{ $product->existEmojiByAuth('like') ? 'danger' : 'default' }}"
                     data-type="product" data-emoji="like"
                     data-id={{ $product->id }} data-token={{ csrf_token() }}> 喜歡
                    （{{ $product->countEmojis('like') }}）
                </div>

                <div id="emoji" class="btn btn-{{ $product->existEmojiByAuth('bad') ? 'danger' : 'default' }}"
                     data-type="product" data-emoji="bad"
                     data-id={{ $product->id }} data-token={{ csrf_token() }}> 不喜歡
                    （{{ $product->countEmojis('bad') }}）
                </div>
            </div>
        @endif

        <!--評論表單-->
        <form action="{{ route('comments.store', $product->id) }}" method="post" role="form">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="description">為 {{ $product->name }} 寫下評論...</label>
                <textarea name="description" rows="4" cols="50" placeholder="請輸入評論..." class="form-control"></textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="評論" class="btn btn-default">
            </div>
        </form>

        <!--評論清單-->
        <div>
            <h4>Comments</h4>
            @foreach($product->comments as $comment)
                <p>{{ $comment->description }}</p>
                <a href="{{ route('comments.edit', $comment) }}">Edit</a>

                <div id="emoji" class="btn btn-{{ $comment->existEmojiByAuth('like') ? 'danger' : 'default' }}"
                     data-type="comment" data-emoji="like"
                     data-id={{ $comment->id }} data-token={{ csrf_token() }}> 喜歡
                    （{{ $comment->countEmojis('like') }}）
                </div>

                <div id="emoji" class="btn btn-{{ $comment->existEmojiByAuth('bad') ? 'danger' : 'default' }}"
                     data-type="comment" data-emoji="bad"
                     data-id={{ $comment->id }} data-token={{ csrf_token() }}> 不喜歡
                    （{{ $comment->countEmojis('bad') }}）
                </div>
            @endforeach
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

            $(document).on('click', '#emoji', function () {
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