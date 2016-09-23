@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <h1>所有類別</h1>
        //搜尋．．．
        <table class="table table-bordered">
            <tr>
                <td>ID</td>
                <td>分類名稱</td>
                <td>編輯</td>
                <td>刪除</td>
                <td>建立時間</td>
            </tr>
            @foreach($categories as $category)
                <tr>
                    <td>
                        {{ $category->id }}
                    </td>
                    <td>
                        <a href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a>
                    </td>
                    <td>
                        <a class="btn btn-default" href="{{ route('categories.edit', $category->id) }}">編輯</a>
                    </td>
                    <td>
                        @include('categories._forms.destroy', [
                         'category' => $category
                        ])
                    </td>
                    <td>
                        {{ $category->created_at }}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <div style="text-align: center">{!! $categories->links() !!}</div>
@endsection