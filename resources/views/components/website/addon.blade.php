@foreach ($addon as $addon)
    <div id="reception-btn" style="margin-bottom: 5px;">
        @php
            if ($addon->url == null) {
                $url = url('');
            } else {
                $url = filter_var($addon->url, FILTER_VALIDATE_URL) ? $addon->url : url($addon->url);
            }
        @endphp
        <a href="{{ $url }}">
            @if ($addon->getFirstMedia('addon_image'))
                <img style="width:100%;" src="{{ $addon->getFirstMedia('addon_image')->getUrl() }}" alt="">
            @else
                <img style="width:100%;" src="{{ asset($addon->image) }}" alt="">
            @endif

        </a>
    </div>
@endforeach
