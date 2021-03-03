<x-app>
    <div class="shadow bg-white w-auto p-4">
        @if(session('success'))
            <div class="m-2 mx-6 text-green-600 text-sm list-disc">
                {{ session('success') }}
            </div>
        @endif
        <div class="text-lg underline uppercase text-center">
            Dashboard
        </div>
        @if($products)
            <div class="underline pb-2">
                Products
            </div>
            <table class="table-auto">
                <thead class="bg-gray-300">
                    <tr>
                        <td class="p-2 border-r-2 border-gray-200">#</td>
                        <td class="p-2 border-r-2 border-gray-200">Name</td>
                        <td class="p-2 border-r-2 border-gray-200">Count</td>
                        <td class="p-2">Price</td>
                        <td class="p-2">Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td class="p-2 border-r-2 border-t-2 border-gray-200 @if($loop->even) bg-gray-100 @endif">{{ $product->id }}</td>
                        <td class="p-2 border-r-2 border-t-2 border-gray-200 @if($loop->even) bg-gray-100 @endif">{{ $product->name }}</td>
                        <td class="p-2 border-r-2 border-t-2 border-gray-200 @if($loop->even) bg-gray-100 @endif">{{ $product->count }}</td>
                        <td class="p-2 border-t-2 border-gray-200 @if($loop->even) bg-gray-100 @endif">{{ $product->price }}</td>
                        <td class="p-2 border-t-2 flex gap-1 border-gray-200 @if($loop->even) bg-gray-100 @endif">
                            <a href="{{ route('products.edit', ['product' => $product->id]) }}" class="p-1 px-2 bg-blue-500 hover:bg-blue-400 text-white rounded">Edit</a>
                            <form action="#">
                            @csrf
                            @method('DELETE')
                                <button class="p-1 px-2 bg-red-500 hover:bg-red-400 text-white rounded">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

</x-app>