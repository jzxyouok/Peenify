@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">

                @if($collections->isEmpty())
                    <div class="row" style="padding-bottom: 20px;">
                        <h3 class="text-center">
                            還沒有收藏集嗎？建立屬於自己的經典！
                        </h3>
                    </div>

                @else
                    <table class="table table-bordered">
                        <th>
                            Name
                        </th>
                        @foreach($collections as $collection)
                            <tr>
                                <td>
                                    <a href="{{ route('collections.show', $collection->id) }}">{{ $collection->name }}</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="text-center">
                <a class="btn btn-default" href="{{ route('collections.create') }}"><i
                            class="glyphicon glyphicon-plus"></i>建立新的收藏集</a>
            </div>
        </div>

        {!! $collections->links() !!}
    </div>
@endsection