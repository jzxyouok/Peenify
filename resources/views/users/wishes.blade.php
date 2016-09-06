@extends('layouts.app')

@section('content')

    <div class="container">
        @foreach($wishes as $wish)
            <h2>{{ $wish->product->name }}</h2>
            <h3>{{ $wish->created_at->diffForHumans() }}</h3>

            @if($wish->product->count())
                <div id="wish" class="btn btn-danger" data-id={{ $wish->product->id }} data-token={{ csrf_token() }}>
                    從願望清單移除
                </div>
            @else
                <div id="wish" class="btn btn-default" data-id={{ $wish->product->id }} data-token={{ csrf_token() }}>
                    加到願望清單
                </div>
            @endif
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
        });
    </script>
@endsection