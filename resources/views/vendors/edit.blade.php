@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Edit Vendor</h1>

        <form action="{{ route('vendors.update', $vendor->id) }}" method="post" role="form" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="form-group">
                <label for="name">類別名稱</label>
                <input type="text" name="name" value="{{ $vendor->name }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="description">類別描述</label>
                <textarea name="description" rows="4" cols="50"
                          class="form-control">{{ $vendor->description }}</textarea>
            </div>

            <div class="form-group">
                代理商：<input type="text" name="agent" value="{{ $vendor->agent }}" class="form-control">
            </div>

            <div class="form-group">
                <input type="submit" value="更新" class="btn btn-default">
            </div>
        </form>
    </div>

@endsection