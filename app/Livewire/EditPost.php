<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Post;
use Livewire\Component;
use Mews\Purifier\Facades\Purifier;

class EditPost extends Component
{
    public $Post;
    public $isEdit;
    public $title;
    public $content;
    public $categories;
    public $selectedCategories;

    public function mount(Post $post) {
        if ($this->isEdit) {
            $this->Post = $post;
            $this->title = $post->title;
            $this->content = $post->content;
        } else {
            $this->Post = new Post();
        }

        $this->categories = Category::all();
        $this->selectedCategories = $post->categories->pluck('id')->toArray();
    }

    public function render() {
        return view('livewire.edit-post');
    }

    public function deletePost() {
        $this->authorize('edit', $this->Post);
        //Remove categories
        $this->Post->categories()->detach();
        $this->Post->delete();
        session()->flash('global-message', 'Post deleted successfully.');
        session()->flash('global-message-status', 'success');
        return redirect()->route('dashboard.posts');
    }

    public function save() {
        // Policy check
        if ($this->isEdit) {
            $this->authorize('edit', $this->Post);
        }

        $this->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $this->Post->title = $this->title;
        $sanitizedContent = Purifier::clean($this->content);
        $this->Post->content = $sanitizedContent;
        $this->Post->user_id = auth()->user()->id;
        if ($this->isEdit) {
            $this->Post->categories()->sync($this->selectedCategories);
            $this->Post->save();
        } else {
            $this->Post->save();
            $this->Post->categories()->sync($this->selectedCategories);
        }

        session()->flash('global-message', 'Post saved successfully.');
        session()->flash('global-message-status', 'success');
        return redirect()->route('post', ['post' => $this->Post->id]);
    }
}
