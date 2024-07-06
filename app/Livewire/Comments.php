<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Component;

class Comments extends Component
{
    public $Post;
    public $Comments;
    public $commentContent;

    public function mount($postId): void {
        $this->Post = Post::find($postId);
        $this->Comments = $this->Post->comments()->orderBy('created_at', 'desc')->get();
    }

    public function render() {
        return view('livewire.comments');
    }

    public function deleteComment($commentId): void {
        $comment = Comment::find($commentId);
        $comment->delete();

        // Refresh comments
        $this->Comments = $this->Post->comments()->orderBy('created_at', 'desc')->get();
    }

    public function addComment(): void {
        $this->validate([
            'commentContent' => 'required',
        ]);

        $comment = new Comment();
        $comment->post_id = $this->Post->id;
        $comment->user_id = auth()->user()->id;
        $comment->content = $this->commentContent;
        $comment->save();

        $this->resetValidation();
        $this->commentContent = '';

        // Refresh comments
        $this->Comments = $this->Post->comments()->orderBy('created_at', 'desc')->get();
    }
}
