<?php

namespace App\Http\Livewire;

use App\Models\Video;
use Livewire\Component;

class WatchVideo extends Component
{
    public $video;
    public function mount(Video $video)
    {
        $this->video = $video;
    }
    public function render()
    {
        return view('livewire.watch-video')->extends('layouts.app');
    }
}
