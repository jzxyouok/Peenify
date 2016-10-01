@extends('layouts.app')

@section('content')

    <div class="container">
        <img class="image-size" src="{{ ($user->avatar) ? image_path('avatars.users', $user->avatar):'holder.js/300x300' }}">
        <h1>{{ $user->name }}</h1>
        <div class="form-group">{{ $user->description }}</div>

        <a class="btn btn-default" href="{{ route('users.edit') }}">Edit</a>

        <div class="form-group">
            <div id="follow" class="btn btn-{{ $user->existFollowByAuth() ? 'danger' : 'default' }}"
                 data-type="user" data-id={{ $user->id }} data-token={{ csrf_token() }}>
                {{ $user->existFollowByAuth() ? '取消關注' : '關注' }}
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $(document).on('click', '#follow', function () {
                var $this = $(this);
                var token = $this.data('token');
                var id = $this.data('id');
                var type = $this.data('type');
                $.post('/follows/' + type + '/' + id, {
                    '_token': token
                }, function (result) {
                    if (result.status == 'create') {
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
        });
    </script>
@endsection