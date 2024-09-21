@extends('admin.master')

@section('title', 'Show Order')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="code">Order Code</label>
                        <input type="text" id="code" name="code" disabled="" class="form-control" value="{{ $order->id }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="customer_id">Customer ID</label>
                        <input type="text" id="customer_id" name="customer_id" disabled="" value="{{ $order->customer_id }}" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="created_at">Created At</label>
                        <input type="text" id="created_at" name="created_at" disabled="" value="{{ $order->created_at->format("d M Y") }}" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="delivery_time">Delivery Time</label>
                        <input type="text" id="delivery_time" name="delivery_time" disabled="" value="{{ $order->delivery_time == null ? "Not yet" : $order->delivery_time->format("d M Y") }}" class="form-control">
                    </div>

                </div> <!-- /.col -->

                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="status">Status</label>
                        <input type="text" id="status" name="status" disabled="" value="{{ $order->status }}" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="total">Total</label>
                        <input type="text" id="total" name="total" disabled="" value="{{ $order->total }}" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="net_total">Net Total</label>
                        <input type="text" id="net_total" name="net_total" disabled="" value="{{ $order->net_total }}" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="coupon_id">Coupon</label>
                        <input type="text" id="coupon_id" name="coupon_id" disabled="" value="{{ $order->coupon == null ? "The order does not have a coupon." : $order->coupon->code . " and the discount value is " . $order->coupon->percentage . "%" }}" class="form-control">
                    </div>
                </div>
            </div>
        </div> <!-- / .card -->
    @endsection
