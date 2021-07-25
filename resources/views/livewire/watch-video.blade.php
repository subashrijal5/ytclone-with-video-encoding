<div>
    @push('header')
    <link href="https://vjs.zencdn.net/7.11.4/video-js.css" rel="stylesheet" />
    @endpush
    <div class="container-fluid">
        <div class="row">
            <div class="col col-md-12">

                <video id="my-video" class="video-js vjs-styles-defaults vjs-fluid vjs-big-play-centered " controls preload="auto" poster="{{ asset($video->thumbnail) }}" data-setup="{}">
                    <source src="{{ asset('videos').'/'. $video->uid .'/'. $video->processed_file }}" type="application/x-mpegURL" />
                    <p class="vjs-no-js">
                        To view this video please enable JavaScript, and consider upgrading to a
                        web browser that
                        <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                    </p>
                </video>
            </div>
        </div>
    </div>
    @push('footer')
    <script src="https://vjs.zencdn.net/7.11.4/video.min.js"></script>
    @endpush
</div>