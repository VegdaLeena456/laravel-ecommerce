@extends('admin.layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row my-4 mx-5">
            <div class="col-12">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item fs-5"><a href="{{ route('admin.products') }}">Products</a></li>
                        <li class="breadcrumb-item active fs-5" aria-current="page">Product Detail</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row mx-5 mb-4 justify-content-center">
            <div class="col-3">
                <img src=" {{ asset('storage/' . $product->thumbnail) }} " width="100%" class="rounded border-4"
                    data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImage(this.src)" alt="">
            </div>

            <div class="col-8 p-3">
                <div class="details">
                    <h2> {{ $product->name }} </h2>
                    <h3> Price: ${{ $product->price }} </h3>
                    <p class="fs-5 text-muted"> Category: {{ $product->type }} </p>
                    <p class="text-muted pe-5 me-5"> {{ $product->description }} </p>
                </div>
            </div>
        </div>

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

        <div class="row mt-4 px-5 mx-5">
            <h2 class="mb-3 ">Gallery</h2>
            @if ($product->gallery)
                @foreach ($product->gallery as $image)
                    <div class="col-3">
                        <div class="gallery py-3">
                            <img src=" {{ asset('storage/' . $image) }}" data-bs-toggle="modal" data-bs-target="#imageModal"
                                onclick="showImage(this.src)" width="100%" height="350" class=" border-4  "
                                alt="">
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
