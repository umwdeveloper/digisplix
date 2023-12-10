<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Favicon --}}
    <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('images/favi.ico') }}">

    {{-- Bootstrap --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    {{-- Icons --}}
    <link rel="stylesheet" href="{{ asset('fa-icons/all.css') }}">
    <link rel="stylesheet" href="{{ asset('fa-icons/sharp-solid.css') }}">
    <link rel="stylesheet" href="{{ asset('fa-icons/sharp-regular.css') }}">
    <link rel="stylesheet" href="{{ asset('fa-icons/sharp-light.css') }}">

    {{-- Card --}}
    <link rel="stylesheet" href="{{ asset('css/chart.min.css') }}">

    {{-- Table --}}
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.datatables.min.css') }}">

    {{-- Css --}}
    <link rel="stylesheet" href="{{ asset('css/css-pro.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    @php
        $preferredMode = request()->cookie('preferredMode');
    @endphp
    <link rel="stylesheet" id="theme-link"
        href="{{ asset($preferredMode && $preferredMode == 'dark' ? 'css/dark-theme.css' : 'css/light-theme.css') }}">


    <title>DigiSplix | Login</title>
</head>

<body class="theme log-theme">

    <div class=" d-flex justify-content-center align-items-center w-100">
        <div class="log-screen">
            <h1>2FA</h1>
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
                <form method="POST" action="{{ route('staff.confirmCode') }}" class="w-100">
                    @csrf

                    <div class="password-input mx-auto">
                        <input type="text" maxlength="4" oninput="validateNumericInput(this)" required
                            name="code" class="ms-auto" placeholder="1234">
                        <i class="bi bi-key pass-icon"></i>
                    </div>
                    <input type="hidden" value="login" name="login">
                    <div class="send-name-input ms-auto">
                        <input type="submit" name="submit" class="ms-auto">
                    </div>
                </form>

            </div>

        </div>


        {{-- Jquery --}}
        <script src="{{ asset('js/jquery.js') }}"></script>
        {{-- Cookies --}}
        <script src="{{ asset('js/cookie.min.js') }}"></script>
        {{-- Popper --}}
        <script src="{{ asset('js/popper.min.js') }}"></script>
        {{-- Bootstrap --}}
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        {{-- Chart --}}
        <script src="{{ asset('js/chart.min.js') }}"></script>
        <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
        <script src="{{ asset('js/charts.js') }}"></script>
        {{-- Datatables --}}
        <script src="{{ asset('js/datatables.min.js') }}"></script>
        <script src="{{ asset('js/datatables.responsive.min.js') }}"></script>
        <script src="{{ asset('js/table.js') }}"></script>
        {{-- JS --}}
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/layout.js') }}"></script>

        <script>
            function validateNumericInput(input) {
                // Remove non-numeric characters using a regular expression
                input.value = input.value.replace(/[^0-9]/g, '');
            }
        </script>


</body>

</html>
