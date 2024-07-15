@foreach ($addon as $addon)
    <div id="reception-btn" style="margin-bottom: 5px;">
        <a href="{{ $addon->url }}">
            @if ($addon->getFirstMedia('addon_image'))
                <img style="width:100%;" src="{{ $addon->getFirstMedia('addon_image')->getUrl() }}" alt="">
            @else
                <img style="width:100%;" src="{{ asset($addon->image) }}" alt="">
            @endif

        </a>
    </div>
@endforeach
