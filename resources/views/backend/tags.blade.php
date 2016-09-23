@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <h1>所有標籤</h1>
        //搜尋．．．
        <table class="table table-bordered">
            <tr>
                <td>ID</td>
                <td>標籤名稱</td>
            </tr>
            @foreach($tags as $tag)
                <tr>
                    <td>
                        {{ $tag->id }}
                    </td>
                    <td>
                        <a href="{{ route('tags.show', $tag->id) }}">{{ $tag->name }}</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <div style="text-align: center">{!! $tags->links() !!}</div>
@endsection