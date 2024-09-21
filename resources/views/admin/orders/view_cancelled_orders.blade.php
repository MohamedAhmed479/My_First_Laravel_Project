@extends('admin.master')

@section('title', 'View Cancelled Orders')

@php
    use Carbon\Carbon;
@endphp

@section('content')

    <!-- simple table -->
    <div class="col-md-12 my-4">
        <div class="card shadow">
            <div class="card-body">
                <h5 class="card-title">All Cancelled Orders</h5>

                <x-success-alert key='success'></x-success-alert>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Order ID</th>
                            <th>Customer ID</th>
                            <th>Status</th>
                            <th>Items</th>
                            <th>Details</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($cancelledOrders) > 0)
                            @foreach ($cancelledOrders as $order)
                                <tr>
                                    <td>{{ $cancelledOrders->firstItem() + $loop->index }}</td>
                                    <td>{{ $order->id }}</td>
                                    <td>
                                        <a
                                            href="{{ Route('admin.viewSpecificCustomer', ['customer' => $order->customer]) }}">
                                            {{ $order->customer_id }}
                                        </a>
                                    </td>
                                    </td>
                                    <td>{{ $order->status }}</td>

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

                                    {{-- Delete Order If cancelled --}}
                                    <td>
                                        <form id="deleteOrder-{{ $order->id }}"
                                            action="{{ Route('admin.deleteOrder', ['order' => $order]) }}" method="POST">
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


                                </tr>
                            @endforeach
                        @else
                            <x-empty-alert></x-empty-alert>
                        @endif

                    </tbody>
                </table>
                {{ $cancelledOrders->render('pagination::bootstrap-4') }}

            </div>
        </div>
    </div> <!-- simple table -->

@endsection
