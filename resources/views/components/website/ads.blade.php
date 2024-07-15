<div style="width: 100%; height: auto; background-color: #fff; float: left;">
    @foreach ($ads as $ad)
        <div class="column_link">
            <a href="{{ $ad->url }}" target="blank">
                @if($ad->getFirstMedia('ads_image'))
                    <img src="{{ $ad->getFirstMedia('ads_image')->getUrl() }}" />
                @else
                    <img src="{{ asset($ad->image) }}" />
                @endif
        </div>
    @endforeach
</div>
