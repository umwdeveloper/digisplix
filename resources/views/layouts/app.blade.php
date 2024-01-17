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

    {{-- <link rel="preload"
        href="{{ asset($preferredMode && $preferredMode == 'dark' ? Vite::asset('resources/css/dark-sass/light.scss') : Vite::asset('resources/css/light-sass/dark.scss')) }}"
        as="style"> --}}
    <link rel="stylesheet" id="theme-link"
        href="{{ asset($preferredMode && $preferredMode == 'dark' ? Vite::asset('resources/css/dark-sass/dark.scss') : Vite::asset('resources/css/light-sass/light.scss')) }}">

    {{-- @vite(['resources/css/light-sass/light.scss']) --}}

    <title>DigiSplix | Admin</title>

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

                            <li><a class="dropdown-item" href="{{ route('staff.profile') }}"><i
                                        class="bi bi-person me-3"></i>Profile</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('staff.settings') }}"><i
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
                                <a href="{{ route('staff.index') }}" class="dashboard-link">
                                    <span class="menu-icon">
                                        <i class="fa-duotone fa-grid-2"></i>
                                    </span>
                                    <span class="menu-title">Dashboard </span>
                                </a>
                            </li>

                            @can('staff.leads')
                                <li class="menu-item">
                                    <a href="{{ route('staff.leads.index') }}">
                                        <span class="menu-icon">
                                            <i class="fa-duotone fa-people-group"></i>

                                        </span>
                                        <span class="menu-title">Leads</span>
                                    </a>
                                </li>
                            @endcan

                            @can('staff.projects')
                                <li class="menu-item">
                                    <a href="{{ route('staff.projects.index') }}">
                                        <span class="menu-icon">
                                            <i class="fa-duotone fa-rectangle-history"></i>

                                        </span>
                                        <span class="menu-title">Projects</span>
                                    </a>
                                </li>
                            @endcan

                            @can('staff.sales')
                                <li class="menu-item">
                                    <a href="{{ route('staff.sales.index') }}">
                                        <span class="menu-icon">
                                            <i class="fa-duotone fa-chart-mixed-up-circle-dollar"></i>
                                        </span>
                                        <span class="menu-title">Sales
                                        </span>
                                    </a>

                                </li>
                            @endcan

                            @can('staff.invoices')
                                <li class="menu-item">
                                    <a href="{{ route('staff.invoices.index') }}">
                                        <span class="menu-icon">
                                            <i class="fa-duotone fa-file-invoice-dollar"></i>
                                        </span>
                                        <span class="menu-title">Invoices
                                        </span>
                                    </a>

                                </li>
                            @endcan

                            @can('staff.partners')
                                <li class="menu-item">
                                    <a href="{{ route('staff.partners.index') }}">
                                        <span class="menu-icon">
                                            <i class="fa-duotone fa-user-group-simple"></i>
                                        </span>

                                        <span class="menu-title">Partners
                                        </span>
                                    </a>
                                </li>
                            @endcan

                            @can('staff.clients')
                                <li class="menu-item">
                                    <a href="{{ route('staff.clients.index') }}">
                                        <span class="menu-icon">
                                            <i class="fa-duotone fa-users-line"></i>

                                        </span>
                                        <span class="menu-title">Clients
                                        </span>
                                    </a>
                                </li>
                            @endcan

                            @can('staff.chats')
                                <li class="menu-item">
                                    <a href="{{ route('chat') }}">
                                        <span class="menu-icon">
                                            <i class="fa-duotone fa-messages"></i>

                                        </span>
                                        <span class="menu-title">Chats
                                        </span>
                                    </a>
                                </li>
                            @endcan

                            @can('staff.staff')
                                <li class="menu-item">
                                    <a href="{{ route('staff.staff.index') }}">
                                        <span class="menu-icon">
                                            <i class="fa-duotone fa-user-tie"></i>

                                        </span>
                                        <span class="menu-title">Staff
                                        </span>
                                    </a>
                                </li>
                            @endcan

                            @can('staff.support')
                                <li class="menu-item">
                                    <a href="{{ route('staff.support.index') }}">
                                        <span class="menu-icon">
                                            <i class="fa-duotone fa-user-headset"></i>
                                        </span>
                                        <span class="menu-title">Support
                                        </span>
                                    </a>
                                </li>
                            @endcan

                            @can('staff.emails')
                                <li class="menu-item">
                                    <a href="{{ config('custom.staff_subdomain') . '/webmail' }}" target="_blank">
                                        <span class="menu-icon">
                                            <i class="fa-duotone fa-envelopes"></i>
                                        </span>
                                        <span class="menu-title">Email
                                        </span>
                                    </a>
                                </li>
                            @endcan

                            @can('staff.logs')
                                <li class="menu-item">
                                    <a href="{{ route('staff.logs') }}">
                                        <span class="menu-icon">
                                            <i class="fa-duotone fa-file"></i>
                                        </span>
                                        <span class="menu-title">Logs
                                        </span>
                                    </a>
                                </li>
                            @endcan
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
                                @forelse (auth()->user()->notifications->take(5) as $notification)
                                    <li class="{{ empty($notification->read_at) ? 'unread-notification' : '' }}">

                                        <a
                                            href="{{ !empty($notification->data['link']) ? route('notifications.mark_as_read') . '?url=' . $notification->data['link'] : '#' }}">
                                            @if (empty($notification->read_at))
                                                <i class="bi bi-dot"></i>
                                            @endif
                                            <p class="mb-0 pb-0 ">{{ $notification->data['message'] }}</p>
                                        </a>
                                    </li>
                                @empty
                                    <li class="text-muted text-center pt-3">No new notifications</li>
                                @endforelse
                                <li>
                                    <a href="{{ route('staff.notifications') }}" class="text-center">
                                        <div class="see-all w-100 text-center">
                                            View All
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Quick links -->
                    <div class="header-option align-self-center hide-sm side-menu-quick-btn">
                        <i class="fa-duotone fa-grid-round-2 header-icon"></i>

                    </div>

                    <!-- ticket -->
                    @can('staff.support')
                        <div class="header-option align-self-center hide-sm side-menu-ticket-btn position-relative ">
                            <!-- <i class="bi bi-app-indicator path-1"></i> -->
                            <i class="fa-duotone fa-life-ring header-icon"></i>
                            @if ($total_staff_tickets > 0)
                                <span class="tickets-count">{{ $total_staff_tickets }}</span>
                            @endif
                        </div>
                    @endcan

                    <!-- chat -->
                    @can('staff.chats')
                        <div class="header-option align-self-center hide-sm messages-count-container"
                            style="position: relative" onclick="window.location.href = '{{ route('chat') }}'">
                            <i class="fa-duotone fa-messages header-icon"></i>
                            @if ($total_messages_count > 0)
                                <span class="messages-count">{{ $total_messages_count }}</span>
                            @endif
                        </div>
                    @endcan

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
        <!-- quick links menu -->
        <div class="side-menu side-menu-quick" id="side-menu-quick">
            <div class="quick-links">
                <div class="row">
                    <div class="col-lg-12 mb-4 pb-3 side-menu-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h1 class="mb-0 pb-0 ">Quick Actions</h1>
                            <button class="close-btn">
                                <i class="fa-duotone fa-xmark-large"></i>

                            </button>
                        </div>
                    </div>
                    @can('staff.projects')
                        <div class="col-6 pe-1 mb-2">
                            <a href="{{ route('staff.projects.index') }}">
                                <div class="actions-card">
                                    <i class="fa-duotone fa-rectangle-history"></i>
                                    <p class="mb-0 pb-0">
                                        Projects
                                    </p>
                                </div>
                            </a>
                        </div>
                    @endcan
                    @can('staff.clients')
                        <div class="col-6 ps-1 mb-2">
                            <a href="{{ route('staff.clients.index') }}">
                                <div class="actions-card">
                                    <i class="fa-duotone fa-users-line"></i>
                                    <p class="mb-0 pb-0">
                                        Clients
                                    </p>
                                </div>
                            </a>
                        </div>
                    @endcan
                    @can('staff.partners')
                        <div class="col-6 pe-1 mb-2">
                            <a href="{{ route('staff.partners.index') }}">
                                <div class="actions-card">
                                    <i class="fa-duotone fa-user-group-simple"></i>
                                    <p class="mb-0 pb-0">
                                        Partners
                                    </p>
                                </div>
                            </a>
                        </div>
                    @endcan
                    @can('staff.staff')
                        <div class="col-6 ps-1 mb-2">
                            <a href="{{ route('staff.staff.index') }}">
                                <div class="actions-card">
                                    <i class="fa-duotone fa-user-tie"></i>
                                    <p class="mb-0 pb-0">
                                        Staff
                                    </p>
                                </div>
                            </a>
                        </div>
                    @endcan
                    @can('staff.leads')
                        <div class="col-6 pe-1 mb-2">
                            <a href="{{ route('staff.leads.index') }}">
                                <div class="actions-card">
                                    <i class="fa-duotone fa-people-simple"></i>
                                    <p class="mb-0 pb-0">
                                        Leads
                                    </p>
                                </div>
                            </a>
                        </div>
                    @endcan
                    <div class="col-6 ps-1 mb-2">
                        <a href="{{ route('staff.settings') }}">
                            <div class="actions-card">
                                <i class="fa-duotone fa-gear-complex-code"></i>
                                <p class="mb-0 pb-0">
                                    Settings
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- ticket menu -->
        @can('staff.support')
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
                        @forelse ($shared_tickets as $ticket)
                            @php
                                $time = \Carbon\Carbon::parse($ticket->created_at)->diffForHumans();
                                $timeInt = filter_var($time, FILTER_SANITIZE_NUMBER_INT);
                                $timeText = str_replace($timeInt, '', $time);
                            @endphp
                            <div class="col-lg-12 pe-1 mb-2">
                                <a class="ticket-notify px-0 " href="{{ route('staff.support.show', $ticket->id) }}">
                                    <h4 class=" text-gray  ">
                                        {{ $timeInt }}
                                        <br>
                                        <p class="mb-0 pb-0 ms-2" style="font-size:10px; color:gray; font-weight:500;">
                                            {{ $timeText }}
                                        </p>
                                    </h4>
                                    <div class="ticket-body ticket-{{ $colors[array_rand($colors)] }}">
                                        <p class="mb-2">{{ $ticket->description }}</p>
                                        <span class="text-fade">by {{ $ticket->user->name }}</span>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <p class="text-center ">No tickets</p>
                        @endforelse
                    </div>
                </div>
            </div>
        @endcan
        <!-- -----------Main Contents----------- -->
        @yield('content')
        <div class="overlay"></div>

    </div>
    <!-- menu footer -->
    <footer class="menu-footer">
        <div class="footer-menu-link dashboard-link">
            <a href="{{ route('staff.index') }}">
                <i class="fa-duotone fa-grid-2"></i>
                Dashboard
            </a>
        </div>
        @can('staff.leads')
            <div class="footer-menu-link">
                <a href="{{ route('staff.leads.index') }}">
                    <i class="fa-duotone fa-people-group"></i>
                    Leads
                </a>
            </div>
        @endcan
        @can('staff.projects')
            <div class="footer-menu-link">
                <a href="{{ route('staff.projects.index') }}">
                    <i class="fa-duotone fa-rectangle-history"></i>
                    Projects
                </a>
            </div>
        @endcan
        @can('staff.chats')
            <div class="footer-menu-link" style="position: relative">
                <a href="{{ route('chat') }}" class="messages-count-container-sm">
                    <i class="fa-duotone fa-messages"></i>
                    Chats
                    @if ($total_messages_count > 0)
                        <span class="messages-count-sm">{{ $total_messages_count }}</span>
                    @endif
                </a>
            </div>
        @endcan
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
        @can('staff.sales')
            <div class="d-flex align-items-center more-footer-link">
                <a href="{{ route('staff.sales.index') }}" class="d-flex align-items-center">
                    <div class="more-icon">
                        <i class="fa-duotone fa-chart-mixed-up-circle-dollar"></i>
                    </div>
                    Sales
                </a>
            </div>
        @endcan
        @can('staff.invoices')
            <div class="d-flex align-items-center more-footer-link ">
                <a href="{{ route('staff.invoices.index') }}" class="d-flex align-items-center ">
                    <div class="more-icon">
                        <i class="fa-duotone fa-file-invoice-dollar"></i>
                    </div>
                    Invoices
                </a>
            </div>
        @endcan
        @can('staff.clients')
            <div class="d-flex align-items-center more-footer-link">
                <a href="{{ route('staff.clients.index') }}">
                    <div class="more-icon">
                        <i class="fa-duotone fa-users-line"></i>
                    </div>

                    Clients
                </a>
            </div>
        @endcan
        @can('staff.partners')
            <div class="d-flex align-items-center more-footer-link">
                <a href="{{ route('staff.partners.index') }}">
                    <div class="more-icon">
                        <i class="fa-duotone fa-user-group-simple"></i>
                    </div>

                    Partners
                </a>
            </div>
        @endcan

        @can('staff.staff')
            <div class="d-flex align-items-center more-footer-link">
                <a href="{{ route('staff.staff.index') }}">
                    <div class="more-icon">
                        <i class="fa-duotone fa-user-tie"></i>
                    </div>

                    Staff
                </a>
            </div>
        @endcan
        @can('staff.support')
            <div class="d-flex align-items-center more-footer-link">
                <a href="{{ route('staff.support.index') }}">
                    <div class="more-icon">
                        <i class="fa-duotone fa-user-headset"></i>
                    </div>

                    Support
                </a>
            </div>
        @endcan
        @can('staff.emails')
            <div class="d-flex align-items-center more-footer-link">
                <a href="{{ config('custom.staff_subdomain') . '/webmail' }}" target="_blank">
                    <div class="more-icon">
                        <i class="fa-duotone fa-envelopes"></i>
                    </div>
                    Email
                </a>
            </div>
        @endcan
        <div class="d-flex align-items-center more-footer-link">
            <a href="logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
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
    {{-- JS --}}
    <script src="{{ asset('js/app.js') }}"></script>
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

    @yield('script')
</body>

</html>
