@extends('admin.master')

@section('title', 'All Delivered Orders')

@php
    use Carbon\Carbon;
@endphp

@section('content')

    <!-- simple table -->
    <div class="col-md-12 my-4">
        <div class="card shadow">
            <div class="card-body">
                <h5 class="card-title">All Delivered Orders</h5>

                <x-success-alert key='success'></x-success-alert>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Order ID</th>
                            <th>Customer ID</th>
                            <th>Status</th>
                            <th>Payment</th>
                            <th>Payment Date</th>
                            <th>Items</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($deliveredOrders) > 0)
                            @foreach ($deliveredOrders as $order)
                                <tr>
                                    <td>{{ $deliveredOrders->firstItem() + $loop->index }}</td>
                                    <td>{{ $order->id }}</td>
                                    <td>
                                        <a
                                            href="{{ Route('admin.viewSpecificCustomer', ['customer' => $order->customer]) }}">
                                            {{ $order->customer_id }}
                                        </a>
                                    </td>
                                    <td>{{ $order->status }}</td>
                                    <td>{{ $order->payment->amount }}</td>
                                    @php
                                        $paymentDate = \Carbon\Carbon::parse($order->payment->payment_date);
                                    @endphp

                                    <td>{{ $paymentDate->format('d M Y, H:i') }}</td>



                                    {{-- Show order items --}}
                                    <td>
                                        <a href="{{ Route('admin.showOrderItems', ['order' => $order]) }}"
                                            class="btn btn-sm btn-warning">
                                            Show
                                        </a>
                                    </td>


                                    {{-- Done show order --}}
                                    <td>
                                        <a href="{{ Route('admin.showOrder', ['order' => $order]) }}"
                                            class="btn btn-sm btn-primary">
                                            View
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                        @else
                            <x-empty-alert></x-empty-alert>
                        @endif

                    </tbody>
                </table>
                {{ $deliveredOrders->render('pagination::bootstrap-4') }}

            </div>
        </div>
    </div> <!-- simple table -->

@endsection
