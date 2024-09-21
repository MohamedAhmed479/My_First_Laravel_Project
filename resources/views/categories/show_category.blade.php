@extends('admin.master')

@section('title', 'Show Category')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" disabled="" class="form-control" value="{{ $category->name }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="description">Description</label>
                        <input type="text" id="description" name="description" disabled="" value="{{ $category->description }}" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="created_at">Created At</label>
                        <input type="text" id="created_at" name="created_at" disabled="" value="{{ $category->created_at->format("d M Y") }}" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="updated_at">Updated At</label>
                        <input type="text" id="updated_at" name="updated_at" disabled="" value="{{ $category->updated_at->format("d M Y") }}" class="form-control">
                    </div>

                </div> <!-- /.col -->
            </div>
        </div> <!-- / .card -->
    @endsection
