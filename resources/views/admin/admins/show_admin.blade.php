@extends('admin.master')

@section('title', 'Show Admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" disabled="" class="form-control" value="{{ $admin->username }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" disabled="" value="{{ $admin->email }}" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="role">Role</label>
                        <input type="text" id="role" name="role" disabled="" value="{{ $admin->rule }}" class="form-control">
                    </div>
                </div> <!-- /.col -->

                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="phone">Phone</label>
                        <input type="text" id="phone" name="phone" disabled="" value="{{ $admin->phone }}" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" disabled="" value="{{ $admin->address }}" class="form-control">
                    </div>
                </div>
            </div>
        </div> <!-- / .card -->
    @endsection
