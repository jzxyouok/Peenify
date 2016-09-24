@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <h1>所有作者</h1>
        //搜尋．．．
        <table class="table table-bordered">
            <tr>
                <td>ID</td>
                <td>名字</td>
                <td>編輯</td>
                <td>刪除</td>
                <td>建立時間</td>
            </tr>
            @foreach($authors as $author)
                <tr>
                    <td>
                        {{ $author->id }}
                    </td>
                    <td>
                        <a href="{{ route('authors.show', $author->id) }}">{{ $author->name }}</a>
                    </td>
                    <td>
                        <a class="btn btn-default" href="{{ route('authors.edit', $author->id) }}">編輯</a>
                    </td>
                    <td>
                        @include('authors._forms.destroy', [
                         'author' => $author
                        ])
                    </td>
                    <td>
                        {{ $author->created_at }}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <div style="text-align: center">{!! $authors->links() !!}</div>
@endsection