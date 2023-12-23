@extends('auth.layouts.app')

@section('name')
    Reset Password
@endsection

@section('content')
    <div class=" d-flex justify-content-center align-items-center w-100">
        <div class="log-screen">
            <h1 style="font-size:22px; font-weight:500; ">Reset Password</h1>
            @foreach ($errors->all() as $error)
                <x-toast type="error">
                    {{ $error }}
                </x-toast>
            @endforeach
            <div class="mt-4 d-flex justify-content-center pt-3">
                <form method="POST" action="{{ route('password.update') }}" class="w-100">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="user-name-input ms-auto">
                        <input type="email" required readonly name="email" class="ms-auto" placeholder="name@gmail.com"
                            value="{{ $email ?? old('email') }}">
                        <i class="bi bi-envelope email-icon"></i>
                    </div>
                    <div class="password-input mx-auto">
                        <input type="password" required name="password" class="ms-auto" placeholder="Password">
                        <i class="bi bi-lock pass-icon"></i>
                    </div>
                    <div class="user-name-input  ms-auto">
                        <input type="password" required name="password_confirmation" class="ms-auto"
                            placeholder="Confirm Password">
                        <i class="bi bi-lock email-icon"></i>
                    </div>
                    <div class="password-input ms-auto">
                        <input type="submit" name="submit" class="ms-auto">
                    </div>
                </form>

            </div>

        </div>
    </div>
@endsection
