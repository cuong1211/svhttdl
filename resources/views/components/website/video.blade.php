<div>
    <div class="notification-box">
        <div class="notification-header" style="text-align: center;">
            <a href="{{ route('video.index') }}">VIDEO</a>
        </div>
        <div>
            @if ($video->source->value == 'google_drive')
                <iframe src="https://drive.google.com/file/d/{{ $video->video_id }}/preview" width="100%" height="auto"
                    allowfullscreen="true"></iframe>
            @else
                <iframe src="https://www.youtube.com/embed/{{ $video->video_id }}" width="100%" height="auto"
                    allowfullscreen="true"></iframe>
            @endif
        </div>
    </div>
</div>
