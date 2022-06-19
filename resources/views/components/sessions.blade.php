@if(session('created'))
    <div class="alert alert-success">
        {{ session('created') }}
    </div>
@elseif(session('updated'))
    <div class="alert alert-success">
        {{ session('updated') }}
    </div>
@elseif(session('deleted'))
    <div class="alert alert-success">
        {{ session('deleted') }}
    </div>
@endif
