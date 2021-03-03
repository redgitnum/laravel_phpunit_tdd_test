<x-app>
    <div class="shadow bg-white w-auto p-4">
        @if(session('success'))
            <div class="m-2 mx-6 text-green-600 text-sm list-disc">
                {{ session('success') }}
            </div>
        @endif
        <div class="text-lg underline uppercase text-center">
            Homepage
        </div>
        <div class="text-center p-2">
            <a href="{{ route('login') }}" class="text-blue-400 font-bold hover:text-blue-500">Login</a> or 
            <a href="{{ route('register') }}" class="text-blue-400 font-bold hover:text-blue-500">Register</a> 
            to see more
        </div>
    </div>
</x-app>