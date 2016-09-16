@extends('layouts.app')

@section('style')
    <style>
        .follow {

        }
    </style>
@endsection

@section('content')

    <div class="container">
        <img src="{{ !$user->avatar ?: image_path('avatar.user', $user->avatar) }}">
        <h1>{{ $user->name }}</h1>
        <p>{{ $user->description }}</p>

        <a class="btn btn-default" href="{{ route('users.edit') }}">Edit</a>
    </div>


    @include('_partials.follows', [
            'relation' => $user,
            'type' => 'user',
            ])

    @include('comments._partials.create', [
    'commentable_type' => 'user',
    'commentable_id' => $user->id,
    'relation' => $user,
])

    @include('comments._partials.show', [
        'comments' => $user->comments
    ])
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $(document).on('click', '.follow', function () {
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