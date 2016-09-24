@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <h1>所有廠商</h1>
        //搜尋．．．
        <table class="table table-bordered">
            <tr>
                <td>ID</td>
                <td>名稱</td>
                <td>編輯</td>
                <td>刪除</td>
                <td>建立時間</td>
            </tr>
            @foreach($vendors as $vendor)
                <tr>
                    <td>
                        {{ $vendor->id }}
                    </td>
                    <td>
                        <a href="{{ route('vendors.show', $vendor->id) }}">{{ $vendor->name }}</a>
                    </td>
                    <td>
                        <a class="btn btn-default" href="{{ route('vendors.edit', $vendor->id) }}">編輯</a>
                    </td>
                    <td>
                        @include('vendors._forms.destroy', [
                         'vendor' => $vendor
                        ])
                    </td>
                    <td>
                        {{ $vendor->created_at }}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <div style="text-align: center">{!! $vendors->links() !!}</div>
@endsection