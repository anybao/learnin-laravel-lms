<div class="mb-3 mt-3">
    @if(session('errors'))
        <span class="text-danger mt-3">
        <ul>
            @foreach(session('errors')->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </span>
    @endif
    @if(session('message'))
        <span class="text-success mt-3">{{ session('message') }}</span>
    @endif
    @if(session('success'))
        <span class="text-success mt-3">{{ session('success') }}</span>
    @endif
    @if(session('err_message'))
        <span class="text-danger mt-3">{{ session('err_message') }}</span>
    @endif
    @if ($message = Session::get('error'))
        <div class="text-center mt-3">
            <h6 class="text-danger">{!! $message !!}</h6>
        </div>
        <?php Session::forget('error');?>
    @endif
</div>
