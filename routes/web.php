<?php

use App\Http\Middleware\PostMiddleware;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Home route
Route::get('/', function () {
    return redirect()->route('blog');
})->name('home');

// Blog routes
Route::prefix('blog')->group(function () {
    Route::get('/', function () {
        return view('blog', ['currentCategory' => null]);
    })->name('blog');

    Route::get('/{category}', function ($category) {
        return view('blog', ['currentCategory' => $category]);
    });

    Route::get('/post/{post}', function ($post) {
        return view('post')->with('post', Post::findOrFail($post));
    })->name('post');
});

// Dashboard routes
Route::prefix('dashboard')->middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect()->route('dashboard.posts');
    })->name('dashboard');

    Route::get('/posts', function () {
        return view('dashboard.posts', [
            'posts' => Auth::user()->posts()->orderBy('created_at', 'desc')->get()
        ]);
    })->name('dashboard.posts');

    Route::prefix('edit')->group(function () {
        Route::get('/post', function () {
            return view('dashboard.edit.post', ['post' => new Post(), 'isEdit' => false]);
        })->name('dashboard.post.create');

        Route::get('/post/{id}', function ($id) {
            $post = Post::findOrFail($id);
            return view('dashboard.edit.post', [
                'post' => $post,
                'isEdit' => true
            ]);
        })->name('dashboard.post.edit')->middleware(PostMiddleware::class);
    });

    Route::get('/logout', function () {
        Auth::logout();
        session()->flush();
        return redirect('/');
    })->name('logout');
});

// Authentication routes for guests
Route::middleware('guest')->group(function () {
    Route::get('/dashboard/login', function () {
        return view('dashboard.login');
    })->name('login');

    Route::get('/dashboard/register', function () {
        return view('dashboard.register');
    })->name('register');
});
