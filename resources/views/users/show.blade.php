@extends('layouts.app')

@section('content')

    <div class="container">
        <img class="image-size"
             src="{{ ($user->avatar) ? image_path('avatars.users', $user->avatar):'holder.js/300x300' }}">
        <h1>{{ $user->name }}</h1>
        <div class="form-group">{{ $user->description }}</div>

        @if (auth()->check())
            <a class="btn btn-default" href="{{ route('users.edit') }}">Edit</a>

            <div class="form-group">
                <div id="subscribe" class="btn btn-{{ $user->isSubscribe(auth()->user()) ? 'danger' : 'default' }}"
                     data-type="user" data-id={{ $user->id }} data-token={{ csrf_token() }}>
                    {{ $user->isSubscribe(auth()->user()) ? '取消關注' : '關注' }}
                </div>
            </div>

            <!--鼓勵-->
            @include('users._funcs.emojis')
        @endif
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $(document).on('click', '#subscribe', function () {
                var $this = $(this);
                var token = $this.data('token');
                var id = $this.data('id');
                var type = $this.data('type');
                $.post('/subscribes/' + type + '/' + id, {
                    '_token': token
                }, function (result) {
                    if (result.status == 'subscribe') {
                        $this.addClass('btn-danger').removeClass('btn-default').text('取消關注');
                    } else {
                        swal({
                            title: "Are you sure?",
                            text: "你要取消關注這個人嗎？？",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "對，我不想看到他了",
                            closeOnConfirm: false
                        }, function () {
                            swal("取消關注成功!", "你已經取消關注他囉", "success");
                            $this.addClass('btn-default').removeClass('btn-danger').text('關注');
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
                        $this.removeClass('btn-danger').addClass('btn-default');
                    }
                });
            });
        });
    </script>
@endsection