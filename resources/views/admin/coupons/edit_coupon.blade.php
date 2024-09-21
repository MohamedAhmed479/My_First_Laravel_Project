@extends('admin.master')

@section('title', 'Edit Coupon')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header">
            <strong class="card-title">Edit Coupon</strong>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.coupons.update', ['coupon' => $coupon]) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="code">Coupon Code</label>
                            <input type="text" id="code" name="code" class="form-control"
                                placeholder="Enter Coupon Code" value="{{ $coupon->code }}">
                            <x-input-error :messages="$errors->get('code')" class="mt-2" />
                        </div>

                        <div class="form-group mb-3">
                            <label for="percentage">Coupon Percentage</label>
                            <input type="text" id="percentage" name="percentage" class="form-control"
                                placeholder="Enter Coupon Percentage" value="{{ $coupon->percentage }}">
                            <x-input-error :messages="$errors->get('percentage')" class="mt-2" />
                        </div>

                        <div class="form-row">
                            <label for="expiration_date">Coupon Expiration Date</label>
                            <div class="input-group">
                                <input type="text" class="form-control drgpicker" id="expiration_date"
                                    aria-describedby="button-addon2" name="expiration_date">
                                <div class="input-group-append">
                                    <div class="input-group-text" id="button-addon-date"><span
                                            class="fe fe-calendar fe-16"></span>
                                    </div>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('expiration_date')" class="mt-2" />
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Edit Coupon</button>
                        </div>
                    </div> <!-- /.col -->

                </div> <!-- /.col -->
            </form>
        </div>
    </div> <!-- / .card -->
@endsection
