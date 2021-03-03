<x-app>
    <div class="shadow bg-white p-4">
        @if($errors->any())
            @foreach($errors->all() as $error)
            <ul class="mx-6">
                <li class="text-red-600 text-sm list-disc">
                    {{ $error }}
                </li>
            </ul>
            @endforeach
        @endif
        <div class="text-lg underline uppercase text-center">
            Register
        </div>
        <div>
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="flex flex-col items-end gap-2 m-2 p-4 text-white bg-blue-400 rounded shadow">
                    <label for="name">Name
                        <input class="ml-2 p-2 rounded text-black" type="text" name="name">
                    </label>
                    <label for="email">Email
                        <input class="ml-2 p-2 rounded text-black" type="email" name="email">
                    </label>
                    <label for="password">Password
                        <input class="ml-2 p-2 rounded text-black" type="password" name="password">
                    </label>
                    <label for="password_confirmation">Confirm password
                        <input class="ml-2 p-2 rounded text-black" type="password" name="password_confirmation">
                    </label>
                </div>
                <div class="flex flex-col">
                    <button class="bg-green-400 hover:bg-green-300 text-gray-700 font-bold m-2 p-2 rounded shadow">Register</button>
                </div>
            </form>
        </div>
    </div>
</x-app>