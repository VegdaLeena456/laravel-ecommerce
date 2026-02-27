@extends('layouts.app')

@section('content')

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

    <div class="container-fluid">
        <div class="row my-4 mx-md-5 mx-3">
            <div class="col-12">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item fs-5"><a href="{{ route('product-list') }}">Products</a></li>
                        <li class="breadcrumb-item active fs-5" aria-current="page">Product Detail</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row mx-md-5 mx-3 mb-4 justify-content-center">
            <!--------- Left side - Product Image  ----------->
            <div class="col-md-3 col-12">
                <img src=" {{ asset('storage/' . $product->thumbnail) }} " width="100%" class="rounded border-4"
                    data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImage(this.src)" alt="">
                <div class="row flex-column align-items-center justify-content-center gap-3 my-4">
                    <div class="col-6">
                        <form action=" {{ route('add-to-cart', $product->id) }} " method="post">
                            @csrf
                            <button type="submit" class="btn btn-primary my-3 p-2 w-100" style="font-size: 18px">Add to
                                cart</button>
                        </form>
                    </div>
                    <div class="col-6">
                        <a href=" {{ route('checkout') }} " class="btn btn-warning w-100 py-2">Buy Now</a>
                    </div>
                </div>
            </div>

            <!--------- Right side - Product Details ----------->
            <div class="col-md-8 col-12 p-lg-3 py-3">
                <div class="details">
                    <h2> {{ $product->name }} </h2>
                    <h3> Price: ${{ $product->price }} </h3>
                    <p class="fs-5 text-muted"> Category: {{ $product->type }} </p>
                    <p class="text-muted pe-lg-5 me-lg-5"> {{ $product->description }} </p>
                </div>
            </div>
        </div>

        <!--------- Image Model ----------->
        <div class="modal fade" id="imageModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <img id="modalImage" class="img-fluid rounded">
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <!--------- Product Gallery ----------->
        @if ($product->gallery)
            <div class="row mt-4 px-lg-5 px-3 mx-lg-5">
                <h2 class="mb-3 ">Gallery</h2>
                @foreach ($product->gallery as $image)
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="gallery py-3">
                            <img src=" {{ asset('storage/' . $image) }}" data-bs-toggle="modal" data-bs-target="#imageModal"
                                onclick="showImage(this.src)" style="object-fit: cover" width="100%" height="350"
                                class=" border-4  " alt="">
                        </div>
                    </div>
                @endforeach
        @endif
    </div>
    </div>
@endsection

@section('scripts')
    <script>
        function showImage(src) {
            document.getElementById('modalImage').src = src;
        }
    </script>
@endsection
