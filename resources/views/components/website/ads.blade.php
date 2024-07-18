<div style="width: 100%; height: auto; background-color: #fff; float: left;">
    @foreach ($ads as $ad)
        <div class="column_link">
            @php
                if ($ad->url == null) {
                    $url = url('');
                } else {
                    $url = filter_var($ad->url, FILTER_VALIDATE_URL) ? $ad->url : url($ad->url);
                }
            @endphp
            <a href="{{ $url }}" target="_blank">
                @if ($ad->getFirstMedia('ads_image'))
                    <img src="{{ $ad->getFirstMedia('ads_image')->getUrl() }}" />
                @else
                    <img src="{{ asset($ad->image) }}" />
                @endif
        </div>
    @endforeach
</div>
