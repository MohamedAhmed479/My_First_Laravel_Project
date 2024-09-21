@extends('admin.master')

@section('title', 'View Messages')


@section('content')

    <!-- simple table -->
    <div class="col-md-12 my-4">
        <div class="card shadow">
            <div class="card-body">
                <h5 class="card-title">Messages</h5>
                <x-success-alert key='success'></x-success-alert>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Destroy</th>
                            <th>See More...</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($messages) > 0)
                            @foreach ($messages as $message)
                                <tr>
                                    <td>{{ $messages->firstItem() + $loop->index }}</td>
                                    <td>{{ $message->id }}</td>
                                    <td>{{ $message->name }}</td>
                                    <td>{{ $message->email }}</td>
                                    <td>{{ Str::substr($message->message, 0, 20) . '...' }}</td>
                                    <td>{{ $message->status }}</td>

                                    {{-- Button to delete spasific message --}}
                                    <td>
                                        <form action="{{ Route('admin.destroyMessage', ['message' => $message]) }}"
                                            method="POST" style="display: inline;" onsubmit="return confirmDelete();">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                Delete
                                            </button>
                                        </form>
                                        <script>
                                            function confirmDelete() {
                                                return confirm('Are you sure you want to delete this item?');
                                            }
                                        </script>
                                    </td>

                                    {{-- Show product category --}}
                                    <td>
                                        <a href="{{ Route('admin.showMessage', ['message' => $message]) }}"
                                            class="btn btn-sm btn-success">
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
                {{ $messages->render('pagination::bootstrap-4') }}

            </div>
        </div>
    </div> <!-- simple table -->

@endsection
