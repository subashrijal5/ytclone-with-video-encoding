<?php

namespace App\Http\Livewire\Video;

use App\Models\Channel;
use App\Models\Video;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $video;
    public $channel;
    public function mount(Channel $channel)
    {
        $this->videos = $channel;
        // dd($this->videos);
    }
    public function render()
    {
        return view('livewire.video.index')
            ->extends('layouts.app')
            ->with('videos', $this->channel->videos()->paginate(10));
    }
    public function delete(Video $video)
    {
        $this->authorize('delete', $video);
        $deleted = Storage::disk('videos')->deleteDirectory($video->uid);
        if ($deleted) {
            $video->delete();
        }
        // session()->flash(['message' => 'Video deleted successfully']);
        return back();
    }
}
