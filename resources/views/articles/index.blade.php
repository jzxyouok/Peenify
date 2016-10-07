@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>所有文章</h1>
        @foreach($articles as $article)
            <p>{{ $article->name }}</p>
            <p>{{ $article->description }}</p>
        @endforeach

        {!! $articles->links() !!}
    </div>

@endsection