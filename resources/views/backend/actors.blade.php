@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <h1>所有演員</h1>
        //搜尋．．．
        <table class="table table-bordered">
            <tr>
                <td>ID</td>
                <td>名字</td>
                <td>編輯</td>
                <td>刪除</td>
                <td>建立時間</td>
            </tr>
            @foreach($actors as $actor)
                <tr>
                    <td>
                        {{ $actor->id }}
                    </td>
                    <td>
                        <a href="{{ route('actors.show', $actor->id) }}">{{ $actor->name }}</a>
                    </td>
                    <td>
                        <a class="btn btn-default" href="{{ route('actors.edit', $actor->id) }}">編輯</a>
                    </td>
                    <td>
                        @include('actors._forms.destroy', [
                         'actor' => $actor
                        ])
                    </td>
                    <td>
                        {{ $actor->created_at }}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <div style="text-align: center">{!! $actors->links() !!}</div>
@endsection