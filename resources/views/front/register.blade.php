@extends('front.master')

@section('content')
    <div class="card-body px-5 py-5" style="background-color:darkgray;">
        <h3 class="card-title text-left mb-3">Register</h3>

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <!-- Username -->
            <div class="form-group">
                <label>Username</label>
                <input type="text" value="{{ old('username') }}" name="username" class="form-control p_input">
                <x-input-error :messages="$errors->get('username')" class="mt-2" />
            </div>

            <!-- Phone -->
            <div class="form-group">
                <label>Phone</label>
                <input type="text" value="{{ old('phone') }}" name="phone" class="form-control p_input">
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <!-- Address -->
            <div class="form-group">
                <label>Address</label>
                <input type="text" value="{{ old('address') }}" name="address" class="form-control p_input">
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="form-group">
                <label>Email</label>
                <input type="email" value="{{ old('email') }}" name="email" class="form-control p_input">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>


            <!-- Password -->
            <div class="form-group">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="form-control p_input" type="password" name="password" required
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="form-control p_input" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Signup Button -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-block enter-btn">Signup</button>
            </div>

            <!-- Social Login Buttons -->
            <div class="d-flex mt-3">
                <button class="btn btn-facebook col me-2">
                    <i class="mdi mdi-facebook"></i> Facebook
                </button>
                <button class="btn btn-google col">
                    <i class="mdi mdi-google-plus"></i> Google plus
                </button>
            </div>

            <!-- Login and Terms -->
            <p class="sign-up text-center">Already have an Account? <a href="{{ route('login') }}">Login</a></p>
            <p class="terms">By creating an account you are accepting our <a href="#">Terms & Conditions</a></p>
        </form>
    </div>
@endsection
