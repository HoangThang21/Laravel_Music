@include('layoutsAdmin.top')

@if (Auth::guard('api')->check())
    <div class="img_menu">
        @foreach ($files as $file)
            <img src="{{ asset('images/' . $file->getFilename()) }}" alt="{{ $file->getFilename() }}">
        @endforeach
    </div>

@endif
@include('layoutsAdmin.bottom')
