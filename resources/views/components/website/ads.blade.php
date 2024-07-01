<div style="width: 100%; height: auto; background-color: #fff; float: left;">
    @foreach ($ads as $ad)
        <div class="column_link">
            <a href="{{ $ad->url }}" target="blank"><img src="{{ $ad->getFirstMedia('ads_image')->getUrl() }}" /></a>
        </div>
    @endforeach
</div>
