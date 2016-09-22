@inject('authors', 'App\Services\AuthorService')

<h3>選擇作者</h3>
<select multiple class="form-control" name="authors[]">
    @foreach($authors->all() as $author)
        <option value="{{ $author->id }}">{{ $author->name }}</option>
    @endforeach
</select>