


    @if(session()->has($type))
        <div class="alert alert-{{$type}}">
            {{ \Illuminate\Support\Facades\Session::get($type) }}
        </div>
    @endif




