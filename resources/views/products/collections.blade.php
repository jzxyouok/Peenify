@extends('layouts.app')
@inject('collections', 'App\Services\CollectionService')

@section('content')
    <div class="container">
        <div class="row">
            @if ($collections->findByUser(auth()->user()->id)->isEmpty())
                <div class="text-center" style="padding-top: 200px">
                    還沒有收藏集嗎？
                    <div class="form-group">
                        <a class="btn btn-default" href="{{ route('collections.create') }}">建立收藏集</a>
                    </div>
                </div>
            @else
                <div class="text-center">
                    <form class="form-group" action="{{ route('collections.storeProduct', $product_id) }}"
                          method="post">
                        {{ csrf_field() }}
                        <select class="form-control" name="collection_id">
                            @foreach($collections->findByUser(auth()->user()->id) as $collection)
                                <option value="{{ $collection->id }}">{{ $collection->name }}</option>
                            @endforeach
                        </select>
                        <input class="btn btn-default" type="submit" value="加入到此收藏集">
                    </form>
                </div>
            @endif
        </div>
    </div>
@endsection
