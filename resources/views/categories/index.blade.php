@extends('layouts.app')

@section('style')
    <style>
        #title {
            font-size: 24px;
            line-height: 1em;
            vertical-align: bottom;
            letter-spacing: 0px;
        }
    </style>
@endsection

@section('content')

    <div class="container">
        <h1 id="title">所有分類</h1>
        @foreach($categories as $category)
            <img src="{{ ($category->cover) ? image_path('categories', $category->cover):'holder.js/200x100' }}">
            <h3>
                <a href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a>
            </h3>

            <div class="form-group">
                <div id="follow" class="btn btn-{{ $category->existFollowByAuth() ? 'danger' : 'default' }}"
                     data-type="category" data-id={{ $category->id }} data-token={{ csrf_token() }}>
                    {{ $category->existFollowByAuth() ? '取消關注' : '關注' }}
                </div>
            </div>

            <p>{{ $category->description }}</p>
            <p>{{ $category->created_at->diffForHumans() }}</p>
        @endforeach
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
                            text: "你要取消關注這個類別嗎？？",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "對，我不想看到了",
                            closeOnConfirm: false
                        }, function () {
                            swal("取消關注成功!", "你已經取消關注囉", "success");
                            $this.addClass('btn-default').removeClass('btn-danger').text('關注');
                        });
                    }
                });
            });
        });
    </script>
@endsection