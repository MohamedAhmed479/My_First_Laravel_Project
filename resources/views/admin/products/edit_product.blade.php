@extends('admin.master')

@section('title', 'Edit Product')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header">
            <strong class="card-title">Edit Product</strong>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.products.update', ['product' => $product]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row">

                    <div class="col-md-12 d-flex justify-content-center">
                        <img src="{{ asset("storage/products/$product->image") }}" alt="{{ $product->name }}"
                            style="width: 200px; height: 200px; border-radius: 50%; object-fit: cover;">
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="Enter Product Name" value="{{ $product->name }}">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="form-group mb-3">
                            <label for="description">Description</label>
                            <input type="text" id="description" name="description" class="form-control"
                                placeholder="Enter Product Description" value="{{ $product->description }}">
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="form-group mb-3">
                            <label for="price">Price</label>
                            <input type="text" id="price" name="price" class="form-control"
                                placeholder="Enter Product price" value="{{ $product->price }}">
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>
                    </div>

                    <div class="col-md-6">

                        <div class="form-group mb-3">
                            <label for="stock">Stock</label>
                            <input type="number" id="stock" name="stock" class="form-control"
                                placeholder="Enter Product stock" value="{{ $product->stock }}">
                            <x-input-error :messages="$errors->get('stock')" class="mt-2" />
                        </div>

                        {{-- Dropdown category here --}}
                        <div class="form-group mb-3">
                            <label for="category_id">Category</label>
                            <select id="category_id" name="category_id" class="form-control">
                                <option value="{{ $product->category->id }}" selected>{{ $product->category->name }}
                                </option>
                                @if (count($categories) > 0)
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        </div>

                        <div class="form-group mb-3">
                            <label for="image">Image</label>
                            <input type="file" id="image" name="image" class="form-control"
                                placeholder="Enter Product Image">
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
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
