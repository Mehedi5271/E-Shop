<x-layout :categories="$categories">
    <x-slot:title>
        E-Shop | Category Products
    </x-slot>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <div class="col">
            <div class="card shadow-sm">
                <img src="{{ asset('./storage/images/' . $product->image) }}" class="card-img-top" width="100%" height="225" alt="...">
                <div class="card-body">
                    <p class="card-text">{{ $product->title }}</p>
                    <h5 class="card-text">Price: {{ $product->price }}</h5>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <form action="{{ route('cart.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                Quantity: <input type="number" name="quantity" placeholder="Quantity" required>
                                @if (count($product->colors))

                                Color:
                                <select name="color_id" required>
                                    @foreach ($product->colors as $color)
                                    <option value="{{ $color->id }}">{{ $color->name }}</option>
                                    @endforeach
                                </select>
                                @endif
                                <br><br>
                                <button type="submit" class="btn btn-sm btn-outline-primary">Add To Cart</button>
                            </form>
                            {{-- <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
