
<x-layout :categories="$categories" >

    <x-slot:title>
        E-Shop | Dashboard
    </x-slot>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        @foreach ($products as $product)

        <div class="col">
            <div class="card shadow-sm">
                {{-- <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg> --}}

                <img src="{{ asset('./storage/images/' . $product->image) }}" class="card-img-top" width="100%" height="225" alt="...">


                <div class="card-body">
                    <p class="card-text">{{$product->title}}</p>
                    <h5 class="card-text">Price: {{$product->price}}</h5>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <a  type="button" class="btn btn-sm btn-outline-secondary" href="{{route('product.details',$product->slug)}}">View</a>

                        </div>
                        <small class="text-muted">9 mins</small>
                    </div>
                </div>
            </div>
        </div>
        @endforeach



      </div>
</x-layout>

