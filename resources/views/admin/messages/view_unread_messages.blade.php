@extends('admin.master')

@section('title', 'View Unread Messages')


@section('content')

    <!-- simple table -->
    <div class="col-md-12 my-4">
        <div class="card shadow">
            <div class="card-body">
                <h5 class="card-title">Unread Messages</h5>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>See More...</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($unread_messages) > 0)
                            @foreach ($unread_messages as $unread_messages)
                                <tr>
                                    <td>{{ $unread_messages->id }}</td>
                                    <td>{{ $unread_messages->name }}</td>
                                    <td>{{ $unread_messages->email }}</td>
                                    <td>{{ Str::substr($unread_messages->message, 0, 20) . '...' }}</td>

                                    {{-- Show product category --}}
                                    <td>
                                        <a href="{{ Route('admin.showMessage', ['message' => $unread_messages]) }}" class="btn btn-sm btn-success">
                                            View
                                        </a>
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
