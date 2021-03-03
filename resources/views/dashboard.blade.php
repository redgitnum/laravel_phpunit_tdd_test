<x-app>
Dashboard
@if($products)
    <div>
        Products
    </div>
    <table>
        <thead>
            <tr>
                <td>#</td>
                <td>Name</td>
                <td>Count</td>
                <td>Price</td>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->count }}</td>
                <td>{{ $product->price }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endif
</x-app>