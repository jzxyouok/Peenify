@if($product->emojis()->where('type', $emoji)->count())
    <div class="emoji btn btn-danger" data-type="{{ $type }}" data-emoji="{{ $emoji }}"
         data-id={{ $product->id }} data-token={{ csrf_token() }} data-icon="{{ $icon }}"> {{ $icon }} </div>
@else
    <div class="emoji btn btn-default" data-type="{{ $type }}" data-emoji="{{ $emoji }}"
         data-id={{ $product->id }} data-token={{ csrf_token() }} data-icon="{{ $icon }}"> {{ $icon }} </div>
@endif