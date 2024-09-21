@extends('admin.master')

@section('title', 'View Orders')

@php
    use Carbon\Carbon;
@endphp

@section('content')

    <form class="form-inline mr-auto searchform text-muted" method="POST" action="{{ Route('admin.searchOrder') }}">
        @csrf
        <input class="form-control mr-sm-2 bg-transparent border-0 pl-4 text-muted" type="search" placeholder="Enter Order Id"
            aria-label="Search" name="order_search">
        <br>
        <x-input-error :messages="$errors->get('order_search')" class="mt-2" />

    </form>

    <!-- simple table -->
    <div class="col-md-12 my-4">
        <div class="card shadow">
            <div class="card-body">
                <h5 class="card-title">All Orders</h5>

                <x-success-alert key='success'></x-success-alert>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Order ID</th>
                            <th>Customer ID</th>
                            <th>Status</th>
                            <th>Items</th>
                            <th>Cancel</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($orders) > 0)
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $orders->firstItem() + $loop->index }}</td>
                                    <td>{{ $order->id }}</td>
                                    <td>
                                        <a
                                            href="{{ Route('admin.viewSpecificCustomer', ['customer' => $order->customer]) }}">
                                            {{ $order->customer_id }}
                                        </a>
                                    </td>
                                    <td>
                                        @if ($order->status == 'delivered')
                                            <span class="badge badge-success">{{ $order->status }}</span>
                                        @elseif($order->status == 'cancelled')
                                            <span class="badge badge-danger">{{ $order->status }}</span>
                                        @elseif($order->status == 'shipped')
                                            <span class="badge badge-primary">{{ $order->status }}</span>
                                        @elseif($order->status == 'processing')
                                            <span class="badge badge-warnning">{{ $order->status }}</span>
                                        @endif
                                    </td>



                                    @if ($order->status != 'cancelled')
                                        {{-- Show order items --}}
                                        <td>
                                            <a href="{{ Route('admin.showOrderItems', ['order' => $order]) }}"
                                                class="btn btn-sm btn-warning">
                                                Show
                                            </a>
                                        </td>

                                        @if ($order->status != 'delivered')
                                            {{-- Cancel order --}}
                                            <td>
                                                <form id="cancelOrderForm-{{ $order->id }}"
                                                    action="{{ Route('admin.cancelOrder', ['order' => $order]) }}"
                                                    method="POST">
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
                                        @else
                                            <td></td>
                                        @endif
                                    @else
                                        <td></td>
                                        {{-- Delete Order If cancelled --}}
                                        <td>
                                            <form id="deleteOrder-{{ $order->id }}"
                                                action="{{ Route('admin.deleteOrder', ['order' => $order]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-danger"
                                                    onclick="deleteOrder({{ $order->id }})">
                                                    Delete
                                                </button>
                                            </form>
                                            <script>
                                                function deleteOrder(orderId) {
                                                    if (confirm('Are you sure you want to cancel this order?')) {
                                                        document.getElementById('deleteOrder-' + orderId).submit();
                                                    }
                                                }
                                            </script>
                                        </td>
                                    @endif

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
                {{ $orders->render('pagination::bootstrap-4') }}

            </div>
        </div>
    </div> <!-- simple table -->

@endsection
