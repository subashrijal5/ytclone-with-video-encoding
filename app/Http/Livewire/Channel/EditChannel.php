<?php

namespace App\Http\Livewire\Channel;

use App\Models\Channel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;

class EditChannel extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;

    protected function rules()
    {
        return [
            'channel.name' => 'required|max:255|unique:channels,name,' . $this->channel->id,
            'channel.slug' => 'required|max:255|unique:channels,slug,' . $this->channel->id,
            'channel.description' => 'nullable|max:1000',
            'image' => 'nullable|image|max:2048|mimes:jpg,jpeg,png',
        ];
    }
    public $channel;
    public $image;

    public function mount(Channel $channel)
    {
        $this->channel = $channel;
    }
    public function render()
    {
        return view('livewire.channel.edit-channel');
    }
    public function update()
    {
        $this->authorize('update', $this->channel);
        $this->validate();
        // dd($this->image);
        $this->channel->update([
            'name' => $this->channel->name,
            'slug' => $this->channel->slug,
            'description' => $this->channel->description,
        ]);
        // check if image is submitted

        if ($this->image) {
            //save the image

            $image = $this->image->storeAs('images', $this->channel->uid . '.png');
            //resize and conversion image
            $img = Image::make(storage_path() . '/app/' . $image)
                ->encode('png')
                ->fit(80, 80, function ($constraint) {
                    $constraint->upsize();
                })->save();
            $this->channel->update([
                'image' => $image
            ]);
        }
        session()->flash('message', 'Channel updated');
        return back();
    }
}
