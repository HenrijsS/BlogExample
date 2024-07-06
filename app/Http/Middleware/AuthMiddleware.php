<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthMiddleware
{
    public function handle(Request $request, Closure $next) {
        if (!Auth::check()) {
            session()->flash('global-message', 'You must be logged in to access this page');
            session()->flash('global-message-status', 'error');
            return redirect()->guest('login');
        }

        return $next($request);
    }
}
