@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div id="flash-message" class="alert alert-danger alert-dismissible fade show mx-md-5 mx-3 my-3 " role="alert">

            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> </button>
        </div>
        <script>
            setTimeout(function() {
                let alert = document.getElementById('flash-message');
                if (alert) {
                    let bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }
            }, 3000);
        </script>
    @endif

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 px-md-5 px-3">
                <h3 class="px-lg-5 px-md-3 mt-4">Cart Product</h3>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row my-5 mx-md-4 px-md-5 px-3">

            @if (empty($cart))
                <div class="col-6 d-flex align-items-center justify-content-center w-100">
                    <div class="card w-50">
                        <div class="card-body">
                            <div class="text-center py-5">
                                <i class="bi bi-cart fs-1 "></i>
                                <h4 class="mt-3">Your Cart is Empty</h4>
                                <p class="text-muted">Looks like you haven't added anything yet.</p>
                                <a href="{{ route('product-list') }}" class="btn btn-primary mt-2">
                                    Start Shopping
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-md-8">
                    @foreach ($cart as $id => $item)
                        <div class="card mb-3 position-relative">
                            <div class="total position-absolute" style="top: 20px; right:20px;">
                                <p class="m-0 text-end">Sub-total</p>
                                <h3 class="fw-bold"> ${{ $item['subtotal'] }} </h3>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-3 ">
                                    <img src= " {{ asset('storage/' . $item['image']) }} "
                                        class="rounded-start object-fit-cover p-3" alt="no-product-img" width="300" height="300">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body text-center text-md-start">
                                        <h5 class="card-title"> {{ $item['name'] }} </h5>
                                        <p class="card-text fs-5"> $ {{ $item['price'] }} </p>
                                        <p class="card-text"> <strong>Category:</strong> {{ $item['type'] }} </p>

                                        <form action="{{ route('cart.update', $id) }}" method="POST" class="quantity-form">
                                            @csrf
                                            <div class="input-group mx-auto mx-md-0 border rounded my-3 justify-content-center"
                                                style="width:130px; background-color:#f0f0f0">
                                                <button type="button" class="btn  decrease">−</button>
                                                <input type="text" name="quantity" value="{{ $item['quantity'] }}"
                                                    min="1"
                                                    class="form-control border-0 quantity-input text-center bg-transparent"
                                                    readonly>
                                                <button type="button" class="btn  increase">+</button>
                                            </div>
                                        </form>
                                        <a href=" {{ route('cart.remove', $id) }} " class="btn btn-secondary">Remove
                                            Item</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h1>Cart Total</h1>
                        </div>
                        <div class="card-body px-4" style="font-size: 18px">
                            <form action="">
                                <label  class="form-label d-block">Add Coupon</label>
                                <div class="mb-3 d-flex gap-4">
                                    <input type="text" name="coupon" class="form-control">
                                    <button type="button" class="btn btn-secondary">Apply</button>
                                </div>
                            </form>
                            <hr>
                            <table class="table table-borderless">
                                <tr>
                                    <td>Discount</td>
                                    <td class=" text-end ">-</td>
                                </tr>
                                <tr>
                                    <td>Estimated Total</td>
                                    <td class="fw-bold text-end"> $ {{ $grandTotal }} </td>
                                </tr>
                            </table>

                            <div class="text-center py-4">
                                <a href=" {{ route('checkout') }} " class="btn btn-dark px-5 py-2 fs-5">Processed to
                                    Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.querySelectorAll('.quantity-form').forEach(form => {

            let input = form.querySelector('.quantity-input');
            let increase = form.querySelector('.increase');
            let decrease = form.querySelector('.decrease');

            increase.addEventListener('click', function() {
                input.value = parseInt(input.value) + 1;
                form.submit();
            });

            decrease.addEventListener('click', function() {
                if (input.value > 1) {
                    input.value = parseInt(input.value) - 1;
                    form.submit();
                }
            });

            input.addEventListener('change', function() {
                if (input.value < 1) input.value = 1;
                form.submit();
            });

        });
    </script>
@endsection
