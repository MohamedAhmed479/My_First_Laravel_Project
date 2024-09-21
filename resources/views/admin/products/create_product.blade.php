@extends('admin.master')

@section('title', 'Add New Product')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header">
            <strong class="card-title">Add New Product</strong>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="Enter Product Name">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="form-group mb-3">
                            <label for="description">Description</label>
                            <input type="email" id="description" name="description" class="form-control"
                                placeholder="Enter Product Description">
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                        <div class="form-group mb-3">
                            <label for="image">Product Image</label>
                            <input type="file" id="image" name="image" class="form-control"
                                placeholder="Enter Product Image">
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>

                        <div class="form-group mb-3">
                            <label for="category_id">Category</label>
                            <select id="category_id" name="category_id" class="form-control">
                                <option selected>Select Product Category</option>
                                @if (count($categories) > 0)
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        </div>
                    </div> <!-- /.col -->

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="price">Price</label>
                            <input type="text" id="price" name="price" class="form-control"
                                placeholder="Enter Product Price">
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>

                        <div class="form-group mb-3">
                            <label for="stock">Stock</label>
                            <input type="number" id="stock" name="stock" class="form-control"
                                placeholder="Enter Product stock">
                            <x-input-error :messages="$errors->get('stock')" class="mt-2" />
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Add Prodcts</button>
                        </div>
                    </div> <!-- /.col -->

                </div>
            </form>
        </div> <!-- / .card -->
    @endsection
