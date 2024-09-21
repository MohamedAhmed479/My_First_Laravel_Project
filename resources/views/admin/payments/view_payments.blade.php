@extends('admin.master')

@section('title', 'View Payments')


@section('content')
    <form class="form-inline mr-auto searchform text-muted" method="POST" action="{{ Route('admin.searchOrderPayment') }}">
        @csrf
        <input class="form-control mr-sm-2 bg-transparent border-0 pl-4 text-muted" type="search" placeholder="Enter Order Id"
            aria-label="Search" name="payment_search">
        <br>
        <x-input-error :messages="$errors->get('payment_search')" class="mt-2" />
    </form>

    <!-- simple table -->
    <div class="col-md-12 my-4">
        <div class="card shadow">
            <div class="card-body">
                <h5 class="card-title">Payments</h5>

                <x-success-alert key='success'></x-success-alert>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Order ID</th>
                            <th>Order Status</th>
                            <th>Amount</th>
                            <th>Payment Method</th>
                            <th>Payment Status</th>
                            <th>Payment Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($payments) > 0)
                            @foreach ($payments as $payment)
                                <tr>
                                    <td>{{ $payments->firstItem() + $loop->index }}</td>
                                    <td>{{ $payment->user->username }}</td>
                                    <td>
                                        <a href="{{ Route('admin.viewSpecificOrder', ['order' => $payment->order]) }}">
                                            {{ $payment->order->id }}
                                        </a>
                                    </td>
                                    <td>{{ $payment->order->status }}</td>
                                    <td>{{ $payment->amount }}</td>
                                    <td>{{ $payment->payment_method }}</td>
                                    @if ($payment->payment_status == 'successful')
                                        <td>
                                            <span class="badge badge-success">{{ $payment->payment_status }}</span>
                                        </td>
                                    @else
                                        <td>
                                            <span class="badge badge-danger">{{ $payment->payment_status }}</span>
                                        </td>
                                    @endif

                                    <td>{{ $payment->payment_date == null ? 'Not yet' : $payment->payment_date->format('d/m/Y H:i') }}
                                    </td>

                                </tr>
                            @endforeach
                        @else
                            <x-empty-alert></x-empty-alert>
                        @endif

                    </tbody>
                </table>
                {{ $payments->render('pagination::bootstrap-4') }}

            </div>
        </div>
    </div> <!-- simple table -->

@endsection
