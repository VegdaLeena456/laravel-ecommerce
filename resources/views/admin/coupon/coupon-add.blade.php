@extends('layouts.app')

@section('content')

    <section class="create-coupon">
        <div class="container">
            <div class="row justify-content-center my-5 py-5">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header py-3">
                            <h3>Add Coupon Code</h3>
                        </div>
                        <div class="card-body">
                            <form action=" {{ route('admin.coupon.store') }}  " method="post">
                                @csrf
                                <div class="my-3">
                                    <label class="form-label">Coupon Code</label>
                                    <input type="text" class="form-control" placeholder="Coupon Code" name="code"
                                        value="{{ old('code') }}">
                                </div>

                                <div class="my-4">
                                    <label for="" class="form-label">Type</label>
                                    <select class="form-select" name="type" id="type">
                                        <option value="">select type</option>
                                        <option value="Fixed">Fixed</option>
                                        <option value="Percent">Percent</option>
                                    </select>
                                </div>

                                <div class="my-3">
                                    <label for="" class="form-label">Value</label>
                                    <input type="text" name="value" class="form-control">
                                </div>

                                <div class="my-3">
                                    <label for="" class="form-label">Cart Value</label>
                                    <input type="text" name="cart_value" class="form-control">
                                </div>

                                <div class="my-3">
                                    <label for="" class="form-label">Expired at</label>
                                    <input type="date" name="expired_at" class="form-control">
                                </div>

                                <div class="text-center">
                                    <button class="btn btn-primary px-5 my-3 px-1 fs-5" type="submit">Save</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @endsection
