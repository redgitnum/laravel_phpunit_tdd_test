<div class="w-100 bg-blue-500 text-white text-lg flex justify-between">
    <div class="p-2">
        <a href="{{ route('home') }}">Home</a>
    </div>
    <div class="flex gap-2 p-2">
        @guest
            <a href="{{ route('login') }}" class="border-r pr-2">Login</a>
            <a href="{{ route('register') }}">Register</a>
        @endguest
        @auth
            <a href="{{ route('dashboard') }}" class="border-r pr-2">{{ auth()->user()->name }}</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                @method('DELETE')
                <button>Logout</button>
            </form>
        @endauth
    </div>
</div>