@extends('admin.master')

@section('title', 'View Products')


@section('content')

    <!-- simple table -->
    <div class="col-md-12 my-4">
        <div class="card shadow">
            <div class="card-body">
                <h5 class="card-title">Products Category</h5>

                <x-success-alert key='success'></x-success-alert>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th width="10%">Image</th>
                            <th>Product Name</th>
                            <th>stock</th>
                            <th>Category</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($products) > 0)
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->code }}</td>
                                    <td>
                                        <img src="{{ asset("storage/products/$product->image") }}"
                                            alt="{{ $product->name }}" style="width: 50px; height: 50px;">
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->stock }}</td>
                                    {{-- Show product category --}}
                                    <td>
                                        <a href="{{  Route('admin.viewSpecificCategory', ['category' => $product->category]) }}"
                                            class="btn btn-sm btn-warning">
                                            Show {{$product->category->name}}
                                        </a>
                                    </td>

                                    <td>
                                        {{-- Button to edit spasific product --}}
                                        <x-action-button href="{{ Route('admin.products.edit', ['product' => $product]) }}"
                                            shape="btn-success" class="fe-edit"></x-action-button>

                                        {{-- Button to show spasific product --}}
                                        <x-action-button href="{{ Route('admin.products.show', ['product' => $product]) }}"
                                            shape=" btn-primary" class="fe-eye"></x-action-button>

                                        {{-- Button to delete spasific product --}}
                                        <x-delete-button
                                            href="{{ route('admin.products.destroy', ['product' => $product]) }}"></x-delete-button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <x-empty-alert></x-empty-alert>
                        @endif

                    </tbody>
                </table>

            </div>
        </div>
    </div> <!-- simple table -->

@endsection
