<div class="container">
    <div class="card">
        <div class="row justify-content-center">
            @foreach($videos as $video)
            <div class="col col-md-12">
                <div class="card my-2" @if($video->processing_percentages < 100) wire:poll @endif>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <a href="{{route('video.watch', $video)}}">
                                        <img src="{{asset($video->thumbnail)}}" class="img-thumbnail" alt=""></a>
                                </div <div class="col-md-3">
                                <h4>{{$video->title}}</h4>
                                <p>{{$video->description}}</p>
                            </div>
                            <div class="col-md-2">
                                <strong>{{$video->visibility}}</strong>
                            </div>
                            <div class="col-md-2">
                                <strong>{{$video->created_at->format('d/m/y')}}</strong>
                            </div>
                            @if(auth()->user()->owns($video))
                            <div class="col-md-2">
                                <a href="{{route('video.edit', ['channel' => auth()->user()->channel , 'video'=> $video->uid])}}" class="btn btn-light">Edit</a>
                                <a wire:click.prevent="delete('{{$video->uid}}')" class="btn btn-danger">Delete</a>
                            </div>
                            @endif
                        </div>
                        @if(auth()->user()->owns($video))
                        <div class="row">

                            <div class="progress-bar  @if($video->processing_percentages < 100) progress-bar-striped progress-bar-animated bg-danger @else bg-success @endif " role="progressbar" aria-valuenow="{{ $video->processing_percentages }}" aria-valuemin="0" aria-valuemax="100" style="width: 100%; height:17px;">@if($video->processing_percentages < 100) Processing: {{ $video->processing_percentages }}% @else Processed @endif</div>

                            </div>
                            @endif
                        </div>
                </div>
            </div>
            @endforeach
            {{ $videos->links() }}
        </div>
    </div>
</div>