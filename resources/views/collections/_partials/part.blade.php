<div class="row text-center">
    <h1>{{ $collection->name }}
        <span>
                    <a class="Card__title__link"
                       href="https://www.facebook.com/sharer/sharer.php?u={{ url(route('collections.show', $collection->id)) }}">
                        <i class="glyphicon glyphicon-share"></i>
                    </a>
                </span>
    </h1>
    <p>{{ $collection->description }}</p>
</div>