@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row my-4 px-md-5">
            <div class="col-12">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item fs-5"><a href="{{ route('admin.products') }}">Product</a></li>
                        <li class="breadcrumb-item active fs-5" aria-current="page"></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 100vh">
            <div class="col-7">
                <div class="card">
                    <div class="card-body px-lg-5 py-lg-5">
                        <form action=" {{ route('admin.product.store') }}" enctype="multipart/form-data" method="post">
                            @csrf
                            <div class="my-3">
                                <label for="name" class="form-label required">Product Name</label>
                                <input type="text" name="name" id="" class="form-control">
                                @error('name')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                            <div class="my-3">
                                <label for="price" class="form-label required">Price</label>
                                <input type="text" name="price" id="" class="form-control" >
                                @error('price')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                            <div class="my-3">
                                <label for="type" class="form-label required"> Product Type</label>
                                <select name="type" class="form-select" id="type" >
                                    <option value=""> -- Select Product Type --</option>
                                    <option value="Electronics"> Electronics</option>
                                    <option value="Fashion & Apparel"> Fashion & Apparel</option>
                                    <option value="Home & Living"> Home & Living</option>
                                    <option value="Beauty & Personal Care"> Beauty & Personal Care</option>
                                    <option value="Health & Fitness"> Health & Fitness</option>
                                    <option value="Grocery & Daily Essentials"> Grocery & Daily Essentials</option>
                                    <option value="Toys & Baby Products"> Toys & Baby Products</option>
                                    <option value="Books & Stationery"> Books & Stationery</option>
                                </select>
                                @error('type')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>

                            <div class="my-3">
                                <label for="thumbnail" class="form-label required">Thumbnail</label>
                                <input type="file" name="thumbnail" class="form-control" >
                                @error('thumbnail')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                            <div class="my-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                            <div class="my-3">
                                <label for="gallery" class="form-label">Gallery</label>
                                <input type="file" name="gallery[]" id="galleryInput" class="form-control" multiple>
                                <div id="galleryPreview" class="mt-2 d-flex flex-wrap gap-2"></div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary px-5 my-4">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('scripts')
    <script>
        document.getElementById('galleryInput').addEventListener('change', function(event) {
            const preview = document.getElementById('galleryPreview');
            preview.innerHTML = '';

            Array.from(event.target.files).forEach(file => {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.width = '100px';
                    img.style.height = '100px';
                    img.style.objectFit = 'cover';
                    img.classList.add('rounded', 'border');
                    preview.appendChild(img);
                }

                reader.readAsDataURL(file);
            });
        });
    </script>
@endsection
