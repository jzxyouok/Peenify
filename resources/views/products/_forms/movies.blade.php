<div class="form-group">
    <label for="name">原始名稱</label>
    <input type="text" name="options[origin_name]" class="form-control" value="{{ old('options.origin_name') }}">
</div>

<div class="form-group">
    <label for="name">片長 * 1時40分</label>
    <input name="options[runtime_at]" type='text' class="form-control" value="{{ old('options.runtime_at') }}">
</div>

<div class="form-group">
    <label for="name">預告片 * 輸入 youtube id 即可</label>
    <input type="text" name="options[trailer]" class="form-control" value="{{ old("options.trailer") }}">
</div>