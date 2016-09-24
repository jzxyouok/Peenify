@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <h1>所有使用者</h1>
        //搜尋．．．
        <table class="table table-bordered">
            <tr>
                <td>ID</td>
                <td>名字</td>
                <td>建立時間</td>
            </tr>
            @foreach($users as $user)
                <tr>
                    <td>
                        {{ $user->id }}
                    </td>
                    <td>
                        <a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a>
                    </td>
                    <td>
                        {{ $user->created_at }}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <div style="text-align: center">{!! $users->links() !!}</div>
@endsection