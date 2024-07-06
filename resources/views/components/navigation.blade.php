<div class="navbar bg-base-100 container mx-auto">
    <div class="flex-1">
        <a href="{{ route('blog') }}" class="btn btn-primary text-xl">BlogExample</a>
    </div>
    <div class="flex-none">
        <ul class="menu menu-horizontal px-1">
            @if (Auth::check())
                <li><a href="{{ route('dashboard.posts') }}" class="">My Posts</a></li>
                <li><a href="{{ route('logout') }}" class="">Logout</a></li>
            @else
                <li><a href="{{ route('register') }}" class="">Register</a></li>
                <li><a href="{{ route('login') }}" class="">Login</a></li>
            @endif

        </ul>
    </div>
</div>
