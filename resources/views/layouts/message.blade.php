<div>
    @if(session('message'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>成功！</strong> {{ session('message') }}.
        </div>
    @endif
</div>