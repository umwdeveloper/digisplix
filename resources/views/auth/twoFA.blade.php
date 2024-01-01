@extends('auth.layouts.app')

@section('name')
    Login
@endsection

@section('content')

    <div class=" d-flex justify-content-center align-items-center w-100">
        <div class="log-screen" style="min-height:fit-content !important; height:fit-content !important;">
            <h4 class="text-center text-white ">Two Factor Authentication</h4>
            @foreach ($errors->all() as $error)
                <x-toast type="error">
                    {{ $error }}
                </x-toast>
            @endforeach
            @if (!$errors->any())
                <x-toast type="success">
                    Please check email for the confirmation code!
                </x-toast>
            @endif
            <div class="mt-4 d-flex justify-content-center pt-3">
                <form method="POST" action="{{ route('2fa.confirmCode') }}" class="w-100">
                    @csrf

                    <div class="password-input mx-auto">
                        <input type="text" maxlength="4" oninput="validateNumericInput(this)" required name="code"
                            class="ms-auto" placeholder="1234">
                        <i class="bi bi-key pass-icon"></i>
                    </div>
                    <input type="hidden" value="login" name="login">
                    <div class="send-name-input ms-auto">
                        <input type="submit" name="submit" class="ms-auto">
                    </div>
                </form>

            </div>

        </div>

    @section('scripts')
        <script>
            function validateNumericInput(input) {
                // Remove non-numeric characters using a regular expression
                input.value = input.value.replace(/[^0-9]/g, '');
            }
        </script>
    @endsection

@endsection
