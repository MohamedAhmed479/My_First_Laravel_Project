@extends('admin.master')

@section('title', 'Edit Category')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header">
            <strong class="card-title">Edit Category</strong>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.categories.update', ['category' => $category]) }}" method="POST">
                @csrf
                @method("PATcH")
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="Enter Category Name" value="{{ $category->name }}">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="form-group mb-3">
                            <label for="description">Description</label>
                            <input type="text" id="description" name="description" class="form-control"
                                placeholder="Enter Category Description" value="{{ $category->description }}">
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                    </div>

                </div> <!-- /.col -->

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div> <!-- / .card -->
@endsection
