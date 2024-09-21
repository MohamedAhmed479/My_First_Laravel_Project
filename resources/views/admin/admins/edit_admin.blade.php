@extends('admin.master')

@section('title', 'Edit Admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header">
            <strong class="card-title">Edit Admin</strong>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.updateAdmin') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" class="form-control"
                                placeholder="Enter username" value="{{ $admin->username }}">
                            <x-input-error :messages="$errors->get('username')" class="mt-2" />
                        </div>

                        <input type="hidden" name="id" value="{{ $admin->id }}">

                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="Enter email" value="{{ $admin->email }}">
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
                                placeholder="Enter Phone" value="{{ $admin->phone }}">
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>

                        <div class="form-group mb-3">
                            <label for="address">Address</label>
                            <input type="text" id="address" name="address" class="form-control"
                                placeholder="Enter Address" value="{{ $admin->address }}">
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>

                        <div class="form-group mb-3">
                            <label for="rule">Role</label>
                            <select id="rule" name="rule" class="form-control">

                                <option value="{{ $admin->rule }}">{{ $admin->rule == 'admin' ? 'Admin' : 'Super Admin' }}
                                </option>
                                <option value="admin">Admin</option>
                                <option value="super_admin">Super Admin</option>

                            </select>
                            <x-input-error :messages="$errors->get('role')" class="mt-2" />
                        </div>

                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Edit Admin</button>
                    </div>
            </form>
        </div>
    </div> <!-- / .card -->
@endsection