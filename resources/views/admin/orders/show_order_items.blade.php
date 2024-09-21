@extends('admin.master')

@section('title', 'View Order Items')

@php
    use Carbon\Carbon;
@endphp

@section('content')

    <!-- simple table -->
    <div class="col-md-12 my-4">
        <div class="card shadow">
            <div class="card-body">
                <h5 class="card-title">Order ({{ $order->id }}) Items</h5>

                <x-success-alert key='success'></x-success-alert>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product ID</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($order_items) > 0)
                            @foreach ($order_items as $order_item)
                                <tr>
                                    <td>{{ $order_items->firstItem() + $loop->index }}</td>
                                    <td>{{ $order_item->product_id }}</td>
                                    <td>{{ $order_item->price }}</td>
                                    <td>{{ $order_item->quantity }}</td>
                                    <td>{{ $order_item->amount }}</td>
                                </tr>
                            @endforeach
                        @else
                            <x-empty-alert></x-empty-alert>
                        @endif

                    </tbody>
                </table>
                {{ $order_items->render('pagination::bootstrap-4') }}

            </div>
        </div>
    </div> <!-- simple table -->

@endsection
