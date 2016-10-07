@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <h1>所有文章</h1>
        //搜尋．．．
        <table class="table table-bordered">
            <tr>
                <td>ID</td>
                <td>名字</td>
                <td>編輯</td>
                <td>刪除</td>
                <td>建立時間</td>
            </tr>
            @foreach($articles as $article)
                <tr>
                    <td>
                        {{ $article->id }}
                    </td>
                    <td>
                        <a href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a>
                    </td>
                    <td>
                        <a class="btn btn-default" href="{{ route('articles.edit', $article->id) }}">編輯</a>
                    </td>
                    <td>
                        @include('articles._forms.destroy', [
                         'article' => $article
                        ])
                    </td>
                    <td>
                        {{ $article->created_at }}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <div style="text-align: center">{!! $articles->links() !!}</div>
@endsection