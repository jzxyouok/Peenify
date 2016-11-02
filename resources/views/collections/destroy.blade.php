@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>你確定要刪除嗎？</h1>
        <p>一旦刪除了就很難還原喔...</p>

        <form action="{{ route('collections.destroy', $id) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <input type="submit" value="刪除" class="btn btn-danger">
        </form>
    </div>
@endsection