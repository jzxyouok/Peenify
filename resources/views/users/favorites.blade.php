@extends('layouts.app')

@section('content')

    <div class="container">
        @foreach($favorites as $favorite)
            <h2>{{ $favorite->favorable->name }}</h2>
            <h3>{{ $favorite->created_at->diffForHumans() }}</h3>

            <div class="form-group">
                <div id="favorite" class="btn btn-{{ $favorite->favorable->isFavorite(auth()->user()) ? 'danger' : 'default' }}"
                     data-type="product" data-id={{ $favorite->favorable->id }} data-token={{ csrf_token() }}>
                    {{ $favorite->favorable->isFavorite(auth()->user()) ? '取消最愛' : '最愛'}}
                </div>
            </div>

        @endforeach
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
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