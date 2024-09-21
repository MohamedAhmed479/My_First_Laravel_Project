@extends('admin.master')

@section('title', 'Edit Customer')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header">
            <strong class="card-title">Edit Customer</strong>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.updateCustomer') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" class="form-control"
                                placeholder="Enter username" value="{{ $customer->username }}">
                            <x-input-error :messages="$errors->get('username')" class="mt-2" />
                        </div>

                        <input type="hidden" name="id" value="{{ $customer->id }}">

                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="Enter email" value="{{ $customer->email }}">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="form-group mb-3">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="Enter password">
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />

                        </div>

                        <div class="form-group mb-3">
                            <label for="password">Password Confirm</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="form-control" placeholder="Enter Confirm password">
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

                        </div>

                    </div> <!-- /.col -->

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="phone">Phone</label>
                            <input type="text" id="phone" name="phone" class="form-control"
                                placeholder="Enter Phone" value="{{ $customer->phone }}">
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>

                        <div class="form-group mb-3">
                            <label for="address">Address</label>
                            <input type="text" id="address" name="address" class="form-control"
                                placeholder="Enter Address" value="{{ $customer->address }}">
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>

                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Edit Customer</button>
                    </div>
            </form>
        </div>
    </div> <!-- / .card -->
@endsection
