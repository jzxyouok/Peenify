@extends('layouts.app')

@section('style')
    <style>
        #bookmark {
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center slogan__distance">
                <h2 class="slogan">
                    {{ $user->name }}'s 書籤
                </h2>
            </div>
        </div>

        <div class="row">
            @foreach($bookmarks as $bookmark)
                <div class="col-xs-12 col-sm-8 col-md-4 col-lg-4">
                    <div class="Card__panel">
                        <a href="{{ route('products.show', $bookmark->bookmarkable->id) }}">
                            <img class="Card__image"
                                 src="{{ ($bookmark->bookmarkable->cover) ? image_path('products', $bookmark->bookmarkable->cover):'holder.js/380x260?auto=yes' }}">
                        </a>

                        <div>
                            <div class="Card__detail">
                                <h3 class="Card__title">
                                    <a class="Card__title__link"
                                       href="{{ route('products.show', $bookmark->bookmarkable->id) }}">{{ str_limit($bookmark->bookmarkable->name, 20) }}
                                    </a>
                                </h3>

                                @if(auth()->check() && $bookmark->owns())
                                    <div class="Card__count">
                                        <div id="bookmark"
                                             class="glyphicon glyphicon-bookmark{{ $bookmark->bookmarkable->isBookmark(auth()->user()) ? ' bookmark__color' : '' }}"
                                             data-type="product"
                                             data-id={{ $bookmark->bookmarkable->id }} data-token={{ csrf_token() }}>
                                        </div>
                                        <span class="Card__count__description">{{ $bookmark->created_at->diffForHumans() }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center">
            {!! $bookmarks->links() !!}
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('/js/bookmark.js') }}"></script>
@endsection