@extends('admin.master')

@section('title', 'Show Product')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">

            <div class="row">
                <div class="col-md-12 d-flex justify-content-center">
                    <img src="{{ asset("storage/products/$product->image") }}" alt="{{ $product->name }}"
                        style="width: 200px; height: 200px; border-radius: 50%; object-fit: cover;">
                </div>

                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="id">ID</label>
                        <input type="text" id="id" name="id" disabled="" class="form-control"
                            value="{{ $product->id }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" disabled="" class="form-control"
                            value="{{ $product->name }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="code">Code</label>
                        <input type="text" id="code" name="code" disabled="" class="form-control"
                            value="{{ $product->code }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="description">Description</label>
                        <input type="text" id="description" name="description" disabled=""
                            value="{{ $product->description }}" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="star">Star</label>
                        <input type="text" id="star" name="star" disabled="" class="form-control"
                            value="{{ $product->star }}">
                    </div>

                </div> <!-- /.col -->

                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="price">Price</label>
                        <input type="text" id="price" name="price" disabled="" class="form-control"
                            value="{{ $product->price }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="stock">Stock</label>
                        <input type="text" id="stock" name="stock" disabled="" class="form-control"
                            value="{{ $product->stock }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="category">Category</label>
                        <input type="text" id="category" name="category" disabled="" class="form-control"
                            value="{{ $product->category->name }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="created_at">Created At</label>
                        <input type="text" id="created_at" name="created_at" disabled=""
                            value="{{ $product->created_at->format('d M Y') }}" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="updated_at">Updated At</label>
                        <input type="text" id="updated_at" name="updated_at" disabled=""
                            value="{{ $product->updated_at->format('d M Y') }}" class="form-control">
                    </div>

                </div>
            </div>
        </div> <!-- / .card -->
    @endsection
