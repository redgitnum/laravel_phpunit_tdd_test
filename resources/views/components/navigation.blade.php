<div class="w-100 bg-blue-300 text white flex justify-between">
    <div class="p-2">
        <a href="{{ route('home') }}">Home</a>
    </div>
    <div class="flex gap-2 p-2">
        @guest
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        @endguest
        @auth
            <a href="{{ route('dashboard') }}">{{ auth()->user()->name }}</a>
            <a href="{{ route('logout') }}">Logout</a>
        @endauth
    </div>
</div>