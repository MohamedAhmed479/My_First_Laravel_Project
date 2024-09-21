@extends('admin.master')

@section('title', 'Add New Category')

@section('content')
    <div class="card shadow mb-6">
        <div class="card-header">
            <strong class="card-title">Add New Category</strong>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="Enter Category Name">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="form-group mb-3">
                            <label for="description">Description</label>
                            <input type="text" id="description" name="description" class="form-control"
                                placeholder="Enter Category Description">
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Add Category</button>
                        </div>
                    </div> <!-- /.col -->



            </form>
        </div>
    </div> <!-- / .card -->
@endsection
