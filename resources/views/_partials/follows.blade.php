@if($relation->follows()->where('user_id', auth()->user()->id)->count())
    <div class="follow btn btn-danger" data-type="{{ $type }}"
         data-id={{ $relation->id }} data-token={{ csrf_token() }}> 取消關注 </div>
@else
    <div class="follow btn btn-default" data-type="{{ $type }}"
         data-id={{ $relation->id }} data-token={{ csrf_token() }}> 關注 </div>
@endif