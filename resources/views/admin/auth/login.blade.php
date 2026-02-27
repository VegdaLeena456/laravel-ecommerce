@extends('admin.layouts.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 100vh">
            <div class="col-6">
                <h1 class="text-center my-4">Login</h1>
                <div class="card">
                    @error('email')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="card-body">
                        <form action=" {{ route('adminlogin.store') }} " method="post">
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
                               <div class="text-center">
                                 <button type="submit" class="btn btn-primary fs-5 w-25">Login</button>
                               </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
