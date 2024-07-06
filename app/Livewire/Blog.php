<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Post;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Blog extends Component
{
    use WithPagination;


    public $currentCategory;
    public $categories;

    #[Url]
    public $search = '';

    public function mount($currentCategory = null): void {
        if ($currentCategory !== null) {
            // $currentCategory, if it's present, is the Name of the Category
            $this->currentCategory = Category::whereRaw('LOWER(name) = ?', [strtolower($currentCategory)])->first()->id;
        }
        $this->categories = Category::all();
    }

    public function render() {
        $currentCategory = $this->currentCategory;
        $posts = null;

        if ($currentCategory === null) {
            $posts = Post::orderBy('created_at', 'desc')->paginate(5);
        } else {
            $posts = Post::whereHas('categories', function ($query) use ($currentCategory) {
                $query->where('category_id', $currentCategory);
            })->orderBy('created_at', 'desc')->paginate(5);
        }

        return view('livewire.blog', [
            'posts' => $posts,
            'searchedPosts' => $this->search === '' ? null : Post::search($this->search)->orderBy('created_at', 'desc')->paginate(5),
        ]);
    }
}
