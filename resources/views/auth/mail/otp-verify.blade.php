@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 100vh">
            <div class="col-6">
                <div class="card">
                    <div class="card-body p-5">

                        @if (session('message'))
                            <div class="alert alert-danger text-center">
                                {{ session('message') }}
                            </div>
                        @endif

                        <p class="text-center">
                            Please enter the 4-digit code sent to
                            <strong>{{ $email }}</strong>
                            to verify your email address.
                        </p>

                        <form action="{{ route('verify-otp') }}" method="post"
                            class="d-flex flex-column gap-3 align-items-center">
                            @csrf

                            <input type="text" name="otp" class="form-control w-25 fs-3 text-center" maxlength="4">

                            @error('otp')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                            <button type="submit" class="btn btn-warning w-75">
                                Continue
                            </button>
                        </form>

                        <form action="{{ route('resendOtp') }}" method="post">
                            @csrf
                            <p class="text-center mt-3">
                                Don't receive the email?
                                <button type="submit" class="text-primary btn btn-link p-0">Click to Resend</button>
                            </p>
                        </form>
                            </p>

                        {{-- <div class="text-center mt-3">
                            <a href="{{ route('login') }}"><i class="bi bi-arrow-left"></i> Back to Login</a>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
