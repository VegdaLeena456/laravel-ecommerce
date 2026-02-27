<nav class="navbar navbar-expand-lg px-md-5 py-3" style="background-color: #f1f1f1 !important;">
    <div class="container-fluid">
        <a class="navbar-brand" href=" {{ route('admin.products') }} ">
            <h3>E-Commerce Store</h3>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                        data-bs-toggle="dropdown">

                        <div class="rounded-circle bg-black text-white d-flex justify-content-center align-items-center p-4"
                            style="width:35px; height:35px; font-weight:bold; font-size:1.2rem">
                           {{ strtoupper(substr(Auth::guard('master_admin')->user()->name, 0, 1)) }}
                        </div>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="bi bi-box-arrow-right me-3 fs-5"></i>
                                    Logout
                                </button>
                            </form>
                        </li>
                        <li>
                            <a href=" {{ route('admin.coupons') }} " class="dropdown-item"><i class="bi bi-ticket  me-3 fs-5"></i>Coupon</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
