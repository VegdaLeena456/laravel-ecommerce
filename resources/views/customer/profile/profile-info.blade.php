@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="row px-md-5 my-4 justify-content-center">
            <div class="col-12 d-flex justify-content-between">
                <h4>Customer Profile</h4>
                <a href=" {{ route('profile.edit') }} " class="btn btn-primary">+ Edit Profile</a>
            </div>
        </div>

        <div class="row justify-content-center p-md-4 p-0">
            <div class="col-lg-5 col-md-6 col-12">
                <div class="card">
                    <div class="card-body p-2">
                        <div class="container my-5">
                            <!-- Nav tabs -->
                            <ul class="nav nav-pills justify-content-center mb-4 " id="myTab" role="tablist">
                                <div class="col-4">
                                    <li class="nav-item px-md-3 px-1" role="presentation">
                                        <button class="nav-link text-center w-100 active" data-bs-toggle="tab"
                                            data-bs-target="#profile" type="button">
                                            Profile
                                        </button>
                                    </li>
                                </div>

                                <div class="col-4">
                                    <li class="nav-item px-md-3 px-1" role="presentation">
                                        <button class="nav-link text-center w-100" data-bs-toggle="tab"
                                            data-bs-target="#order" type="button">
                                            Order
                                        </button>
                                    </li>
                                </div>

                                <div class="col-4">
                                    <li class="nav-itempx-md-3 px-1" role="presentation">
                                        <button class="nav-link text-center w-100" data-bs-toggle="tab"
                                            data-bs-target="#favorites" type="button">
                                            Favorites
                                        </button>
                                    </li>
                                </div>
                            </ul>

                            <!-- Profile Info Tab -->

                            <div class="tab-content py-3 px-md-3 px-0">

                                <div class="tab-pane fade show active" id="profile">

                                    <div class="card">
                                        <div class="card-body p-md-5">
                                            <div class="text-center py-4">
                                                <img src=" {{ asset('storage/' . auth()->user()->profile_image) }} "
                                                    class="rounded-circle border shadow" width="130" height="130"
                                                    style="object-fit: cover; ">
                                            </div>

                                            <div class="my-3 mx-md-3">
                                                <label for="name" class="form-label">Name</label>
                                                <input class="form-control" name="name" type="text"
                                                    value=" {{ auth()->user()->name }} " aria-label="Disabled input example"
                                                    disabled readonly>
                                            </div>
                                            <div class="my-3 mx-md-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input class="form-control" name="email" type="email"
                                                    value=" {{ auth()->user()->email }} "
                                                    aria-label="Disabled input example" disabled readonly>
                                            </div>
                                            <div class="my-3 mx-md-3">
                                                <label for="number" class="form-label ">Contact Number</label>  
                                                <input class="form-control" type="text"
                                                    value=" {{ auth()->user()->number }} "
                                                    aria-label="Disabled input example" disabled readonly>
                                            </div>
                                            <div class="my-3 mx-md-3">
                                                <label for="address" class="form-label ">Address</label>
                                                <textarea name="address" class="form-control" cols="30" rows="5" disabled readonly> {{ auth()->user()->address }} </textarea>
                                            </div>

                                            <div class="my-3 mx-md-3">
                                                <label for="name" class="form-label ">Country</label>
                                                <input class="form-control" type="text"
                                                    value=" {{ auth()->user()->country }} "
                                                    aria-label="Disabled input example" disabled readonly>
                                            </div>

                                            <div class="my-3 mx-md-3">
                                                <label for="name" class="form-label">Gender</label>
                                                <div class="row">
                                                    <div class="col-11">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="gender"
                                                                id="male" value="male"
                                                                {{ auth()->user()->gender == 'male' ? 'checked' : '' }}
                                                                disabled>
                                                            <label class="form-check-label" for="male">Male</label>
                                                        </div>

                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="gender"
                                                                id="female" value="female"
                                                                {{ auth()->user()->gender == 'female' ? 'checked' : '' }}
                                                                disabled>
                                                            <label class="form-check-label" for="female">Female</label>
                                                        </div>

                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="gender"
                                                                id="other" value="other"
                                                                {{ auth()->user()->gender == 'other' ? 'checked' : '' }}
                                                                disabled>
                                                            <label class="form-check-label" for="other">Other</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <!--------------- Order Info Tab ------------->
                                <div class="tab-pane fade" id="order">
                                    @if ($orders->isEmpty())
                                        <div class="text-center py-5">
                                            <i class="bi bi-cart fs-1"></i>
                                            <h4>No Orders Yet</h4>
                                            <p>Start shopping to place your first order!</p>
                                            <a href="{{ route('product-list') }}" class="btn btn-primary">
                                                Shop Now
                                            </a>
                                        </div>
                                    @else
                                        @foreach ($orders as $order)
                                            @foreach ($order->items as $item)
                                                <div class="card mb-3 position-relative">
                                                    <div class="row g-0">
                                                        <div class="col-md-4">
                                                            <img src= "{{ asset('storage/' . $item->product->thumbnail) }}"
                                                                class="img-fluid rounded-start w-100 object-fit-cover"
                                                                alt="no-product-img" style="height: 250px">
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="card-body">
                                                                <h5 class="card-title"> {{ $item->product->name }}
                                                                </h5>
                                                                <p class="card-text fs-5">
                                                                    ${{ number_format($item->price * $item->quntity, 2) }}
                                                                </p>
                                                                <p class="card-text"> <strong>Category:</strong>
                                                                    {{ $item->product->type }} </p>
                                                                <a href=" {{ route('products.details', $item->product->id) }}  "
                                                                    class="btn btn-primary">More Info</a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endforeach
                                    @endif

                                </div>

                                <!--------------- Wishlist Info Tab ------------->
                                <div class="tab-pane fade" id="favorites">

                                    @if (isset($favorite) && count($favorite) > 0)
                                        @foreach ($favorite as $id => $item)
                                            <div class="card mb-3 position-relative">
                                                <a href="{{ route('favorite.delete', $id) }}" class="position-absolute"
                                                    style="top: 10px; right:10px;">
                                                    <i class="bi bi-x-circle-fill text-black fs-3"></i>
                                                </a>

                                                <div class="row g-0">
                                                    <div class="col-md-4">
                                                        <img src="{{ asset('storage/' . $item['image']) }}"
                                                            class="img-fluid rounded-start w-100 object-fit-cover"
                                                            alt="no-product-img" style="height: 250px">
                                                    </div>

                                                    <div class="col-md-8">
                                                        <div class="card-body">
                                                            <h5 class="card-title">{{ $item['name'] }}</h5>
                                                            <p class="card-text fs-5">$ {{ $item['price'] }}</p>
                                                            <p class="card-text">
                                                                <strong>Category:</strong> {{ $item['type'] }}
                                                            </p>

                                                            <a href="{{ route('products.details', $id) }}"
                                                                class="btn btn-primary">
                                                                More Info
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="text-center py-5">
                                            <i class="bi bi-heart fs-1 text-muted"></i>
                                            <h4 class="mt-3">Your Wishlist is Empty</h4>
                                            <p class="text-muted">Looks like you haven't added anything yet.</p>
                                            <a href="{{ route('product-list') }}" class="btn btn-primary mt-2">
                                                Start Shopping
                                            </a>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
