<div class="container" @if($this->video->processing_percentages < 100) wire:poll @endif>
        <div class="row">
            @if($this->video->thumbnail_img)
            <div class="col-md-4">
                <img width="200px" src="{{ asset($this->video->thumbnail) }}" alt="" class="img-thumbnail">
            </div>
            @else
            <div class="col-md-4">
                <img width="200px" src="{{asset('default.png')}}" alt="" class="img-thumbnail">
            </div>
            @endif
            <div class="col-md-4">
                <h3>Proccessed: {{$this->video->processing_percentages}}</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form wire:submit.prevent="update">
                    <div class="form-group">
                        <label for="title">title</label>
                        <input type="text" wire:model="video.title" class="form-control" id="">
                    </div>
                    @error('video.title')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror

                    <div class="form-group">
                        <label for="description">description</label>
                        <textarea wire:model="video.description" cols="30" rows="4" class="form-control"></textarea>
                    </div>
                    @error('video.description')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror
                    <div class="form-group">
                        <label for="visibility">visibility</label>
                        <select wire:model="video.visibility" class="form-control">
                            <option value="published">Published</option>
                            <option value="private">private</option>
                            <option value="unlisted">unlisted</option>
                        </select>
                    </div>
                    @error('video.visibility')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                    @endif
                </form>
            </div>
        </div>
</div>