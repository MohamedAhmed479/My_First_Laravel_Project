@extends('admin.master')

@section('title', 'Add New Admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header">
            <strong class="card-title">Add New Admin</strong>
        </div>
        <div class="card-body">
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" class="form-control"
                                placeholder="Enter username">
                            <x-input-error :messages="$errors->get('username')" class="mt-2" />
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="Enter email">
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
                                placeholder="Enter Phone">
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>

                        <div class="form-group mb-3">
                            <label for="address">Address</label>
                            <input type="text" id="address" name="address" class="form-control"
                                placeholder="Enter Address">
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>

                        <div class="form-group mb-3">
                            <label for="role">Role</label>
                            <select id="role" name="role" class="form-control">
                                <option value="admin">Admin</option>
                                <option value="super_admin">Super Admin</option>
                            </select>
                            <x-input-error :messages="$errors->get('role')" class="mt-2" />

                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Add Admin</button>
                        </div>
                    </div>


            </form>
        </div>
    </div> <!-- / .card -->
@endsection
