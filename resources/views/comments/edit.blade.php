@extends('layouts.app')

@section('content')

    <div class="container" id="app">
        <h1>編輯評論</h1>

        <form action="{{ route('comments.update', $comment->id) }}" method="post" role="form" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="form-group">
                <label for="description">類別描述</label>
                <textarea name="description" rows="4" cols="50"
                          class="form-control" v-model="comment"></textarea>
                <span>剩餘 @{{ comment_surplus }} 字</span>
            </div>
            <div class="form-group">
                <input type="hidden" name="product_id" value="{{ $product_id }}">
                <input type="submit" value="更新" class="btn btn-default">
            </div>
        </form>
    </div>

@endsection

@section('script')
    <script>
        var app = new Vue({
            el: '#app',
            data: {
                comment: "<?php echo old('description') ?? $comment->description; ?>"
            },
            computed: {
                comment_surplus: function () {
                    return 200 - this.comment.length
                }
            }
        })
    </script>
@endsection