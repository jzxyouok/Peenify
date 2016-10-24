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

        {!! $collections->links() !!}
    </div>
@endsection