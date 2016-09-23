@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <h1>所有收藏集</h1>
        //搜尋．．．
        <table class="table table-bordered">
            <tr>
                <td>ID</td>
                <td>收藏集名稱</td>
                <td>編輯</td>
                <td>刪除</td>
                <td>建立時間</td>
            </tr>
            @foreach($collections as $collection)
                <tr>
                    <td>
                        {{ $collection->id }}
                    </td>
                    <td>
                        <a href="{{ route('collections.show', $collection->id) }}">{{ $collection->name }}</a>
                    </td>
                    <td>
                        <a class="btn btn-default" href="{{ route('collections.edit', $collection->id) }}">編輯</a>
                    </td>
                    <td>
                        @include('collections._forms.destroy', [
                         'collection' => $collection
                        ])
                    </td>
                    <td>
                        {{ $collection->created_at }}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <div style="text-align: center">{!! $collections->links() !!}</div>
@endsection