<div class="form-group">
    <label for="name">原始名稱</label>
    <input type="text" name="options[origin_name]" class="form-control" value="{{ old('options.origin_name') }}">
</div>

<div class="form-group">
    <label for="name">集數 * 25</label>
    <input name="options[episodes]" type='text' class="form-control" value="{{ old('options.episodes') }}">
</div>

<div class="form-group">
    <label for="name">預告片  * 輸入 youtube id 即可</label>
    <input type="text" name="options[trailer]" class="form-control" value="{{ old('options.trailer') }}">
</div>

<div class="form-group">
    <label for="name">國家</label>
    <input type="text" name="options[country]" class="form-control" value="{{ old('options.country') }}">
</div>