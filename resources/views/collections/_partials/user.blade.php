<div class="row text-center">
    <img class="round Card__image"
         src="{{ ($collection->user->avatar) ? image_path('avatars.users', $collection->user->avatar):'holder.js/50x50' }}">
    {{ $collection->user->name }}
</div>