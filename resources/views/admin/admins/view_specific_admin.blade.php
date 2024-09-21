@extends('admin.master')

@section('title', 'View Specific Admins')

@php
    use Carbon\Carbon;
@endphp

@section('content')

    <form class="form-inline mr-auto searchform text-muted" method="POST" action="{{ Route('admin.searchAdmin') }}">
        @csrf
        <input class="form-control mr-sm-2 bg-transparent border-0 pl-4 text-muted" type="search" placeholder="Enter Admin Id"
            aria-label="Search" name="admin_search">
        <br>
        <x-input-error :messages="$errors->get('admin_search')" class="mt-2" />
    </form>
    <!-- simple table -->
    <div class="col-md-12 my-4">
        <div class="card shadow">
            <div class="card-body">
                <h5 class="card-title">View Specific Admins</h5>

                <x-success-alert key='success'></x-success-alert>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Last Active</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                                <tr>
                                    <td>{{ $admin->username }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ $admin->rule }}</td>

                                    @if ($admin->last_activity >= Carbon::now()->subMinutes(15))
                                        <td><span class="badge badge-success">Active</span></td>
                                    @elseif ($admin->last_activity >= Carbon::now()->subDays(30))
                                        <td><span class="badge badge-primary">Inactive</span></td>
                                    @else
                                        <td><span class="badge badge-danger">Long Inactive</span></td>
                                    @endif

                                    <td>{{ $admin->last_activity->diffForHumans() }}</td>
                                    <td>
                                        {{-- Button to edit spasific admin --}}
                                        <x-action-button href="{{ Route('admin.edit', ['admin' => $admin]) }}"
                                            shape="btn-success" class="fe-edit"></x-action-button>

                                        {{-- Button to show spasific admin --}}
                                        <x-action-button href="{{ Route('admin.show', ['admin' => $admin]) }}"
                                            shape=" btn-primary" class="fe-eye"></x-action-button>

                                        {{-- Button to delete spasific admin --}}
                                        <x-delete-button
                                            href="{{ route('admin.destroy', ['admin' => Crypt::encrypt($admin->id)]) }}"></x-delete-button>
                                    </td>
                                </tr>

                    </tbody>
                </table>

            </div>
        </div>
    </div> <!-- simple table -->

@endsection
