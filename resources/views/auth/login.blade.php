@extends('auth.layouts.app')

@section('name')
    Login
@endsection

@section('content')
    <div class=" d-flex justify-content-center align-items-center w-100">
        <div class="log-screen">
            <h1>Log In</h1>
            @foreach ($errors->all() as $error)
                <x-toast type="error">
                    {{ $error }}
                </x-toast>
            @endforeach
            <div class="mt-4 d-flex justify-content-center pt-3">
                <form method="POST" action="{{ route('login') }}" class="w-100">
                    @csrf

                    <div class="user-name-input ms-auto">
                        <input type="email" required name="email" class="ms-auto" placeholder="name@gmail.com">
                        <i class="bi bi-envelope email-icon"></i>
                    </div>
                    <div class="password-input mx-auto">
                        <input type="password" required name="password" class="ms-auto" placeholder="******">
                        <i class="bi bi-lock pass-icon"></i>
                    </div>
                    <div class="send-name-input ms-auto">
                        <input type="submit" name="submit" class="ms-auto">
                    </div>

                    <div class="form-check d-flex justify-content-center mt-4 align-items-center">
                        <input class="form-check-input log-checkbox me-2" type="checkbox" name="remember"
                            id="flexCheckDefault">
                        <label class="form-check-label f-14 w-400 text-white" for="flexCheckDefault">
                            Remember
                        </label>
                    </div>

                    <div class="my-5 mx-auto d-flex justify-content-center">
                        <a href="{{ route('password.request') }}" class="forgot-btn text-center">
                            Forget
                        </a>
                    </div>
                    <div class=" mx-auto d-flex justify-content-center">
                        <a href="index.html" class="join-btn text-center">
                            Join Us
                        </a>
                    </div>
                </form>

            </div>

        </div>
    </div>
@endsection
