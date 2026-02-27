@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href=" {{ asset('css/index.css') }} ">
    <!--------------------Alert-Message ------------------->
    @if (session('success'))
        <div id="flash-message" class="alert alert-success alert-dismissible fade show mx-md-5 mx-3 my-3 " role="alert">

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

    <section class="product-list">
        <div class="container-fluid">
            <div class="row px-md-5 px-3">
                <div class="col-12 d-flex align-items-center justify-content-between mt-md-5 my-4">
                    <h3 class="title">Product</h3>
                </div>
            </div>
        </div>

        <div class="container-fluid px-md-5">
            <div class="row justify-content-md-start justify-content-center">
                @foreach ($products as $product)
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12 p-4">
                        <!------------------ Product Cards  --------------->
                        <div class="card" style="position: relative;">
                            <div class="icons w-100 justify-content-between d-flex gap-3 position-absolute">
                                @php
                                    $favorite = session('favorite', []);
                                    $isFavorite = isset($favorite[$product->id]);
                                @endphp

                                <!----- Favorite and Details Icon ----->
                                <form action="{{ route('add_to_favorite', $product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="p-4" style="border:none; background:none;">
                                        @if ($isFavorite)
                                            <i class="bi bi-heart-fill text-danger fs-4"></i>
                                        @else
                                            <i class="bi bi-heart fs-4"></i>
                                        @endif
                                    </button>
                                </form>

                                <a href=" {{ route('products.details', $product->id) }}" class="p-4"><i
                                        class="bi bi-box-arrow-up-right text-black fs-4"></i>
                                </a>

                            </div>
                            <!------------------ Product Cards Details  --------------->
                            <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                class="card-img-top object-fit-cover p-3" style="border-radius: 23px" width="300" height="300">

                            <div class="card-body">
                                <h4 class="card-title mb-3"> {{ $product->name }} </h4>
                                <h3 class="card-title mb-3"> ${{ $product->price }} </h3>
                                <h6 class="card-title mb-3 text-muted"> Category: {{ $product->type }} </h6>
                                <div class="row">
                                    <div class="col-6">
                                        <form action=" {{ route('add-to-cart', $product->id) }} " method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-primary my-3 p-2 w-100"
                                                style="font-size: 18px">Add to cart</button>
                                        </form>
                                    </div>
                                    <div class="col-6">
                                        <a href=" {{ route('checkout') }} " class="btn btn-primary my-3 p-2 w-100"
                                            style="font-size: 18px">Buy
                                            Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
