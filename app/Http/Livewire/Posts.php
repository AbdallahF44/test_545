<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class Posts extends Component
{
    public $title, $body;

    protected $rules = [
        'title' => 'required|min:3',
        'body' => 'required|min:10',
    ];

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function storePostData()
    {
        $this->validate();
        Post::create([
            'title' => $this->title,
            'body' => $this->body,
        ]);

        toastr()->success(ucfirst($this->title) . " Post Added Successfully.");

        $this->reset();

        //For hide modal after add student success
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        $posts = Post::all();
        return view('livewire.posts.posts', ['posts' => $posts])->layout('posts.all');
    }
}
