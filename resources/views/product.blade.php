<x-app>
    <div class="text-lg">
        @if(!$product)Add new @else Edit @endif Product 
    </div>
    <form action="" method="">
        <label for="name">Name
            <input type="text" name="name" @if($product) value="{{ $product->name }}" @endif>
        </label>
        <label for="count">Count
            <input type="text" name="count" @if($product) value="{{ $product->count }}" @endif>
        </label>
        <label for="price">Price
            <input type="text" name="price" @if($product) value="{{ $product->price }}" @endif>
        </label>
        <button type="submit">@if(!$product)Add @else Edit @endif Product</button>
    </form>
</x-app>