<x-layout :categories="$categories">
    <x-slot:title>
        E-Shop | Cart Products
    </x-slot:title>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Product ID</th>
                <th scope="col">Unit Price</th>
                <th scope="col">Quantity</th>
                <th class="text-end" scope="col">Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach (auth()->user()->cartProducts as $cartProduct)
                <tr>
                    <th scope="row">
                        <span class="btn btn-sm btn-danger me-2 remove-btn" data-id="{{ $cartProduct->id }}">X</span>
                        {{ $loop->iteration }}
                    </th>
                    <td>{{ $cartProduct->product->title }} {{ $cartProduct->color ? ' - ' . $cartProduct->color->name : '' }}</td>
                    <td class="unit-price">{{ $cartProduct->product->price }}</td>
                    <td style="width: 180px">
                        <div class="input-group">
                            <div class="input-group-text minus-btn" >-</div>
                            <input type="number"
                            class="form-control qty"
                            value="{{$cartProduct->quantity}}"
                            placeholder="Quantity"
                            aria-label="Input group example"
                            aria-describedby="btnGroupAddon">
                            <div class="input-group-text plus-btn" >+</div>
                        </div>

                    </div>
                 </td>
                    <td class="price text-end">{{ $cartProduct->quantity * $cartProduct->product->price }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="4"></td>
                <td class="text-end">Total: <span id="totalPrice">0</span></td>
            </tr>
        </tbody>
    </table>
    @push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const removeBtns = document.querySelectorAll('.remove-btn');

            removeBtns.forEach(function(btn) {
                const id = btn.getAttribute('data-id');

                btn.addEventListener('click', function() {
                    fetch(`/cart-products/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            btn.parentElement.parentElement.remove();
                            updateTotalPrice();
                            alert(data.message);
                        } else {
                            alert('Something went wrong');
                        }
                    })
                    .catch(err => console.log(err));
                });
            });

            function updateTotalPrice() {
                const linePrices = document.querySelectorAll('.price');
                let totalPrice = 0;

                linePrices.forEach(function(priceElement) {
                    totalPrice += parseFloat(priceElement.innerText);
                });

                document.getElementById('totalPrice').innerText = totalPrice.toFixed(2);
            }

            updateTotalPrice();
        });

        const plusBtn = document.querySelectorAll('.plus-btn');
          plusBtn.forEach(function(btn) {
          btn.addEventListener('click', function() {
            const qtyInput = this.previousElementSibling;
            qtyInput.value = parseInt(qtyInput.value)+1;
        });
    });

    const minusBtn = document.querySelectorAll('.minus-btn');
    minusBtn.forEach(function(btn) {
        btn.addEventListener('click', function() {

            const qtyInput = this.nextElementSibling;
            if(qtyInput.value ==1 ){
                alert('Minimun quantity 1')
                return;
            }
            qtyInput.value = parseInt(qtyInput.value)-1;


        });
    });

    </script>
    @endpush
</x-layout>


minus btn is not work
