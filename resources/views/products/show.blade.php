@extends('layouts.app')

@section('style')
    <style>
        .emoji {

        }
    </style>
@endsection

@section('content')

    <div class="container">
        <img src="{{ ($product->cover) ? image_path('cover.product', $product->id, $product->cover):'holder.js/800x600' }}">
        <h1>{{ $product->name }}</h1>
        <p>{{ $product->description }}</p><br>
        <h2>導演</h2>
        @foreach($product->authors as $author)
            {{ $author->name }} <br/>
        @endforeach
        <h3>演員</h3>
        @foreach($product->actors as $actor)
            {{ $actor->name }} <br/>
        @endforeach

        <h3>Tag</h3>
        @include('products._partials.tags', [
        'product' => $product
        ])

        <a class="btn btn-default" href="{{ route('products.edit', $product->id) }}">編輯</a>

        @include('products._partials.destroy', [
        'product' => $product
        ])

        @if($product->wishes->count())
            <div id="wish" class="btn btn-danger" data-id={{ $product->id }} data-token={{ csrf_token() }}>從願望清單移除</div>
        @else
            <div id="wish" class="btn btn-default" data-id={{ $product->id }} data-token={{ csrf_token() }}>加到願望清單</div>
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

        @include('comments._partials.create', [
            'commentable_type' => 'product',
            'commentable_id' => $product->id,
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
        });
    </script>
@endsection