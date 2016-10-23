@extends('layouts.app')

@section('style')
    <style>
        .round {
            border-radius: 50%;
            overflow: hidden;
            width: 150px;
            height: 150px;
        }

        .round img {
            display: block;
            min-width: 100%;
            min-height: 100%;
        }

        .Card__image {
            margin-left: auto;
            margin-right: auto;
            max-width: 100%;
            height: auto;
        }

        .description {
            margin: 0 auto;
            display: inline-block;
            max-width: 500px;
            padding: 0.5em 0.5em;
            text-align: justify;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4" style="background-color: #fff;height: auto; max-width: 360px;padding-top: 30px;">
                <div style="padding-top: 20px;">
                    <div class="round" style="margin: auto;">
                        <img class="Card__image"
                             src="{{ ($user->avatar) ? image_path('avatars.users', $user->avatar):'holder.js/300x300' }}">
                    </div>
                </div>
                <h3 class="text-center" style="padding-top: 10px;margin: auto;">{{ $user->name }}</h3>
                @if (auth()->check())
                    <div class="text-center" style="padding:10px 10px">
                        <div id="subscribe"
                             class="btn btn-{{ $user->isSubscribe(auth()->user()) ? 'danger' : 'default' }}"
                             data-type="user" data-id={{ $user->id }} data-token={{ csrf_token() }}>
                            {{ $user->isSubscribe(auth()->user()) ? '取消關注' : '關注' }}
                        </div>
                    </div>
                @endif

                <span class="description">
                    {{ $user->description }}
                </span>
            </div>
        </div>
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
        });
    </script>
@endsection