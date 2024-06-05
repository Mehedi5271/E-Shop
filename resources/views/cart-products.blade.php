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
                    <th   scope="row"> <span class="btn btn-sm btn-danger me-2 remove-btn"  >X</span> {{ $loop->iteration }}</th>
                    <td>{{ $cartProduct->product->title }} {{ $cartProduct->color ? ' - ' . $cartProduct->color->name : '' }}</td>
                    <td>{{ $cartProduct->quantity }}</td>
                    <td>{{ $cartProduct->product->price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @push('script')
    <script>
        const removeBtn = document.querySelectorAll('.remove-btn')
        console.log(removeBtn);
    </script>

    @endpush
</x-layout>
