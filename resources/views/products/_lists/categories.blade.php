@inject('categories', 'App\Services\CategoryService')

<h3>選擇分類</h3>
<select class="form-control" name="category_id">
    @foreach($categories->all() as $category)
        <option value="{{ $category->id }}">{{ $category->name }}</option>
    @endforeach
</select>