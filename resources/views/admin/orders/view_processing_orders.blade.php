@extends('admin.master')

@section('title', 'Processing Orders')

@php
    use Carbon\Carbon;
@endphp

@section('content')
    <x-success-alert key='success'></x-success-alert>

    <form action="{{ Route('admin.shippingOrders') }}" method="post">
        @csrf
        <p class="mb-2"><strong>Specify the expected date of arrival of orders</strong></p>
        <div class="form-row">
            <div class="form-group col-md-8">
                <label for="arrival_date">Order arrival date</label>
                <div class="input-group">
                    <input type="text" class="form-control drgpicker" id="arrival_date" aria-describedby="button-addon2"
                        name="arrival_date">
                    <div class="input-group-append">
                        <div class="input-group-text" id="button-addon-date"><span class="fe fe-calendar fe-16"></span>
                        </div>
                    </div>
                </div>
                <x-input-error :messages="$errors->get('arrival_date')" class="mt-2" />
            </div>
        </div>
        <button type="submit" class="btn btn-sm btn-secondary">Ship</button>
    </form>

    <!-- simple table -->
    <div class="col-md-12 my-4">

        <div class="card shadow">
            <div class="card-body">
                <h5 class="card-title">Processing Orders</h5>


                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Order ID</th>
                            <th>Customer ID</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Items</th>
                            <th>Cancel</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($processingOrders) > 0)
                            @foreach ($processingOrders as $order)
                                <tr>
                                    <td>{{ $processingOrders->firstItem() + $loop->index }}</td>
                                    <td>{{ $order->id }}</td>
                                    <td>
                                        <a href="{{Route('admin.viewSpecificCustomer', ['customer' => $order->customer])}}">
                                            {{ $order->customer_id }}
                                        </a>
                                    </td>
                                    <td>{{ $order->customer->phone }}</td>
                                    <td>{{ $order->customer->address }}</td>
                                    </td>
                                    <td>{{ $order->status }}</td>



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

                                </tr>
                            @endforeach
                        @else
                            <x-empty-alert></x-empty-alert>
                        @endif

                    </tbody>
                </table>
                {{ $processingOrders->render('pagination::bootstrap-4') }}

            </div>
        </div>
    </div> <!-- simple table -->

@endsection
