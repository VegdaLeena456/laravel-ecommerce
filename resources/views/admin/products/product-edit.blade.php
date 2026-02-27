@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row my-4 px-5">
            <div class="col-12">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item fs-5"><a href="{{ route('admin.products') }}">Product</a></li>
                        <li class="breadcrumb-item active fs-5" aria-current="page">Add Product</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 100vh">
            <div class="col-6">
                <div class="card mb-5">
                    <div class="card-body px-lg-5 py-lg-5">
                        <form action=" {{ route('admin.product.update', $product->id) }}" enctype="multipart/form-data"
                            method="post">
                            @csrf
                            @method('PUT')
                            <div class="my-3">
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" name="name" id="" class="form-control"
                                    value="{{ $product->name }}">
                                @error('name')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                            <div class="my-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="text" name="price" id="" class="form-control"
                                    value="{{ $product->price }}">
                                @error('price')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                            <div class="my-3">
                                <label for="type" class="form-label"> Product Type</label>
                                @php
                                    $types = [
                                        'Electronics',
                                        'Fashion & Apparel',
                                        'Home & Living',
                                        'Beauty & Personal Care',
                                        'Health & Fitness',
                                        'Grocery & Daily Essentials',
                                        'Toys & Baby Products',
                                        'Books & Stationery',
                                    ];
                                @endphp
                                <select name="type" id="" class="form-control">
                                    @foreach ($types as $type)
                                        <option value=" {{ $type }} ">
                                            {{ old('type', $product->type) == $type ? 'selected' : '' }}
                                            {{ ucfirst($type) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="my-3">
                                <label for="thumbnail" class="form-label">Thumbnail</label>
                                <input type="file" name="thumbnail" class="form-control">
                                <div class="mt-2 d-flex flex-wrap">
                                    <img src=" {{ asset('storage/' . $product->thumbnail) }} " width="100" height="100"
                                        class="rounded border shadow-sm object-fit-cover" alt="">
                                </div>
                            </div>
                            <div class="my-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="" cols="30" rows="10" class="form-control"> {{ $product->description }} </textarea>
                            </div>
                            <div class="my-3">
                                <label for="gallery" class="form-label">Gallery</label>
                                <input type="file" name="gallery[]" id="galleryInput" class="form-control" multiple>
                                <div id="galleryPreview" class="mt-2 d-flex flex-wrap gap-2">
                                    @if ($product->gallery)
                                        @foreach ($product->gallery as $image)
                                            <div class="position-relative">
                                                <img src=" {{ asset('storage/' . $image) }} " width="100" height="100"
                                                    class="rounded border shadow-sm object-fit-cover" alt="">
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="text-center my-4">
                                <button type="submit" class="btn btn-primary w-25 " >Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
