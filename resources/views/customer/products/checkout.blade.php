@extends('layouts.app')

@section('content')

<section class="checkout">
    <div class="container-fluid px-lg-5 px-3">
        
        <h3 class="section-title py-3 px-3">  {{ __('message.checkout') }}</h3>
        <form action="{{ route('place-order') }}" method="POST">
            @csrf

            <div class="row justify-content-center py-md-5 py-3">

                <!-- Billing Section -->
                <div class="col-md-6 ">

                    <div class="card mx-lg-5 mb-5">
                        <div class="card-body">

                            <h4 class="mb-4">{{ __('message.billing_details') }}</h4>

                            <div class="row mb-3">
                                <div class="col-6">
                                    <label class="form-label required"> {{ __('message.first_name') }}</label>
                                    <input type="text" name="first_name" class="form-control">
                                    @error('first_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label class="form-label required">{{ __('message.last_name') }}</label>
                                    <input type="text" name="last_name" class="form-control">
                                    @error('last_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label required"> {{ __('message.country') }}</label>
                                <select name="country" class="form-select">
                                    <option value=""> {{ __('message.select_country') }}</option>
                                    <option value="India">{{ __('message.india') }}</option>
                                    <option value="Canada"> {{ __('message.canada') }}</option>
                                </select>
                                @error('country')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label required"> {{ __('message.address') }}</label>
                                <input type="text" name="address" class="form-control">
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label required"> {{ __('message.city') }}</label>
                                <input type="text" name="city" class="form-control">
                                @error('city')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label required"> {{ __('message.state') }}</label>
                                <input type="text" name="state" class="form-control">
                                @error('state')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label required"> {{ __('message.zip') }}</label>
                                <input type="text" name="zip" class="form-control">
                                @error('zip')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label required"> {{ __('message.phone') }}</label>
                                <input type="text" name="phone" class="form-control">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label required"> {{ __('message.email') }}</label>
                                <input type="email" name="email" class="form-control">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="mb-4"> {{ __('message.order_summary') }}</h4>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th> {{ __('message.product') }}</th>
                                        <th> {{ __('message.subtotal') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php $grandTotal = 0; @endphp

                                    @foreach($cart as $item)
                                        @php
                                            $subtotal = $item['price'] * $item['quantity'];
                                            $grandTotal += $subtotal;
                                        @endphp

                                        <tr>
                                            <td>
                                                <img src="{{ asset('storage/'.$item['image']) }}"
                                                     width="50" height="50"
                                                     style="object-fit:cover;">
                                                {{ $item['name'] }} × {{ $item['quantity'] }}
                                            </td>
                                            <td>₹{{ $subtotal }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>

                                <tfoot>
                                    <tr class="fw-bold">
                                        <td> {{ __('message.total') }}</td>
                                        <td>₹{{ $grandTotal }}</td>
                                    </tr>
                                </tfoot>
                            </table>

                            <!-- Payment -->
                            <div class="mt-3">
                                <input type="radio" name="payment_method" value="cod" checked>
                               {{ __('message.cash_on_delivery') }}
                                <div class="text-muted small">
                                    {{ __('message.pay_with_cash_upon_delivery') }}
                                </div>
                            </div>

                            <button type="submit" class="btn btn-dark w-100 mt-4 py-2">
                               {{ __('message.place_order') }}
                            </button>

                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
</section>

@endsection