<nav class="navbar navbar-expand-lg px-md-5 py-3" style="background-color: #f1f1f1 !important;">
    <div class="container-fluid">

        <a class="navbar-brand" href=" {{ route('product-list') }} ">
            <h3>E-Commerce Store</h3>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end align-items-center" id="navbarSupportedContent">

            {{-- Guest Product Page --}}
            @guest

                <div class="nav-items d-flex justify-content-end align-items-center" style="width: 200px">

                    <div class="rounded-circle bg-black d-flex align-items-center justify-content-center position-relative"
                        style="width: 45px; height: 45px;">
                        <a href=" {{ route('cart') }}"
                            class="btn btn-dark rounded-circle d-flex justify-content-center align-items-center">
                            <i class="bi bi-cart2 text-white fs-4">
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary "
                                    style="font-size:13px; font-style:normal">
                                    {{ array_sum(array_column(session('cart', []), 'quantity')) }}
                                </span>
                            </i>
                        </a>
                    </div>
                    <a href=" {{ route('login') }}" class="btn btn-primary w-50 ms-4 p-1 fs-5">Login</a>

                </div>

            @endguest


            {{-- Logged In User Page --}}
            @auth
                <ul class="navbar-nav mb-2 mb-lg-0 align-items-center gap-3">

                    <li class="nav-item position-relative">
                        <a href=" {{ route('cart') }}"
                            class="btn btn-dark rounded-circle d-flex justify-content-center align-items-center"><i
                                class="bi bi-cart2 text-white fs-4"><span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary "
                                    style="font-size:13px; font-style:normal">
                                    {{ array_sum(array_column(session('cart', []), 'quantity')) }}
                                </span></i>
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                            data-bs-toggle="dropdown">
                            @if (empty(auth()->user()->profile_image))
                                <div class="rounded-circle bg-black text-white d-flex justify-content-center align-items-center p-3 fs-5"
                                    style="width:45px; height:45px; font-weight:bold;">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                            @else
                                <img src="{{ asset('storage/' . auth()->user()->profile_image) }}"
                                    style="width:45px; height:45px;" class="img-fluid rounded-circle" alt="">
                            @endif
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a href=" {{ route('profile') }} " class=" dropdown-item"><i
                                        class="bi bi-person-fill me-3 fs-5"></i>My
                                    Profile</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-right me-3 fs-5"></i>
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            @endauth
        </div>
    </div>
</nav>

@section('scripts')
    <script></script>
@endsection
