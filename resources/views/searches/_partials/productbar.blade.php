<div class="row">
    <div class="col-lg-6 col-md-offset-3">
        <form action="{{ route('searches.result') }}">
            <div class="input-group">
                <input type="text" name="term" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">Go!</button>
                            </span>
            </div>
        </form>
    </div>
</div>