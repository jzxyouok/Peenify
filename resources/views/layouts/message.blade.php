<div>
    @if(session('message'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>成功！</strong> {{ session('message') }}.
        </div>
    @endif

        @if(session('warning'))
            <div class="alert alert-warning" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>注意</strong> {{ session('warning') }}.
            </div>
        @endif
</div>