@extends('auth.layouts.app')

@section('name')
    Reset Password
@endsection

@section('content')
    @if (session('status'))
        <x-toast type="success">
            {{ session('status') }}
        </x-toast>
    @endif

    <div class=" d-flex justify-content-center align-items-center w-100">
        <div class="log-screen">
            <h1 style="font-size:22px; font-weight:500; ">Reset Password</h1>
            @foreach ($errors->all() as $error)
                <x-toast type="error">
                    {{ $error }}
                </x-toast>
            @endforeach
            <div class="mt-4 d-flex justify-content-center pt-3">
                <form method="POST" action="{{ route('password.email') }}" class="w-100">
                    @csrf

                    <div class="user-name-input ms-auto">
                        <input type="email" required name="email" class="ms-auto" placeholder="name@gmail.com">
                        <i class="bi bi-envelope email-icon"></i>
                    </div>
                    <div class="password-input ms-auto">
                        <input type="submit" name="submit" class="ms-auto">
                    </div>

                    <div class="my-5 mx-auto d-flex justify-content-center">
                        <a href="{{ route('login') }}" class="forgot-btn text-center">
                            Login
                        </a>
                    </div>
                </form>

            </div>

        </div>
    </div>
@endsection
