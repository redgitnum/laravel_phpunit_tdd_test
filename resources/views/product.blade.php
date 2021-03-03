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
            @if(!isset($product))Add new @else Edit @endif()Product 
        </div>
        <div>
            <form action="{{ route('products.update', ['product' => $product->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="flex flex-col items-end gap-2 m-2 p-4 text-white bg-blue-400 rounded shadow">
                    <label for="name">Name
                        <input class="ml-2 p-2 rounded text-black" type="text" name="name"  @if(isset($product)) value="{{ $product->name }}" @endif >
                    </label>
                    <label for="count">Count
                        <input class="ml-2 p-2 rounded text-black" type="number" name="count" @if(isset($product)) value="{{ $product->count }}" @endif>
                    </label>
                    <label for="price">Price
                        <input class="ml-2 p-2 rounded text-black" type="number" name="price" @if(isset($product)) value="{{ $product->price }}" @endif>
                    </label>
                </div>
                <div class="flex flex-col">
                    <button class="bg-green-400 hover:bg-green-300 text-gray-700 font-bold m-2 p-2 rounded shadow">
                        @if(!isset($product)) Add @else Update @endif Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app>