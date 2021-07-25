<?php

namespace App\Http\Livewire\Video;

use App\Models\Channel;
use App\Models\Video;
use Livewire\Component;

class Edit extends Component
{
    public Channel $channel;
    public Video $video;
    protected $rules = [
        'video.title' => 'required|max:255',
        'video.description' => 'nullable|max:1000',
        'video.visibility' => 'required|in:published,private,unlisted',
    ];
    public function mount($channel, $video)
    {
        $this->channel = $channel;
        $this->video = $video;
    }
    public function render()
    {
        return view('livewire.video.edit')->extends('layouts.app');
    }
    public function update()
    {
        $this->validate();
        $this->video->update([
            'title' => $this->video->title,
            'description' => $this->video->description,
            'visibility' => $this->video->visibility,
        ]);

        session()->flash('message', 'Video updated successfully');
    }
}
