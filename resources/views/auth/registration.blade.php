@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row my-md-4 mx-md-5 my-2">
            <div class="col-12">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item fs-5"><a href="{{ route('login') }}">Customer Login</a></li>
                        <li class="breadcrumb-item active fs-5" aria-current="page">SignUp</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!----------------- Registration Form  ------------------>
    <div class="container">
        <div class="row align-items-center justify-content-center my-5">
            <div class="col-lg-6 col-md-10 col-12">
                <div class="card">
                    <div class="card-body px-lg-5 ">
                        <form action=" {{ route('registration.store') }} " enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="my-3 d-flex align-items-center justify-content-center">
                                <div class="text-center mb-4 position-relative">
                                    <!-- Profile Preview -->
                                    <img id="profilePreview" src="" class="rounded-circle border shadow"
                                        width="130" height="130" style="object-fit: cover; ">

                                    <!-- Hidden File Input -->
                                    <span id="editIcon"
                                        class="position-absolute bg-primary rounded-circle shadow d-flex align-items-center justify-content-center"
                                        style="width:35px; height:35px; bottom:5px; right:5px; cursor:pointer;">
                                        <i class="bi bi-pencil-fill text-white"></i>
                                    </span>
                                </div>
                                <input type="file" name="profile_image" id="profileInput" class="d-none"
                                    accept="image/*">
                            </div>

                            <div class="my-3">
                                <label for="name" class="form-label required">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter your name">
                                @error('name')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>

                            <div class="my-3">
                                <label for="email" class="form-lable required">Email</label>
                                <input type="email" name="email" id="email" placeholder="Enter yout email"
                                    class="form-control">
                                @error('email')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>

                            <div class="my-3">
                                <label for="password" class="form-label required">Password</label>
                                <input type="password" name="password" id="password" class="form-control">
                                @error('password')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>

                            <div class="my-3">
                                <label for="password_confirmation" class="form-label required">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control">
                                @error('password_confirmation')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>

                            <div class="my-3">
                                <label for="number" class="form-label required">Contact Number</label>
                                <input type="text" name="number" id="number" class="form-control">
                                @error('number')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>

                            <div class="my-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea name="address" id="" cols="30" rows="5" class="form-control"> </textarea>
                                @error('address')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>

                            <div class="my-3">
                                <label for="country" class="form-label">Country</label>
                                <select name="country" placeholder="Enter your Country" id="country" class="form-select">
                                    <option value="" disabled selected>Enter your contry</option>
                                    <option value="India">India</option>
                                    <option value="Canada ">Canada </option>
                                    <option value="Australia ">Australia </option>
                                    <option value="United Kingdom ">United Kingdom </option>
                                </select>
                                @error('country')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>

                            <div class="my-3">
                                <label for="gender" class="form-label">Gender</label>
                                <div class="row">
                                    <div class="col-11">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="male"
                                                value="male">
                                            <label class="form-check-label" for="male">Male</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="female"
                                                value="female">
                                            <label class="form-check-label" for="female">Female</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="other"
                                                value="other">
                                            <label class="form-check-label" for="other">Other</label>
                                        </div>
                                    </div>
                                </div>
                                @error('gender')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary px-5 my-4">Sign Up</button>
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
        const editIcon = document.getElementById('editIcon')
        const profileInput = document.getElementById('profileInput')
        const profilePreview = document.getElementById('profilePreview')

        editIcon.addEventListener('click', () => {
            profileInput.click();
        })

        profileInput.addEventListener('change', function(event) {
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    profilePreview.src = e.target.result;
                }

                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
