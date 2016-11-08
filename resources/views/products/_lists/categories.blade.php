@inject('categories', 'App\Services\CategoryService')

<label for="name">選擇分類</label>
<select class="form-control" name="category_id" v-model="category">
    @foreach($categories->all() as $category)
        <option value="{{ $category->id }}">{{ $category->name }}</option>
    @endforeach
</select>