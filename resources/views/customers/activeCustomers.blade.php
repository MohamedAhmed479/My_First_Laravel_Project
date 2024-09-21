@extends('admin.master')

@section('title', 'Active Customers')


@section('content')
    <!-- simple table -->
    <div class="col-md-12 my-4">
        <div class="card shadow">
            <div class="card-body">
                <h5 class="card-title">Active Customers</h5>

                <x-success-alert key='success'></x-success-alert>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>status</th>
                            <th>Last Active</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($activeCustomers) > 0)
                            @foreach ($activeCustomers as $customer)
                                <tr>
                                    <td>{{ $activeCustomers->firstItem() + $loop->index }}</td>
                                    <td>{{ $customer->username }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td><span class="badge badge-success">Active</span></td>
                                    <td>{{ $customer->last_activity->diffForHumans() }}</td>
                            @endforeach
                        @else
                            <x-empty-alert></x-empty-alert>
                        @endif

                    </tbody>
                </table>
                {{ $activeCustomers->render('pagination::bootstrap-4') }}

            </div>
        </div>
    </div> <!-- simple table -->

@endsection
