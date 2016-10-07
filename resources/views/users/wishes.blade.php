@extends('layouts.app')

@section('content')

    <div class="container">
        @foreach($wishes as $wish)
            <h2>{{ $wish->wishable->name }}</h2>
            <h3>{{ $wish->created_at->diffForHumans() }}</h3>

            <div class="form-group">
                <div id="wish" class="btn btn-{{ $wish->wishable->isWish(auth()->user()) ? 'danger' : 'default' }}"
                     data-type="product" data-id={{ $wish->wishable->id }} data-token={{ csrf_token() }}>
                    {{ $wish->wishable->isWish(auth()->user()) ? '從願望清單移除' : '加到願望清單'}}
                </div>
            </div>
        @endforeach

        {!! $wishes->links() !!}
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
        });
    </script>
@endsection