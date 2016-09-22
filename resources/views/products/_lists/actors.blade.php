@inject('actors', 'App\Services\ActorService')

<h3>選擇演員</h3>
<select multiple class="form-control" name="actors[]">
    @foreach($actors->all() as $actor)
        <option value="{{ $actor->id }}">{{ $actor->name }}</option>
    @endforeach
</select>