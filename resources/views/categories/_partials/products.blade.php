<div class="col-md-12 text-center">
    <h2 style="display: inline-block; padding-bottom: 6px; border-bottom: 4px solid rgb(0, 160, 233); letter-spacing: 4px;">
        最新產品
    </h2>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        @foreach($products as $product)
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                <div class="panel panel-default">
                    <a href="{{ route('products.show', $product->id) }}">
                        <img class="img-responsive"
                             src="{{ ($product->cover) ? image_path('products', $product->cover):'holder.js/348x261' }}">
                    </a>

                    <div class="panel-title">
                        <div class="Card__details">
                            <h3 class="Card__title">
                                <a href="{{ route('products.show', $product->id) }}"
                                   class="link_style">{{ str_limit($product->name, 20) }}
                                </a>
                            </h3>
                            <div class="Card__count">
                                {{ $product->emojis()->count() }}
                                <span class="utility-muted">Rating</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        More...
    </div>
</div>


