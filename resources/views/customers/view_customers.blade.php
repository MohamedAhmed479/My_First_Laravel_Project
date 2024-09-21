@extends('admin.master')

@section('title', 'View Customers')

@section('search', 'customers')

@php
    use Carbon\Carbon;
@endphp

@section('content')

    <form class="form-inline mr-auto searchform text-muted" method="POST" action="{{ Route('admin.searchCustomer') }}">
        @csrf
        <input class="form-control mr-sm-2 bg-transparent border-0 pl-4 text-muted" type="search"
            placeholder="Enter customer id" aria-label="Search" name="customer_search">
        <br>
        <x-input-error :messages="$errors->get('customer_search')" class="mt-2" />

    </form>
    <!-- simple table -->
    <div class="col-md-12 my-4">
        <div class="card shadow">
            <div class="card-body">
                <h5 class="card-title">Customers</h5>

                <x-success-alert key='success'></x-success-alert>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Last Active</th>
                            <th>Orders</th>
                            <th>Payments</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($customers) > 0)
                            @foreach ($customers as $customer)
                                <tr>
                                    <td>{{ $customers->firstItem() + $loop->index }}</td>
                                    <td>{{ $customer->id }}</td>
                                    <td>{{ $customer->username }}</td>
                                    <td>{{ $customer->email }}</td>

                                    @if ($customer->last_activity >= Carbon::now()->subMinutes(15))
                                        <td><span class="badge badge-success">Active</span></td>
                                    @elseif ($customer->last_activity >= Carbon::now()->subDays(30))
                                        <td><span class="badge badge-primary">Inactive</span></td>
                                    @else
                                        <td><span class="badge badge-danger">Long Inactive</span></td>
                                    @endif


                                    <td>{{ $customer->last_activity->diffForHumans() }}</td>

                                    <td>
                                        <a href="{{ Route('admin.viewCustomersOrders', ['customer' => $customer]) }}"
                                            class="btn btn-sm btn-warning">
                                            View
                                        </a>
                                    </td>

                                    <td>
                                        <a href="{{ Route('admin.viewCustomersPayments', ['customer' => $customer]) }}"
                                            class="btn btn-sm btn-dark">
                                            View
                                        </a>
                                    </td>

                                    <td>
                                        {{-- Button to edit spasific customer --}}
                                        <x-action-button href="{{ Route('admin.editCustomer', ['customer' => $customer]) }}"
                                            shape="btn-success" class="fe-edit"></x-action-button>

                                        {{-- Button to show spasific customer --}}
                                        <x-action-button href="{{ Route('admin.showCustomer', ['customer' => $customer]) }}"
                                            shape=" btn-primary" class="fe-eye"></x-action-button>

                                        {{-- Button to delete spasific customer --}}
                                        <x-delete-button
                                            href="{{ route('admin.destroyCustomer', ['customer' => Crypt::encrypt($customer->id)]) }}"></x-delete-button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <x-empty-alert></x-empty-alert>
                        @endif

                    </tbody>
                </table>
                {{ $customers->render('pagination::bootstrap-4') }}

            </div>
        </div>
    </div> <!-- simple table -->

@endsection
