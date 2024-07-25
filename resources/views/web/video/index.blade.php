<x-website-layout>
    <div>
        @if ($video)
            <div class="title-video"> <span style="font-size: 18px">{{ $video->name }}</span></div>

            @if ($video->source->value == 'google_drive')
                <iframe src="https://drive.google.com/file/d/{{ $video->video_id }}/preview" width="99%" height="400px"
                    allowfullscreen></iframe>
            @else
                <iframe src="https://www.youtube.com/embed/{{ $video->video_id }}" width="99%" height="400px"
                    allowfullscreen></iframe>
            @endif
        @endif
    </div>
    </br>
    <div class="box-left-home">
        <div class="head-cm">
            <ul>
                <li><a>Video khác</a></li>
            </ul>
        </div>
        <div class="box-top3">
            <ul>
                @foreach ($other_videos as $otherVideo)
                    <li>
                        <div style="position: relative">
                            <iframe src="https://drive.google.com/file/d/{{ $otherVideo->video_id }}/preview"
                                width="223px" height="125px"></iframe>
                        </div>
                        <h3><a href="{{ route('video.show', $otherVideo->id) }}">{{ $otherVideo->name }}</a></h3>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    @include('web.video.css')
</x-website-layout>
