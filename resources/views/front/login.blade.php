@extends('front.master')

@section('content')
    <div class="card-body px-5 py-5" style="background-color:darkgray;">
        <h3 class="card-title text-left mb-3">Login</h3>
        <form action="{{ route('login') }}" method="POST">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="form-control p_input" type="email" name="email" :value="old('email')"
                    required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="form-group">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="form-control p_input" type="password" name="password" required
                    autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <br>

            <!-- Remember Me -->
            <div class="form-group d-flex align-items-center justify-content-between">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>


            <!-- Remember Me & Forgot Password -->
            {{-- <div class="form-group d-flex align-items-center justify-content-between">
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="remember"> Remember me
                    </label>
                </div>
                <a href="{{ route('password.request') }}" class="forgot-pass">Forgot password</a>
            </div> --}}

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-block enter-btn">Login</button>
            </div>

            <!-- Social Login Buttons -->
            <div class="d-flex mt-3">
                <button class="btn btn-facebook me-2 col">
                    <i class="mdi mdi-facebook"></i> Facebook
                </button>
                <button class="btn btn-google col">
                    <i class="mdi mdi-google-plus"></i> Google plus
                </button>
            </div>

            <!-- Sign Up Link -->
            <p class="sign-up mt-3">Don't have an Account?<a href="{{ route('register') }}"> Sign Up</a></p>
        </form>
    </div>
@endsection
