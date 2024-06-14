<x-layout :categories="$categories">
    <x-slot:title>
        E-Shop | Cart Products
    </x-slot:title>

    <form action="{{route('orders.store')}}" method="POST">
        @csrf
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product ID</th>
                    <th scope="col">Unit Price</th>
                    <th scope="col">Quantity</th>
                    <th class="text-end" scope="col"> Total Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach (auth()->user()->cartProducts as $cartProduct)
                <tr>
                    <th scope="row">
                        <input type="hidden" name="products[{{ $loop->index }}][cart_product_id]" value="{{ $cartProduct->id }}">
                        <span class="btn btn-sm btn-danger me-2 remove-btn" data-id="{{ $cartProduct->id }}">X</span>
                        {{ $loop->iteration }}
                    </th>
                    <td>{{ $cartProduct->product->title }} {{ $cartProduct->color ? ' - ' . $cartProduct->color->name : '' }}</td>
                    <td class="unit-price">{{ $cartProduct->product->price }}</td>
                    <td style="width: 180px">
                        <div class="input-group">
                            <div class="input-group-text minus-btn" >-</div>
                            <input type="number" class="form-control qty" value="{{$cartProduct->quantity}}" placeholder="Quantity" name="products[{{ $loop->index }}][quantity]">
                            <div class="input-group-text plus-btn" >+</div>
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

        <div class="row">
            <div class="col-md-6">
                <input type="text" class="form-control" name="contact_number" value="" placeholder="Enter your contact number">
            </div>

            <div class="col-md-6">
                <input type="text" class="form-control" name="shipping_address" value="" placeholder="Enter your shipping address">
            </div>

            <div class="mt-2">
                <button type="submit" class="btn btn-primary">Place Order</button>
            </div>
        </div>
    </form>

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

            const plusBtns = document.querySelectorAll('.plus-btn');
            plusBtns.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const qtyInput = this.previousElementSibling;
                    const updateQty = parseInt(qtyInput.value) + 1;
                    qtyInput.value = updateQty;

                    const unitPriceElement = this.parentElement.parentElement.previousElementSibling;
                    const priceElement = this.parentElement.parentElement.nextElementSibling;

                    const unitPrice = parseFloat(unitPriceElement.innerText);
                    const updatePrice = unitPrice * updateQty;
                    priceElement.innerText = updatePrice.toFixed(2);

                    updateTotalPrice();
                });
            });

            const minusBtns = document.querySelectorAll('.minus-btn');
            minusBtns.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const qtyInput = this.nextElementSibling;
                    if (qtyInput.value == 1) {
                        alert('Minimum quantity is 1');
                        return;
                    }
                    const updateQty = parseInt(qtyInput.value) - 1;
                    qtyInput.value = updateQty;

                    const unitPriceElement = this.parentElement.parentElement.previousElementSibling;
                    const priceElement = this.parentElement.parentElement.nextElementSibling;

                    const unitPrice = parseFloat(unitPriceElement.innerText);
                    const updatePrice = unitPrice * updateQty;
                    priceElement.innerText = updatePrice.toFixed(2);

                    updateTotalPrice();
                });
            });
        });
    </script>
    @endpush
</x-layout>
