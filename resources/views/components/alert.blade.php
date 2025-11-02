
    @if (session()->has($type))
        <div class="alert alert-{{ $type == 'error' ? 'danger' : $type }}">
            {{ session($type) }}
        </div>
    @endif

