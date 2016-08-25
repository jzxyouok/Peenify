<h1>All Category</h1>

@if($categories->isEmpty())
    @foreach($categories as $category)
        <h2>{{ $category->name }}</h2>
    @endforeach
@endif