<x-layout :categories="$categories" >
    <x-slot:title>
        E-Shop | Category Products
    </x-slot>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        @foreach ($products as $product)
            <div class="col">
                <div class="card shadow-sm">
                    <img src="{{ asset('./storage/images/' . $product->image) }}" class="card-img-top" width="100%" height="225" alt="...">
                    <div class="card-body">
                        <p class="card-text">{{ $product->title }}</p>
                        <h5 class="card-text">Price: {{ $product->price }}</h5>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a  type="button" class="btn btn-sm btn-outline-secondary" href="{{route('product.details',$product->slug)}}">View</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-layout>
