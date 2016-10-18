<style>
    .col-centered{
        float: none;
        margin: 0 auto;
    }
</style>

<div class="row">
    <div class="col-md-8 col-centered">
        <form action="{{ route('comments.store', $product->id) }}" method="post" role="form">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="description">為 {{ $product->name }} 寫下評論...</label>
                <textarea name="description" rows="4" cols="50" placeholder="請輸入評論..." class="form-control"></textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="評論" class="btn btn-default">
            </div>
        </form>
    </div>
</div>