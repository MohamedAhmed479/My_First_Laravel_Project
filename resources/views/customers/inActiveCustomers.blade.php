@extends('admin.master')

@section('title', 'Long Inactive Customers')


@section('content')

    <!-- simple table -->
    <div class="col-md-12 my-4">
        <div class="card shadow">
            <div class="card-body">
                <h5 class="card-title">Long Inactive Customers (More than 90 days)</h5>

                <x-success-alert key='success'></x-success-alert>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>status</th>
                            <th>Last Active</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($inactiveCustomers) > 0)
                            @foreach ($inactiveCustomers as $customer)
                                <tr>
                                    <td>{{ $inactiveCustomers->firstItem() + $loop->index }}</td>
                                    <td>{{ $customer->username }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td><span class="badge badge-danger">Long Inactive</span></td>
                                    <td>{{ $customer->last_activity->diffForHumans() }}</td>
                                    <td>
                                        {{-- Button to delete spasific customer --}}
                                        <x-delete-button
                                            href="{{ route('admin.destroyCustomer', ['customer' => $customer, 'id' => $customer->id]) }}"></x-delete-button>
                                    </td>
                            @endforeach
                        @else
                            <x-empty-alert></x-empty-alert>
                        @endif

                    </tbody>
                </table>
                {{ $inactiveCustomers->render('pagination::bootstrap-4') }}

            </div>
        </div>
    </div> <!-- simple table -->

@endsection
