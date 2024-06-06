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
                    <td class="price">{{ $cartProduct->product->price }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3"></td>
                <td>Total: <span id="totalPrice">0</span></td>
            </tr>
        </tbody>
    </table>
    @push('script')
    <script>
       const removeBtn = document.querySelectorAll('.remove-btn');
            removeBtn.forEach(function(btn) {
             btn.addEventListener('click', function(){
               btn.parentElement.parentElement.remove();
                alert('Deleted')
             })
           });

           const elementPrice = document.querySelectorAll('.price');
               let totalPrice = 0;
                elementPrice.forEach(function(element){
                    totalPrice += parseFloat(element.innerText);
                    document.getElementById('totalPrice').innerText = totalPrice;
                })


    </script>

    @endpush
</x-layout>
