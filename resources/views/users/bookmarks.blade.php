@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('/css/card-style.css') }}">

    <style>
        .Card__panel {
            height: auto;
        }

        #bookmark {
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="col-md-12 text-center" style="padding-bottom: 20px">
            <h2 class="Card__category__name">
                {{ $user->name }}'s 書籤
            </h2>
        </div>

        <div class="row">
            @foreach($bookmarks as $bookmark)
                <div class="col-xs-12 col-sm-8 col-md-4 col-lg-4">
                    <div class="Card__panel" style="border: 1px solid #ccc">
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
                                        <div id="bookmark" class="glyphicon glyphicon-bookmark{{ $bookmark->bookmarkable->isBookmark(auth()->user()) ? ' Favorite__heart__color' : '' }}"
                                             data-type="product" data-id={{ $bookmark->bookmarkable->id }} data-token={{ csrf_token() }}>
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

        {!! $bookmarks->links() !!}
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $(document).on('click', '#bookmark', function () {
                var $this = $(this);
                var token = $this.data('token');
                var type = $this.data('type');
                var id = $this.data('id');
                $.post('/bookmarks/' + type + '/' + id, {
                    '_token': token
                }, function (result) {
                    if (result.status == 'bookmark') {
                        $this.addClass('Favorite__heart__color');
                    } else {
                        $this.removeClass('Favorite__heart__color').removeClass('glyphicon-heart');
                    }
                });
            });
        });
    </script>
@endsection