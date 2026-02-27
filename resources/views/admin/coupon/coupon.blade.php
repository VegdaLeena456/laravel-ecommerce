@extends('admin.layouts.app')

@section('content')
    <section class="coupon">
        <div class="container">
            <div class="row justify-content-between mt-5">
                <div class="col-8">
                    <h3>Coupon</h3>
                </div>
                <div class="col-3">
                    <div class="text-end">
                        <a href=" {{ route('admin.coupon.add') }} " class="btn btn-outline-primary"> + Add Coupon </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered my-5 text-center">
                            <thead>
                                <div class="tr">
                                    <td>#</td>
                                    <td>Code</td>
                                    <td>Type</td>
                                    <td>Value</td>
                                    <td>Cart Value</td>
                                    <td>Expiry Date</td>
                                    <td>Action</td>
                                </div>
                            </thead>
                            <tbody>
                                @foreach ($coupons as $coupon)
                                    <tr>
                                        <td> {{ $coupon->id }} </td>
                                        <td> {{ $coupon->code }} </td>
                                        <td> {{ $coupon->type }} </td>
                                        <td> {{ $coupon->value }} </td>
                                        <td> {{ $coupon->cart_value }} </td>
                                        <td> {{ $coupon->expired_at }} </td>
                                        <td class="d-flex align-items-center justify-content-center  gap-3">
                                            <a href=" {{ route('admin.coupon.edit', $coupon->id) }} "><i
                                                    class="bi bi-pencil text-success"></i></a>
                                            <button type="button" class="btn btn-link p-0" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $coupon->id }}">
                                                <i class="bi bi-trash3 text-danger "></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="deleteModal{{ $coupon->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="couponModalLabel">Confirm Delete</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this Coupon? This action cannot be
                                                    undone.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <form action=" {{ route('admin.coupon.delete', $coupon->id) }} "
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="flex items-center wgp-pagination">
                        {{ $coupons->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
