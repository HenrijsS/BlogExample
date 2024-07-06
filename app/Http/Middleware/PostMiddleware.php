<?php

namespace App\Http\Middleware;

use App\Models\Post;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostMiddleware
{
    public function handle(Request $request, Closure $next) {
        $postId = $request->route('id');
        $post = Post::find($postId);

        if (Auth::user()->cannot('edit', $post)) {
            session()->flash('global-message', 'You do not have permission to edit this post');
            session()->flash('global-message-status', 'error');
            return redirect()->route('dashboard.posts');
        }

        return $next($request);
    }
}
