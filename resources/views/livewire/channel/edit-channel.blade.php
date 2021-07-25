<div>
    <img src="{{asset($channel->image)}}" alt="">
    <form wire:submit.prevent="update(Object.fromEntries(new FormData($event.target)))">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" wire:model="channel.name" class="form-control" id="">
        </div>
        @error('channel.name')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
        <div class="form-group">
            <label for="slug">slug</label>
            <input type="text" wire:model="channel.slug" class="form-control" id="">
        </div>
        @error('channel.slug')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
        <div class="form-group">
            <label for="description">description</label>
            <textarea type="text" wire:model="channel.description" cols="30" rows="4" class="form-control"></textarea>
        </div>
        @error('channel.description')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
        <div class="form-group">

            <input type="file" wire:model="image" class="form-control"></input>
            <div>
                @if($image)
            </div class="form-group">
            <img src="{{$image->temporaryUrl()}}" class="image-thumbnail" width="150px" alt="">
        </div>
        @endif
        @error('image')
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