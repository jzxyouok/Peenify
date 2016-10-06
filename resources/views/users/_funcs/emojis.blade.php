<div class="form-group">
    <div id="emoji" class="btn btn-{{ $user->isEmoji(auth()->user(), 'like') ? 'danger' : 'default' }}"
         data-type="user" data-emoji="like"
         data-id={{ $user->id }} data-token={{ csrf_token() }}> 很棒
        （{{ $user->countEmoji(auth()->user(), 'like') }}）
    </div>
</div>