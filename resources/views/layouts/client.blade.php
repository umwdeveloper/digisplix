<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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

    {{-- Country Selector --}}
    <link rel="stylesheet" href="{{ asset('css/countrySelect.min.css') }}">

    {{-- Individual Styles --}}
    @yield('styles')

    {{-- Css --}}
    <link rel="stylesheet" href="{{ asset('css/css-pro.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    @php
        $preferredMode = request()->cookie('preferredMode');
    @endphp
    {{-- <link rel="stylesheet" id="theme-link"
        href="{{ asset($preferredMode && $preferredMode == 'dark' ? 'css/dark-theme.css' : 'css/light-theme.css') }}"> --}}

    <link rel="preload"
        href="{{ asset($preferredMode && $preferredMode == 'dark' ? Vite::asset('resources/css/light-sass/light.scss') : Vite::asset('resources/css/dark-sass/dark.scss')) }}"
        as="style">
    <link rel="stylesheet" id="theme-link"
        href="{{ asset($preferredMode && $preferredMode == 'dark' ? Vite::asset('resources/css/dark-sass/dark.scss') : Vite::asset('resources/css/light-sass/light.scss')) }}">

    {{-- @vite(['resources/css/dark-sass/main.scss']) --}}

    <title>DigiSplix | Client</title>

    @php
        $user = auth()->user();
    @endphp
</head>

<body class="theme">
    @if (!cache('preloader' . auth()->user()->id))
        <div class="loader">
            <img src="{{ asset('images/d-png.png') }}" alt="">
        </div>
    @endif
    @php
        Cache::put('preloader' . auth()->user()->id, true);
    @endphp
    <div class="layout has-sidebar fixed-sidebar d-flex" style="width: fit-content !important;">
        <!-- ---------------------Side bar-------------- -->
        @php
            $preferredSidebar = request()->cookie('preferredSidebar');
        @endphp
        <aside id="sidebar"
            class="sidebar break-point-lg has-bg-image {{ $preferredSidebar && $preferredSidebar == 'close' ? 'collapsed' : '' }}">

            <div class="sidebar-layout">
                <div class="sidebar-header d-flex justify-content-center">

                    <a id="btn-toggle2" href="#" class="sidebar-toggler break-point-lg">
                    </a>
                    <div class="d-flex justify-content-center align-items-center">
                        <img src="{{ asset('images/DigiSplix-Logo-for-Light-Mode.png') }}" alt=""
                            class="img-fluid logo-lg" id="logo-image">
                        <img src="{{ asset('images/d-png.png') }}" alt="" class="img-fluid logo-sm">
                    </div>
                </div>
                <div class="d-flex  user-account ">

                    <div class="user-icon">
                        <img src="{{ !empty($user->img) ? getURL($user->img) : asset('images/avatar.png') }}"
                            alt="" class="" height="50" width="50">
                    </div>
                    <div class="dropdown profile-dropdown ms-auto">
                        <button class="dropdown-toggle d-flex align-items-center pe-3" type="button"
                            id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <div style="max-width:125px; overflow-x:hidden;" class="user-name">
                                <h3 class="mb-0">{{ $user->name }}</h3>
                                <p class="mb-0 pb-0">{{ $user->designation }}</p>
                            </div>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                            <li><a class="dropdown-item" href="{{ route('client.profile') }}"><i
                                        class="bi bi-person me-3"></i>Profile</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('client.settings') }}"><i
                                        class="bi bi-gear me-3"></i>Settings</a>
                            <li><a class="dropdown-item" href="logout"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit()"><i
                                        class="bi bi-arrow-bar-left me-3"></i>Logout</a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="menu-item py-3 menu-heading-div">
                    <span class="ps-4 f-14 w-500 text-light-white ls-3 menu-heading ">Main Menu</span>
                </div>
                <div class="sidebar-content">
                    <nav class="menu open-current-submenu">

                        <ul>
                            <li class="menu-item">
                                <a href="{{ route('client.projects.index') }}" class="dashboard-link">
                                    <span class="menu-icon" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="My Projects">
                                        <i class="fa-duotone fa-rectangle-history"></i>

                                    </span>
                                    <span class="menu-title">My Projects</span>
                                </a>
                            </li>

                            <li class="menu-item">
                                <a href="{{ route('user', \App\Models\User::getAdmin()->id) }}">
                                    <span class="menu-icon" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Chats">
                                        <i class="fa-duotone fa-messages"></i>

                                    </span>
                                    <span class="menu-title">Chats
                                    </span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('client.invoices.index') }}">
                                    <span class="menu-icon" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Billing">
                                        <i class="fa-duotone fa-credit-card"></i>
                                    </span>
                                    <span class="menu-title">Billing
                                    </span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('client.services.index') }}">
                                    <span class="menu-icon" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Business Growth">
                                        <i class="fa-duotone fa-chart-line-up"></i>
                                    </span>
                                    <span class="menu-title">Business Growth
                                    </span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('client.support.index') }}">
                                    <span class="menu-icon" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Support">
                                        <i class="fa-duotone fa-user-headset"></i>
                                    </span>
                                    <span class="menu-title">Support
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </aside>
    </div>

    <div class="main-area w-100 mb-0">
        <!-- ----------------Header--------------- -->
        <header class="header-div  w-100">
            <div class="header w-100">
                <a id="btn-collapse" href="#" class="align-self-center header-option">
                    <i class="fa-duotone fa-bars-staggered header-icon"></i>

                </a>
                <a id="btn-toggle" href="#" class="align-self-center header-option">
                    <i class="fa-duotone fa-bars-staggered header-icon"></i>
                </a>
                <div class="show-md align-self-center">
                    <img src="{{ asset('images/DigiSplix-Logo-for-Light-Mode.png') }}" alt=""
                        class="img-fluid mobile-logo" id="logo-image-sm">
                </div>

                <!-- Notification -->
                <div class="ms-auto d-flex">
                    <!-- Clocks -->
                    <div class="header-option align-self-center" data-bs-toggle="modal" data-bs-dismiss="modal"
                        data-bs-target="#clocksModal">
                        <i class="fa-duotone fa-clock header-icon"></i>

                    </div>

                    <div class="notification-dropdown-div  align-self-center header-option">
                        <button type="button" style="position: relative;">
                            <div class="notifications ">
                                <i class="fa-duotone fa-bell header-icon mt-1"></i>

                                <div class="pulse-wave"></div>
                                @if ($total_notifications_count > 0)
                                    <span class="notifications-count">{{ $total_notifications_count }}</span>
                                @endif
                            </div>
                        </button>
                        <div class="notification-dropdown-inner">
                            <ul class="notification-dropdown">
                                <div class="notifications-header">
                                    <h1 class="mb-0 pb-0">Notifications</h1>
                                    {{-- <button>Clear All</button> --}}
                                </div>
                                @forelse ($all_notifications as $notification)
                                    <li class="{{ empty($notification->read_at) ? 'unread-notification' : '' }}">

                                        <a
                                            href="{{ !empty($notification->data['link']) ? route('notifications.mark_as_read') . '?url=' . $notification->data['link'] : '#' }}">
                                            @if (empty($notification->read_at))
                                                <i class="bi bi-dot"></i>
                                            @endif
                                            <p class="mb-0 pb-0 " title="{{ $notification->data['message'] }}">
                                                {{ $notification->data['message'] }}</p>
                                        </a>
                                    </li>
                                @empty
                                    <li class="text-muted text-center pt-3">No new notifications</li>
                                @endforelse
                                <li>
                                    <a href="{{ route('client.notifications') }}" class="text-center">
                                        <div class="see-all w-100 text-center">
                                            View All
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- ticker -->
                    <div class="header-option align-self-center hide-sm side-menu-ticket-btn position-relative ">
                        <!-- <i class="bi bi-app-indicator path-1"></i> -->
                        <i class="fa-duotone fa-life-ring header-icon"></i>
                        @if ($ticket_notifications_count > 0)
                            <span class="tickets-count">{{ $ticket_notifications_count }}</span>
                        @endif
                    </div>

                    <!-- chat -->
                    <div class="header-option align-self-center hide-sm chat-btn messages-count-container"
                        style="position: relative"
                        onclick="window.location.href = '{{ route('user', \App\Models\User::getAdmin()->id) }}'">
                        <i class="fa-duotone fa-messages header-icon"></i>
                        @if ($total_messages_count > 0)
                            <span class="messages-count">{{ $total_messages_count }}</span>
                        @endif
                    </div>

                    <!-- theme exchange -->
                    <div class="header-option align-self-center" id="toggleTheme">
                        <i class="fa-duotone fa-brightness header-icon"></i>

                    </div>

                    <!-- fullscreen -->
                    <div class="header-option align-self-center me-0 hide-sm" id="fullscreen-button">

                        <i class="fa-duotone fa-arrows-maximize header-icon"></i>

                    </div>
                </div>
            </div>
        </header>

        <!-- ticket menu -->
        @php
            $colors = ['alert', 'warning', 'success', 'info'];
        @endphp
        <div class="side-menu side-menu-ticket">
            <div class="ticket-links">
                <div class="row">
                    <div class="col-lg-12 mb-4 pb-3 side-menu-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h1 class="mb-0 pb-0">Ticket/support </h1>
                            <button class="close-btn">
                                <i class="fa-duotone fa-xmark-large"></i>

                            </button>
                        </div>
                    </div>
                    @forelse ($ticket_notifications as $notification)
                        @php
                            $time = \Carbon\Carbon::parse($notification->created_at)->diffForHumans();
                            $timeInt = filter_var($time, FILTER_SANITIZE_NUMBER_INT);
                            $timeText = str_replace($timeInt, '', $time);
                        @endphp
                        <div class="col-lg-12 pe-1 mb-2">
                            <a class="ticket-notify px-0 "
                                href="{{ !empty($notification->data['link']) ? route('notifications.mark_as_read') . '?url=' . $notification->data['link'] : '#' }}">
                                <h4 class=" text-gray  ticket-time">
                                    {{ $timeInt }}
                                    <br>
                                    <p class="mb-0 pb-0 ms-2" style="font-size:10px; color:gray; font-weight:500;">
                                        {{ $timeText }}
                                    </p>
                                </h4>
                                <div class="ticket-body ticket-{{ $colors[array_rand($colors)] }}">
                                    <p style="{{ empty($notification->read_at) ? 'font-weight: 500' : '' }}"
                                        class="mb-2">
                                        @if (empty($notification->read_at))
                                            <i class="bi bi-dot"></i>
                                        @endif
                                        {{ $notification->data['message'] }}
                                    </p>
                                    {{-- <span class="text-fade">by {{ $ticket->user->name }}</span> --}}
                                </div>
                            </a>
                        </div>
                    @empty
                        <p class="text-center ">No tickets</p>
                    @endforelse
                </div>
            </div>
        </div>
        <!-- -----------Main Contents----------- -->
        @yield('content')

        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-lg-12">
                    <div class="box">
                        <p class="f-14 w-500 mb-0 pb-0 text-center text-gray text-dark-clr" id="copyright-year">
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="overlay"></div>

    </div>
    <!-- menu footer -->
    <footer class="menu-footer">
        <div class="footer-menu-link dashboard-link">
            <a href="{{ route('client.projects.index') }}">
                <i class="fa-duotone fa-rectangle-history"></i>
                My Projects
            </a>
        </div>
        <div class="footer-menu-link" style="position: relative">
            <a href="{{ route('user', \App\Models\User::getAdmin()->id) }}" class="messages-count-container-sm">
                <i class="fa-duotone fa-messages"></i>
                Chats
                @if ($total_messages_count > 0)
                    <span class="messages-count-sm">{{ $total_messages_count }}</span>
                @endif
            </a>
        </div>
        <div class="footer-menu-link">
            <a href="{{ route('client.services.index') }}">
                <i class="fa-duotone fa-chart-line-up"></i>
                Growth
            </a>
        </div>
        <div class="footer-menu-link">
            <a href="{{ route('client.invoices.index') }}">
                <i class="fa-duotone fa-credit-card"></i>
                Billing
            </a>
        </div>
        <div class="footer-menu-link" id="show-more-menu">
            <a>
                <i class="fa-duotone fa-circle-ellipsis-vertical"></i>
                More
            </a>
        </div>
    </footer>
    <!--show more mobile popup -->
    <div class="menu-footer-popup">
        <h3>More Menus</h3>
        <div class="menu-footer-padding"></div>
        <div class="d-flex align-items-center more-footer-link">
            <a href="{{ route('client.support.index') }}">
                <div class="more-icon">
                    <i class="fa-duotone fa-user-headset"></i>
                </div>

                Support
            </a>
        </div>
        <div class="d-flex align-items-center more-footer-link">
            <a href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                <div class="more-icon">
                    <i class="fa-duotone fa-right-from-bracket"></i>
                </div>

                Logout
            </a>
        </div>
    </div>



    <div id="overlay-all" class="overlay"></div>

    <div id="overlay-sidebar"></div>

    {{-- Loader/Spinner --}}
    <div class="loading d-none"></div>

    {{-- Show toast after an operation --}}
    @if (session('status'))
        <x-toast type="success">
            {{ session('status') }}
        </x-toast>
    @endif

    {{-- Delete Confirmation Modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                </div>
                <div class="modal-body">
                    <p class="text-dark-clr">Are you sure you want to delete this record? This process cannot be
                        undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button id="confirmDelete" type="button" class="btn btn-danger">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Clocks Modal --}}
    <div class="modal fade" id="clocksModal" tabindex="-1" aria-labelledby="clocksModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container-fluid">
                        <h6 id="local-clock" class="mb-5 mt-3 text-center"></h6>
                        <div class="row">
                            <div class="col-lg-3 d-flex flex-column justify-content-between align-items-center">
                                <h6 class="mb-4">GMT - Greenwich Mean Time</h6>
                                <div id="clock-gmt"></div>
                                {{-- <h6>Sat 4-4-4</h6> --}}
                            </div>
                            <div class="col-lg-3 d-flex flex-column justify-content-between align-items-center">
                                <h6 class="mb-4">EST - Eastern Mean Time</h6>
                                <div id="clock-est"></div>
                                {{-- <h6>Sat 4-4-4</h6> --}}
                            </div>
                            <div class="col-lg-3 d-flex flex-column justify-content-between align-items-center">
                                <h6 class="mb-4">PST - Pacific Mean Time</h6>
                                <div id="clock-pst"></div>
                                {{-- <h6>Sat 4-4-4</h6> --}}
                            </div>
                            <div class="col-lg-3 d-flex flex-column justify-content-between align-items-center">
                                <h6 class="mb-4">CST - Central Mean Time</h6>
                                <div id="clock-cst"></div>
                                {{-- <h6>Sat 4-4-4</h6> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        const assetUrls = {
            lightThemeURL: "{{ Vite::asset('resources/css/light-sass/light.scss') }}",
            darkThemeURL: "{{ Vite::asset('resources/css/dark-sass/dark.scss') }}",
            lightLogoURL: "{{ asset('images/DigiSplix-Logo-for-Light-Mode.png') }}",
            darkLogoURL: "{{ asset('images/DigiSplix-logo-for-dark-mode.png') }}",
            lightThemeURLChat: "{{ asset('css/chatify/light.mode.css') }}",
            darkThemeURLChat: "{{ asset('css/chatify/dark.mode.css') }}",
        };

        const messagesRoute = '{{ route('messages.count') }}'
    </script>


    {{-- Jquery --}}
    <script src="{{ asset('js/jquery.js') }}"></script>
    {{-- Cookies --}}
    <script src="{{ asset('js/cookie.min.js') }}"></script>
    {{-- Popper --}}
    <script src="{{ asset('js/popper.min.js') }}"></script>
    {{-- Bootstrap --}}
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    {{-- Chart --}}
    @if (isset($chartExists))
        <script src="{{ asset('js/chart.min.js') }}"></script>
        <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
        <script src="{{ asset('js/charts.js') }}"></script>
    @endif
    {{-- Datatables --}}
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/datatables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/table.js') }}"></script>
    {{-- Country Selector --}}
    <script src="{{ asset('js/countrySelect.min.js') }}"></script>
    {{-- Clocks --}}
    <script src="{{ asset('js/clock.js') }}"></script>
    {{-- JS --}}
    <script src="{{ asset('js/app.js') . '?v=2' }}"></script>
    <script src="{{ asset('js/layout.js') }}"></script>
    {{-- Loader --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            setTimeout(function() {
                var loader = document.querySelector(".loader");
                if (loader) {
                    loader.style.display = "none";
                }
            }, 4000);
        });
    </script>

    {{-- Clocks --}}
    <script>
        var opt = new AnalogClockOption();
        opt.width = 150;
        opt.bgColor = '#000000'
        opt.foreColor = '#ffffff'
        // can define the timezone (+-) of the clock
        opt.timezone = 0;
        var clock = new AnalogClock("clock-gmt", opt);
        clock.panel.style.border = "solid 1px white";
        clock.panel.style.boxShadow = "0 0 5px rgba(0, 0, 0, 0.5)";

        opt = new AnalogClockOption();
        opt.width = 150;
        opt.bgColor = '#000000'
        opt.foreColor = '#ffffff'
        // can define the timezone (+-) of the clock
        opt.timezone = -4;
        var clock = new AnalogClock("clock-est", opt);
        clock.panel.style.border = "solid 1px white";
        clock.panel.style.boxShadow = "0 0 5px rgba(0, 0, 0, 0.5)";

        opt = new AnalogClockOption();
        opt.width = 150;
        opt.bgColor = '#000000'
        opt.foreColor = '#ffffff'
        // can define the timezone (+-) of the clock
        opt.timezone = -7;
        var clock = new AnalogClock("clock-pst", opt);
        clock.panel.style.border = "solid 1px white";
        clock.panel.style.boxShadow = "0 0 5px rgba(0, 0, 0, 0.5)";

        opt = new AnalogClockOption();
        opt.width = 150;
        opt.bgColor = '#000000'
        opt.foreColor = '#ffffff'
        // can define the timezone (+-) of the clock
        opt.timezone = -5;
        var clock = new AnalogClock("clock-cst", opt);
        clock.panel.style.border = "solid 1px white";
        clock.panel.style.boxShadow = "0 0 5px rgba(0, 0, 0, 0.5)";
    </script>

    {{-- Local Clock --}}
    <script>
        let timezoneOffset = 0;
        let api = "{{ config('custom.geo_location_key') }}"

        function fetchTimezoneOffset() {
            fetch('https://api.ipgeolocation.io/ipgeo?apiKey=' + api)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data);
                    timezoneOffset = data.time_zone.offset * 60 * 60 * 1000 || 0;
                    updateLocalClock();
                    setInterval(updateLocalClock, 1000); // Call updateLocalClock every second
                })
                .catch(error => {
                    console.error('Error fetching IP API:', error);
                    // If an error occurs, fallback to local time and still call the clock update
                    updateLocalClock();
                    setInterval(updateLocalClock, 1000); // Call updateLocalClock every second
                });
        }

        function updateLocalClock() {
            var now = new Date();
            var utcTime = now.getTime() + (now.getTimezoneOffset() * 60000);
            var localTime = new Date(utcTime + timezoneOffset);

            var days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
            var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

            var day = days[localTime.getUTCDay()];
            var date = ('0' + localTime.getUTCDate()).slice(-2);
            var month = months[localTime.getUTCMonth()];
            var year = localTime.getUTCFullYear();

            var hours = localTime.getUTCHours();
            var minutes = ('0' + localTime.getUTCMinutes()).slice(-2);
            var seconds = ('0' + localTime.getUTCSeconds()).slice(-2);

            var ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12; // The hour '0' should be '12'
            hours = ('0' + hours).slice(-2);

            var formattedTime = day + ', ' + date + ' ' + month + ' ' + year + ' ' + hours + ':' + minutes + ':' + seconds +
                ' ' + ampm;

            document.getElementById('local-clock').textContent = "Local Time - " + formattedTime;
        }

        // Fetch timezone offset initially
        fetchTimezoneOffset();


        // setInterval(updateLocalClock, 1000);
        // updateLocalClock(); // Initial call to display clock immediately
    </script>

    @yield('script')
</body>

</html>
