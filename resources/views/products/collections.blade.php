@extends('backend.layouts.app')
@inject('collections', 'App\Services\CollectionService')

@section('content')
    <div class="container">
        <div class="row">
            @if ($collections->findByUser(auth()->user()->id)->isEmpty())
                還沒有收藏集嗎？
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('collections.create') }}">建立收藏集</a>
                </div>
            @else
                <div class="text-center">
                    <div class="col-xs-12 col-md-12">
                        <form class="form-group" action="{{ route('collections.addProduct', $product_id) }}">
                            {{ csrf_field() }}
                            <div class="col-xs-8 col-md-10">
                                <select class="form-control" name="collection_id">
                                    @foreach($collections->findByUser(auth()->user()->id) as $collection)
                                        <option value="{{ $collection->id }}">{{ $collection->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xs-4 col-md-2">
                                <input class="btn btn-default" type="submit" value="加入到此收藏集">
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
