@extends('admin.master')

@section('title', 'View Categories')

@php
    use Carbon\Carbon;
@endphp

@section('content')

    <!-- simple table -->
    <div class="col-md-12 my-4">
        <div class="card shadow">
            <div class="card-body">
                <h5 class="card-title">Categories</h5>

                <x-success-alert key='success'></x-success-alert>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Category Name</th>
                            <th>Description</th>
                            <th>Created At</th>
                            <th>Products</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($categories) > 0)
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $categories->firstItem() + $loop->index }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td>{{ $category->created_at->format('d M Y') }}</td>

                                    {{-- Show category items --}}
                                    <td>
                                        <a href="{{ Route('admin.viewCategoryProducts', ['category' => $category]) }}"
                                            class="btn btn-sm btn-warning">
                                            Show
                                        </a>
                                    </td>

                                    <td>
                                        {{-- Button to edit spasific customer --}}
                                        <x-action-button
                                            href="{{ Route('admin.categories.edit', ['category' => $category]) }}"
                                            shape="btn-success" class="fe-edit"></x-action-button>

                                        {{-- Button to show spasific customer --}}
                                        <x-action-button
                                            href="{{ Route('admin.categories.show', ['category' => $category]) }}"
                                            shape=" btn-primary" class="fe-eye"></x-action-button>

                                        {{-- Button to delete spasific customer --}}
                                        <x-delete-button
                                            href="{{ route('admin.categories.destroy', ['category' => $category]) }}"></x-delete-button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <x-empty-alert></x-empty-alert>
                        @endif

                    </tbody>
                </table>
                {{ $categories->render('pagination::bootstrap-4') }}

            </div>
        </div>
    </div> <!-- simple table -->

@endsection
