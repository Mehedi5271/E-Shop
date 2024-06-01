<x-layout :categories="$categories">
    <x-slot:title>
        E-Shop | Cart Products
    </x-slot:title>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Product ID</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach (auth()->user()->cartProducts as $cartProduct)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $cartProduct->product->title }}-({{$cartProduct->color->name}})</td>
                    <td>{{ $cartProduct->quantity }}</td>
                    <td>{{ $cartProduct->product->price }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>
