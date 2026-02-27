@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 100vh">
            <div class="col-lg-6 col-md-10 col-12">

                <h1 class="text-center my-4">Customer Login</h1>
                <div class="card">
                    @error('email')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                    
                    <!------ Login form ------->
                    <div class="card-body px-lg-4">
                        <form action=" {{ route('login.store') }} " method="post">
                            @csrf
                            <div class="my-3">
                                <label for="name" class="form-label">Email</label>
                                <input type="email" name="email" placeholder="Enter your email" class="form-control"
                                    required>
                            </div>

                            <div class="my-3">
                                <label for="name" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required>
                                <span class="text-danger">
                                    @error('password')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="my-4">
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary fs-5  px-5">Login</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

                <div class="row justify-content-center mt-4">
                    <div class="col-lg-6 col-md-8 col-12">
                        <p class="text-center fs-5">New User? <a href=" {{ route('registration') }} "
                                class="btn btn-warning ms-4 fs-5 w-50">Sign Up</a></p>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
