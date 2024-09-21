@extends('front.master')


@section('content')
    <div class="card shadow mb-4">
        <div class="card-header">
            <strong class="card-title">Contact Us</strong>
        </div>
        <x-success-alert key='success'></x-success-alert>
        <div class="card-body">
            <form action="{{ Route('contact.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="Enter Your Name">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="Enter Your Email">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="form-group mb-3">
                            <label for="message">Message</label>
                            <textarea name="message" id="message" class="form-control" cols="30" rows="5"
                                placeholder="Enter Your Message"></textarea>
                            <x-input-error :messages="$errors->get('message')" class="mt-2" />
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </div> <!-- /.col -->
                </div> <!-- /.col -->
            </form>
        </div>
    </div> <!-- / .card -->



@endsection
