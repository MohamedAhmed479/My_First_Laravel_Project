@extends('front.master')


@section('content')
    <br>
    <br>

    <!-- simple table -->
    <div class="col-md-12 my-4">
        <div class="card shadow">
            <div class="card-body">
                <h5 class="card-title">Your orders</h5>

                <x-success-alert key='success'></x-success-alert>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Order Code</th>
                            <th>Delivery Time</th>
                            <th>Status</th>
                            <th>Net Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($orders) > 0)
                            @foreach ($orders as $order)
                                @if ($order->status != 'in_the_cart')
                                    <tr>
                                        <td>{{ $orders->firstItem() + $loop->index }}</td>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->delivery_time == null ? 'To be determined later' : $order->delivery_time->format('d M Y') }}
                                        </td>
                                        <td>{{ $order->status }}</td>
                                        <td>{{ $order->net_total }}</td>

                                        <td>
                                            {{-- Button to show spasific admin Route('admin.show', ['admin' => $admin]) --}}
                                            <a href="{{ Route('orders.details', ['order' => $order]) }}"
                                                class="btn btn-sm btn-primary">
                                                Show
                                            </a>
                                        </td>
                                    </tr>
                                @endif
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

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

@endsection
