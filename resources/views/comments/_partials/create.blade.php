<style>
    .col-centered {
        float: none;
        margin: 0 auto;
        max-width: 500px;
    }
</style>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-centered">
    <form action="{{ route('comments.store', $product->id) }}" method="post" role="form">
        {{ csrf_field() }}
        <div class="form-group">
            <div style="text-align: center">
                <label for="description">為 {{ $product->name }} 寫下評論...</label>
            </div>
            <textarea name="description" rows="4" cols="50" placeholder="請輸入評論..." class="form-control"></textarea>
        </div>
        <div class="form-group text-right">
            <input type="submit" value="評論" class="btn btn-default">
        </div>
    </form>
</div>
