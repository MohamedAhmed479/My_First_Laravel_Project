@extends('admin.master')

@section('title', 'Shipped Orders')

@php
    use Carbon\Carbon;
@endphp

@section('content')

    <!-- simple table -->
    <div class="col-md-12 my-4">

        <div class="card shadow">
            <div class="card-body">
                <h5 class="card-title">Shipped Orders</h5>
                <x-success-alert key='success'></x-success-alert>


                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Order ID</th>
                            <th>Customer ID</th>
                            <th>Status</th>
                            <th>Net Total</th>
                            <th>Items</th>
                            <th>Cancel</th>
                            <th>Details</th>
                            <th>Delivered</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($shippedOrders) > 0)
                            @foreach ($shippedOrders as $order)
                                <tr>
                                    <td>{{ $shippedOrders->firstItem() + $loop->index }}</td>
                                    <td>{{ $order->id }}</td>
                                    <td>
                                        <a
                                            href="{{ Route('admin.viewSpecificCustomer', ['customer' => $order->customer]) }}">
                                            {{ $order->customer_id }}
                                        </a>
                                    </td>
                                    <td>{{ $order->status }}</td>
                                    <td>{{ $order->net_total }}</td>



                                    {{-- Show order items --}}
                                    <td>
                                        <a href="{{ Route('admin.showOrderItems', ['order' => $order]) }}"
                                            class="btn btn-sm btn-warning">
                                            Show
                                        </a>
                                    </td>

                                    {{-- Cancel order --}}
                                    <td>
                                        <form id="cancelOrderForm-{{ $order->id }}"
                                            action="{{ Route('admin.cancelOrder', ['order' => $order]) }}" method="POST">
                                            @csrf
                                            <button type="button" class="btn btn-sm btn-dark"
                                                onclick="confirmCancel({{ $order->id }})">
                                                Cancel
                                            </button>
                                        </form>
                                        <script>
                                            function confirmCancel(orderId) {
                                                if (confirm('Are you sure you want to cancel this order?')) {
                                                    document.getElementById('cancelOrderForm-' + orderId).submit();
                                                }
                                            }
                                        </script>
                                    </td>

                                    {{-- Done show order --}}
                                    <td>
                                        <a href="{{ Route('admin.showOrder', ['order' => $order]) }}"
                                            class="btn btn-sm btn-primary">
                                            View
                                        </a>
                                    </td>

                                    {{-- Delivered --}}
                                    <td>
                                        <form id="deliveredForm-{{ $order->id }}"
                                            action="{{ Route('admin.deliveredAndPaid', ['order' => $order]) }}"
                                            method="POST">
                                            @csrf
                                            <button type="button" class="btn btn-sm btn-success"
                                                onclick="confirmdelivered({{ $order->id }})">
                                                Delivered
                                            </button>
                                        </form>
                                        <script>
                                            function confirmdelivered(orderId) {
                                                if (confirm('Are you sure this order has been delivered and paid for?')) {
                                                    document.getElementById('deliveredForm-' + orderId).submit();
                                                }
                                            }
                                        </script>
                                    </td>

                                </tr>
                            @endforeach
                        @else
                            <x-empty-alert></x-empty-alert>
                        @endif

                    </tbody>
                </table>
                {{ $shippedOrders->render('pagination::bootstrap-4') }}

            </div>
        </div>
    </div> <!-- simple table -->

@endsection
