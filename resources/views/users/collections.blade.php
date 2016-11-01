@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
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
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <a class="btn btn-default" href="{{ route('collections.create') }}"><i class="glyphicon glyphicon-plus"></i>建立新的收藏集</a>
            </div>
        </div>

        {!! $collections->links() !!}
    </div>
@endsection