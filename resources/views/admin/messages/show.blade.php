@extends('admin.master')

@section('title', 'View Message')


@section('content')
    <div class="card shadow mb-4">
        <div class="card-header">
            <strong class="card-title">{{ $message->name }} Message</strong>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">

                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <input type="text" value="{{ $message->name }}" disabled='' id="name" name="name" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="email" value="{{ $message->email }}" disabled='' id="email" name="email" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="message">Message</label>
                        <textarea name="message" disabled='' id="message" class="form-control" cols="30" rows="10">{{ $message->message }}</textarea>
                    </div>

                </div> <!-- /.col -->
            </div> <!-- /.col -->
        </div>
    </div> <!-- / .card -->

@endsection
