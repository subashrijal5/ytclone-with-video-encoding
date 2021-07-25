<?php

namespace App\Http\Livewire\Video;

use App\Jobs\ConvertVideoForStreaming;
use App\Jobs\CreateThumbnailFromVideo;
use App\Models\Channel;
use App\Models\Video;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    public Video $video;
    public Channel $channel;
    public $videoFile;
    protected $rules = [
        'videoFile' => 'required|mimes:mp4|max:12288'
    ];
    public function mount(Channel $channel)
    {
        $this->channel = $channel;
    }
    public function render()
    {
        return view('livewire.video.create')->extends('layouts.app');
    }

    public function fileCompleted()
    {
        $this->validate();
        $path = $this->videoFile->store('temp-videos');
        $name = explode('/', $path);
        $this->video = $this->channel->videos()->create([
            'title' => 'Untitled',
            'description' => 'null',
            'uid' => uniqid(true),
            'visibility' => 'unlisted',
            'path' => $name[1]
        ]);

        CreateThumbnailFromVideo::dispatch($this->video);


        ConvertVideoForStreaming::dispatch($this->video);

        return redirect()->route('video.edit', [
            'channel' => $this->channel,
            'video' => $this->video
        ]);
    }
}
