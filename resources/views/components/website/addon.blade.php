@foreach ($addon as $addon)
    <div id="reception-btn" style="margin-bottom: 5px;">
        <a href="{{ $addon->url }}">
            <img style="width:100%;" src="{{ $addon->getFirstMedia('addon_image')->getUrl() }}" alt="">
        </a>
    </div>
@endforeach
