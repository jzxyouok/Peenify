@extends('layouts.app')

@section('content')

    <div class="container">
        @foreach($follows as $follow)
            <h3>{{ $follow->followable_type == 'category' ? '分類':'正在關注' }}</h3>
            <h4>{{ $follow->followable->name }}</h4>
        @endforeach

        <h2>誰關注你</h2>
        @foreach($followeds as $followed)
            <a href="{{ route('users.show', $followed->id) }}">{{ $followed->name }}</a>
        @endforeach
    </div>
@endsection