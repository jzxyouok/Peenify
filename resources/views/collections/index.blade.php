@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('/css/card-style.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="col-md-12 text-center">
            <h2 style="display: inline-block; padding-bottom: 6px; border-bottom: 2px solid; letter-spacing: 4px;">
                為您精選的收藏集
            </h2>
        </div>
        <div class="row">
            <div class="col-md-12">
                @foreach($collections as $collection)
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-title">
                                <div class="Card__details">
                                    <h3 class="Card__title">
                                        <a class="link_style"
                                           href="{{ route('collections.show', $collection->id) }}">{{ $collection->name }}</a>
                                    </h3>

                                    <div id="subscribe"
                                         class="btn btn-{{ $collection->isSubscribe(auth()->user()) ? 'danger' : 'default' }}"
                                         data-type="collection"
                                         data-id={{ $collection->id }} data-token={{ csrf_token() }}>
                                        {{ $collection->isSubscribe(auth()->user()) ? '取消訂閱' : '訂閱' }}
                                    </div>
                                </div>
                                <div class="Card__details">
                                    <div class="Card__title">
                                        {{ $collection->description }}
                                    </div>

                                    <div class="Card__count">
                                        {{ $collection->products()->count() }}
                                        <span class="utility-muted">total</span>
                                    </div>

                                    <div class="Card__count">
                                    {{ $collection->subscribes()->count() }}
                                    <span class="utility-muted">subscribers</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            @endforeach
        </div>
    </div>

    <div style="text-align: center">
        {!! $collections->links() !!}
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
                        $this.addClass('btn-danger').removeClass('btn-default').text('取消訂閱');
                    } else {
                        $this.addClass('btn-default').removeClass('btn-danger').text('訂閱');
                    }
                });
            });
        });
    </script>
@endsection