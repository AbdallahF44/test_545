<?php

namespace App\Http\Livewire\Comments;

use App\Models\Comment;
use Livewire\Component;

class Index extends Component
{
    public $title;
    public $content;
    public $comment_id;
    public $edit_comment_title;
    public $view_comment_title;
    public $view_comment_content;
    protected $rules = [
        'title' => 'required|min:3',
        'content' => 'required|min:10',
    ];

    public function store()
    {
        $this->validate();
        Comment::create([
            'title' => $this->title,
            'content' => $this->content,
        ]);
        $this->reset();
        toastr()->success("Comment Successfully Added.");
        $this->dispatchBrowserEvent('close-modal');
//        return redirect()->to('/comments');
    }

    public function edit($id)
    {
        $comment = Comment::findorFail($id);
        $this->comment_id = $id;
        $this->edit_comment_title = $comment->title;
        $this->title = $comment->title;
        $this->content = $comment->content;
    }

    public function update()
    {
        $this->validate();
        $comment = Comment::find($this->comment_id);
        $comment->update([
            'title' => $this->title,
            'content' => $this->content,
        ]);
        toastr()->success('Comment successfully Updated.');
        $this->reset();

        $this->dispatchBrowserEvent('close-modal');
//        return redirect()->to('/comments');
    }

    public function delete($id)
    {
        $comment = Comment::findorFail($id);
        $this->comment_id = $id;
        $this->title = $comment->title;
    }

    public function destroy()
    {
        Comment::destroy($this->comment_id);
        $this->reset();
        toastr()->success('Comment successfully Deleted.');
        $this->dispatchBrowserEvent('close-modal');
//        return redirect()->to('/comments');
    }

    public function viewComment($id)
    {
        $comment = Comment::where('id', $id)->first();

        $this->view_comment_title = $comment->title;
        $this->view_comment_content = $comment->content;
    }

    public function closeView()
    {
        $this->view_comment_title = '';
        $this->view_comment_content = '';
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function render()
    {
        $comments = Comment::all();
        return view('livewire.comments.index', ['comments' => $comments])->layout('comments.all');
    }
}
