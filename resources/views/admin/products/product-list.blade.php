@extends('admin.layouts.app')

@section('content')
    @if (session('success') || session('delete'))
        @php
            $type = session('success') ? 'success' : 'danger';
            $message = session('success') ?? session('delete');
        @endphp

        <div id="flash-message" class="alert alert-{{ $type }} alert-dismissible fade show mx-5 my-3" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>

        <script>
            setTimeout(function() {
                let alert = document.getElementById('flash-message');
                if (alert) {
                    new bootstrap.Alert(alert).close();
                }
            }, 3000);
        </script>
    @endif

    <section class="product-list">
        <div class="container-fluid ">
            <div class="row px-lg-5 px-md-4 px-3">
                <div class="col-12 d-flex align-items-center justify-content-between mt-5 mb-4">
                    <h3>Product</h3>
                    <a href=" {{ route('admin.product.create') }}" class="btn btn-primary"> <i class="bi bi-plus me-2 fs-5"></i> Product</a>
                </div>
            </div>

            <div class="row px-lg-5 px-3">
                @foreach ($products as $product)
                    <div class="col-xl-3 col-lg-4 col-md-6 p-4">
                        <div class="card " style="position: relative">

                            <!--------Edit and Delete --------->
                            <div class="icons d-flex gap-3 position-absolute" style="top:23px; right:23px">
                                <a href=" {{ route('admin.product.edit', $product->id) }}"><i
                                        class="bi bi-pencil-square text-light fs-4"></i></a>
                                <button type="button" class="btn btn-link p-0" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $product->id }}">

                                    <i class="bi bi-trash3 text-danger fs-4"></i>
                                </button>
                            </div>

                            <!--------  Product Details --------->
                            <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                class="card-img-top object-fit-cover p-3" width="300" height="300">
                            <div class="card-body">
                                <h4 class="product-name mb-3"> {{ $product->name }} </h4>
                                <h3 class="product-price mb-3"> ${{ $product->price }} </h3>
                                <h6 class="product-type mb-3 text-muted"> Category: {{ $product->type }} </h6>
                                <div class="text-center">
                                    <a href=" {{ route('admin.product.details', $product->id) }} "
                                        class="btn btn-primary my-3 ">More
                                        Info</a>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-------- Delete Modal ----->
                    <div class="modal fade" id="deleteModal{{ $product->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm Delete</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this Product? This action cannot be
                                    undone.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <form action=" {{ route('admin.product.delete', $product->id) }} " method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
