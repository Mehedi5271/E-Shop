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
                <th class="text-end" scope="col">Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach (auth()->user()->cartProducts as $cartProduct)
                <tr>
                    <th   scope="row"> <span class="btn btn-sm btn-danger me-2 remove-btn" data-id="{{$cartProduct->id}}"  >X</span> {{ $loop->iteration }}</th>
                    <td>{{ $cartProduct->product->title }} {{ $cartProduct->color ? ' - ' . $cartProduct->color->name : '' }}</td>
                    <td>{{ $cartProduct->quantity }}</td>
                    <td class="price text-end">{{ $cartProduct->product->price }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3"></td>
                <td class="text-end">Total: <span id="totalPrice">0</span></td>
            </tr>
        </tbody>
    </table>
    @push('script')
    <script>
       const removeBtn = document.querySelectorAll('.remove-btn');
            removeBtn.forEach(function(btn) {

                const id = btn.getAttribute('data-id')
             btn.addEventListener('click', function(){
                fetch('/cart-products/'+id,{
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
                })
                .then(res => res.json())
                .then(data=>{
                    if(data.success==true){
                        btn.parentElement.parentElement.remove();
                        updateTotalPrice()
                        alert(data.message)

                    }else{
                        alert('something wrong')
                    }
                })
                .catch(err =>console.log(err));


             })
           });

           updateTotalPrice()

          function updateTotalPrice(){
            const elementPrice = document.querySelectorAll('.price');
               let totalPrice = 0;
                elementPrice.forEach(function(element){
                    totalPrice += parseFloat(element.innerText);
                    document.getElementById('totalPrice').innerText = totalPrice;
                })

          }

    </script>

    @endpush
</x-layout>
