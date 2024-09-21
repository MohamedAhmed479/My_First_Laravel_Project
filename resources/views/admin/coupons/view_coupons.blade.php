@extends('admin.master')

@section('title', 'View Coupons')

@php
    use Carbon\Carbon;
@endphp

@section('content')

    <!-- simple table -->
    <div class="col-md-12 my-4">
        <div class="card shadow">
            <div class="card-body">
                <h5 class="card-title">All Coupons</h5>

                <x-success-alert key='success'></x-success-alert>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID</th>
                            <th>Code</th>
                            <th>Percentage</th>
                            <th>Expiration Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($coupons) > 0)
                            @foreach ($coupons as $coupon)
                                <tr>
                                    <td>{{ $coupons->firstItem() + $loop->index }}</td>
                                    <td>{{ $coupon->id }}</td>
                                    <td>{{ $coupon->code }}</td>
                                    <td>{{ $coupon->percentage }}</td>
                                    <td>{{ $coupon->expiration_date->format("d M Y") }}</td>

                                    <td>
                                        {{-- Button to edit spasific customer --}}
                                        <x-action-button href="{{ Route('admin.coupons.edit', ['coupon' => $coupon]) }}"
                                            shape="btn-success" class="fe-edit"></x-action-button>

                                        {{-- Button to delete spasific customer --}}
                                        <x-delete-button
                                            href="{{ route('admin.coupons.destroy', ['coupon' => $coupon]) }}"></x-delete-button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <x-empty-alert></x-empty-alert>
                        @endif

                    </tbody>
                </table>
                {{ $coupons->render('pagination::bootstrap-4') }}

            </div>
        </div>
    </div> <!-- simple table -->

@endsection
