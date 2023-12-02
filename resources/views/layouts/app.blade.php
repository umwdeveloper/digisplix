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

    @vite(['resources/css/light-sass/main.scss'])

    <title>DigiSplix | Admin</title>

    @php
        $user = auth()->user();
    @endphp
</head>

<body class="theme">
    @php
        $preloader = request()->cookie('preloader');
    @endphp
    @if (!$preloader)
        <div class="loader">
            <img src="{{ asset('images/d-png.png') }}" alt="">
        </div>
    @endif
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
                        <img src="{{ asset('images/vatar-removebg-preview.png') }}" alt="" class=""
                            height="50" width="50">
                    </div>
                    <div class="dropdown profile-dropdown ms-auto">
                        <button class="dropdown-toggle d-flex align-items-center pe-3" type="button"
                            id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <div>
                                <h3 class="mb-0">{{ $user->name }}</h3>
                                <p class="mb-0 pb-0">{{ $user->designation }}</p>
                            </div>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                            <li><a class="dropdown-item" href="profile.html"><i
                                        class="bi bi-person me-3"></i>Profile</a>
                            </li>
                            <li><a class="dropdown-item" href="settings.html"><i
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

                            <li class="menu-item">
                                <a href="{{ route('staff.projects.index') }}">
                                    <span class="menu-icon">
                                        <i class="fa-duotone fa-rectangle-history"></i>

                                    </span>
                                    <span class="menu-title">Projects</span>
                                </a>
                            </li>

                            <li class="menu-item">
                                <a href="sales.html">
                                    <span class="menu-icon">
                                        <i class="fa-duotone fa-chart-mixed-up-circle-dollar"></i>
                                    </span>
                                    <span class="menu-title">Sales
                                    </span>
                                </a>

                            </li>

                            <li class="menu-item">
                                <a href="invoice-list.html">
                                    <span class="menu-icon">
                                        <i class="fa-duotone fa-file-invoice-dollar"></i>
                                    </span>
                                    <span class="menu-title">Invoices
                                    </span>
                                </a>

                            </li>

                            <li class="menu-item">
                                <a href="{{ route('staff.partners.index') }}">
                                    <span class="menu-icon">
                                        <i class="fa-duotone fa-user-group-simple"></i>
                                    </span>

                                    <span class="menu-title">Partners
                                    </span>
                                </a>
                            </li>

                            <li class="menu-item">
                                <a href="{{ route('staff.clients.index') }}">
                                    <span class="menu-icon">
                                        <i class="fa-duotone fa-users-line"></i>

                                    </span>
                                    <span class="menu-title">Clients
                                    </span>
                                </a>
                            </li>

                            <li class="menu-item">
                                <a href="chats.html">
                                    <span class="menu-icon">
                                        <i class="fa-duotone fa-messages"></i>

                                    </span>
                                    <span class="menu-title">Chats
                                    </span>
                                </a>
                            </li>

                            <li class="menu-item">
                                <a href="{{ route('staff.staff.index') }}">
                                    <span class="menu-icon">
                                        <i class="fa-duotone fa-user-tie"></i>

                                    </span>
                                    <span class="menu-title">Staff
                                    </span>
                                </a>
                            </li>

                            <li class="menu-item">
                                <a href="{{ route('staff.support.index') }}">
                                    <span class="menu-icon">
                                        <i class="fa-duotone fa-user-headset"></i>
                                    </span>
                                    <span class="menu-title">Support
                                    </span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="email.html">
                                    <span class="menu-icon">
                                        <i class="fa-duotone fa-envelopes"></i>
                                    </span>
                                    <span class="menu-title">Email
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
                    <div class="notification-dropdown-div  align-self-center header-option">
                        <button type="button" style="position: relative;">
                            <div class="notifications ">
                                <i class="fa-duotone fa-bell header-icon mt-1"></i>

                                <div class="pulse-wave"></div>
                            </div>
                        </button>
                        <div class="notification-dropdown-inner">
                            <ul class="notification-dropdown">
                                <div class="notifications-header">
                                    <h1 class="mb-0 pb-0">Notifications</h1>
                                    <button>Clear All</button>
                                </div>
                                <li><a class=" " href="notifications.html"><i
                                            class="bi bi-people-fill text-primary f-14 me-2"></i>
                                        <p class="mb-0 pb-0 ">Lorem ipsum dolor, sit amet consectetur adipisicing
                                            elit. Unde, a!</p>
                                    </a>
                                </li>
                                <li><a class=" " href="#"><i
                                            class="bi bi-info-circle  text-yellow f-14 me-2"></i>
                                        <p class="mb-0 pb-0 text-start">Lorem ipsum dolor, sit amet consectetur
                                            adipisicing
                                            elit. Unde, a!</p>
                                    </a>
                                </li>
                                <li><a class=" " href="#"><i
                                            class="bi bi-person-fill text-primary  text-danger f-14 me-2"></i>
                                        <p class="mb-0 pb-0 text-start">Lorem ipsum dolor, sit amet consectetur
                                            adipisicing
                                            elit. Unde, a!</p>
                                    </a>
                                </li>
                                <li><a class=" " href="#"> <i
                                            class="bi bi-chat-fill  text-yellow f-14 me-2"></i>
                                        <p class="mb-0 pb-0 text-start">Lorem ipsum dolor, sit amet consectetur
                                            adipisicing
                                            elit. Unde, a!</p>
                                    </a>
                                </li>

                                <li>
                                    <a href="notifications.html" class="text-center">
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

                    <!-- ticker -->
                    <div class="header-option align-self-center hide-sm side-menu-ticket-btn">
                        <!-- <i class="bi bi-app-indicator path-1"></i> -->
                        <i class="fa-duotone fa-life-ring header-icon"></i>
                    </div>

                    <!-- chat -->
                    <div class="header-option align-self-center hide-sm chat-btn">
                        <i class="fa-duotone fa-messages header-icon"></i>

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
                    <div class="col-6 pe-1 mb-2">
                        <a href="projects.html">
                            <div class="actions-card">
                                <i class="fa-duotone fa-rectangle-history"></i>
                                <p class="mb-0 pb-0">
                                    Projects
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 ps-1 mb-2">
                        <a href="clients.html">
                            <div class="actions-card">
                                <i class="fa-duotone fa-users-line"></i>
                                <p class="mb-0 pb-0">
                                    clients
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 pe-1 mb-2">
                        <a href="partners.html">
                            <div class="actions-card">
                                <i class="fa-duotone fa-user-group-simple"></i>
                                <p class="mb-0 pb-0">
                                    Partners
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 ps-1 mb-2">
                        <a href="staff.html">
                            <div class="actions-card">
                                <i class="fa-duotone fa-user-tie"></i>
                                <p class="mb-0 pb-0">
                                    Staff
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 pe-1 mb-2">
                        <a href="leads.html">
                            <div class="actions-card">
                                <i class="fa-duotone fa-people-simple"></i>
                                <p class="mb-0 pb-0">
                                    Leads
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 ps-1 mb-2">
                        <a href="settings.html">
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
                    <div class="col-lg-12 pe-1 mb-2">
                        <a class="ticket-notify px-0 " href="#">
                            <h4 class=" text-gray ">03:10</h4>
                            <div class="ticket-body ticket-alert">
                                <p class="mb-2">Morbi quis ex eu arcu auctor sagittis.</p>
                                <span class="text-fade">by Johne</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-12 pe-1 mb-2">
                        <a class="ticket-notify px-0 " href="#">
                            <h4 class=" text-gray ">10:10</h4>
                            <div class="ticket-body ticket-warning">
                                <p class="mb-2">Morbi quis ex eu arcu auctor sagittis.</p>
                                <span class="text-fade">by Johne</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-12 pe-1 mb-2">
                        <a class="ticket-notify px-0 " href="#">
                            <h4 class=" text-gray ">01:10</h4>
                            <div class="ticket-body ticket-info">
                                <p class="mb-2">Morbi quis ex eu arcu auctor sagittis.</p>
                                <span class="text-fade">by Johne</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-12 pe-1 mb-2">
                        <a class="ticket-notify px-0 " href="#">
                            <h4 class=" text-gray ">12:10</h4>
                            <div class="ticket-body ticket-success">
                                <p class="mb-2">Morbi quis ex eu arcu auctor sagittis.</p>
                                <span class="text-fade">by Johne</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-12 pe-1 mb-2">
                        <a class="ticket-notify px-0 " href="#">
                            <h4 class=" text-gray ">03:10</h4>
                            <div class="ticket-body ticket-alert">
                                <p class="mb-2">Morbi quis ex eu arcu auctor sagittis.</p>
                                <span class="text-fade">by Johne</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-12 pe-1 mb-2">
                        <a class="ticket-notify px-0 " href="#">
                            <h4 class=" text-gray ">10:10</h4>
                            <div class="ticket-body ticket-warning">
                                <p class="mb-2">Morbi quis ex eu arcu auctor sagittis.</p>
                                <span class="text-fade">by Johne</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-12 pe-1 mb-2">
                        <a class="ticket-notify px-0 " href="#">
                            <h4 class=" text-gray ">01:10</h4>
                            <div class="ticket-body ticket-info">
                                <p class="mb-2">Morbi quis ex eu arcu auctor sagittis.</p>
                                <span class="text-fade">by Johne</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-12 pe-1 mb-2">
                        <a class="ticket-notify px-0 " href="#">
                            <h4 class=" text-gray ">12:10</h4>
                            <div class="ticket-body ticket-success">
                                <p class="mb-2">Morbi quis ex eu arcu auctor sagittis.</p>
                                <span class="text-fade">by Johne</span>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-12 pe-1 mb-2">
                        <a class="ticket-notify px-0 " href="#">
                            <h4 class=" text-gray ">03:10</h4>
                            <div class="ticket-body ticket-alert">
                                <p class="mb-2">Morbi quis ex eu arcu auctor sagittis.</p>
                                <span class="text-fade">by Johne</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-12 pe-1 mb-2">
                        <a class="ticket-notify px-0 " href="#">
                            <h4 class=" text-gray ">10:10</h4>
                            <div class="ticket-body ticket-warning">
                                <p class="mb-2">Morbi quis ex eu arcu auctor sagittis.</p>
                                <span class="text-fade">by Johne</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-12 pe-1 mb-2">
                        <a class="ticket-notify px-0 " href="#">
                            <h4 class=" text-gray ">01:10</h4>
                            <div class="ticket-body ticket-info">
                                <p class="mb-2">Morbi quis ex eu arcu auctor sagittis.</p>
                                <span class="text-fade">by Johne</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-12 pe-1 mb-2">
                        <a class="ticket-notify px-0 " href="#">
                            <h4 class=" text-gray ">12:10</h4>
                            <div class="ticket-body ticket-success">
                                <p class="mb-2">Morbi quis ex eu arcu auctor sagittis.</p>
                                <span class="text-fade">by Johne</span>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-12 pe-1 mb-2">
                        <a class="ticket-notify px-0 " href="#">
                            <h4 class=" text-gray ">03:10</h4>
                            <div class="ticket-body ticket-alert">
                                <p class="mb-2">Morbi quis ex eu arcu auctor sagittis.</p>
                                <span class="text-fade">by Johne</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-12 pe-1 mb-2">
                        <a class="ticket-notify px-0 " href="#">
                            <h4 class=" text-gray ">10:10</h4>
                            <div class="ticket-body ticket-warning">
                                <p class="mb-2">Morbi quis ex eu arcu auctor sagittis.</p>
                                <span class="text-fade">by Johne</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-12 pe-1 mb-2">
                        <a class="ticket-notify px-0 " href="#">
                            <h4 class=" text-gray ">01:10</h4>
                            <div class="ticket-body ticket-info">
                                <p class="mb-2">Morbi quis ex eu arcu auctor sagittis.</p>
                                <span class="text-fade">by Johne</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-12 pe-1 mb-2">
                        <a class="ticket-notify px-0 " href="#">
                            <h4 class=" text-gray ">12:10</h4>
                            <div class="ticket-body ticket-success">
                                <p class="mb-2">Morbi quis ex eu arcu auctor sagittis.</p>
                                <span class="text-fade">by Johne</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- chat -->
        <div class="chat__popup">
            <div class="chat-header d-flex align-items-center">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <div class="d-flex align-items-center">
                        <div class="image-div">
                            <img src="{{ asset('images/vatar.png') }}" alt="" class="me-2">
                        </div>
                        <div>
                            <h2>Jhon Doe</h2>
                            <p class="status mb-0 pb-0">Active</p>
                        </div>
                    </div>
                    <button class="close-chat ms-auto">
                        <i class="fa-duotone fa-xmark-large"></i>
                    </button>
                </div>
            </div>
            <div class="body">
                <!-- recieve -->
                <div class="recieve">
                    <div class="d-flex align-items-center">
                        <div class="image-div">
                            <img src="{{ asset('images/vatar.png') }}" alt="" class="me-2">
                        </div>
                        <div>
                            <h2>10:20 pm</h2>
                            <p class="status mb-0 pb-0">Active</p>
                        </div>
                    </div>
                    <div class="recieved-msg">
                        <p class="mb-0 pb-0">Hi there, I'm Jesse and you?</p>
                    </div>
                </div>
                <!-- send -->
                <div class="send">
                    <div class="d-flex align-items-center justify-content-end">
                        <div class="text-end">
                            <h2>Jhon Doe</h2>
                            <p class="status mb-0 pb-0">02:23 am</p>
                        </div>
                        <div class="image-div">
                            <img src="{{ asset('images/vatar.png') }}" alt="" class="me-2">
                        </div>
                    </div>
                    <div class="send-msg ms-auto">
                        <p class="mb-0 pb-0">Hi there, I'm Jesse and you?</p>
                    </div>
                    <div class="send-msg ms-auto">
                        <p class="mb-0 pb-0">Are You ther?</p>
                    </div>
                </div>
                <!-- recieve -->
                <div class="recieve">
                    <div class="d-flex align-items-center">
                        <div class="image-div">
                            <img src="{{ asset('images/vatar.png') }}" alt="" class="me-2">
                        </div>
                        <div>
                            <h2>10:20 pm</h2>
                            <p class="status mb-0 pb-0">Active</p>
                        </div>
                    </div>
                    <div class="recieved-msg">
                        <p class="mb-0 pb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt porro
                            delectus quasi dolorem cum sequi.</p>
                    </div>
                    <div class="recieved-msg">
                        <p class="mb-0 pb-0">Lorem ipsum dolor sit.</p>
                    </div>
                </div>
                <!-- recieve -->
                <div class="recieve">
                    <div class="d-flex align-items-center">
                        <div class="image-div">
                            <img src="{{ asset('images/vatar.png') }}" alt="" class="me-2">
                        </div>
                        <div>
                            <h2>10:20 pm</h2>
                            <p class="status mb-0 pb-0">Active</p>
                        </div>
                    </div>
                    <div class="recieved-msg">
                        <p class="mb-0 pb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt porro
                            delectus quasi dolorem cum sequi.</p>
                    </div>
                    <div class="recieved-msg">
                        <p class="mb-0 pb-0">Lorem ipsum dolor sit.</p>
                    </div>
                </div>
                <!-- send -->
                <div class="send">
                    <div class="d-flex align-items-center justify-content-end">
                        <div class="text-end">
                            <h2>Jhon Doe</h2>
                            <p class="status mb-0 pb-0">02:23 am</p>
                        </div>
                        <div class="image-div">
                            <img {{ asset('images/vatar.png') }} alt="" class="me-2">
                        </div>
                    </div>
                    <div class="send-msg ms-auto">
                        <p class="mb-0 pb-0">Hi there, I'm Jesse and you?</p>
                    </div>
                    <div class="send-msg ms-auto">
                        <p class="mb-0 pb-0">Are You ther?</p>
                    </div>
                </div>
                <!-- recieve -->
                <div class="recieve">
                    <div class="d-flex align-items-center">
                        <div class="image-div">
                            <img {{ asset('images/vatar.png') }} alt="" class="me-2">
                        </div>
                        <div>
                            <h2>10:20 pm</h2>
                            <p class="status mb-0 pb-0">Active</p>
                        </div>
                    </div>
                    <div class="recieved-msg">
                        <p class="mb-0 pb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt porro
                            delectus quasi dolorem cum sequi.</p>
                    </div>
                    <div class="recieved-msg">
                        <p class="mb-0 pb-0">Lorem ipsum dolor sit.</p>
                    </div>
                </div>
            </div>
            <div class="type-area">
                <input type="text" placeholder="Type Here...">
                <i class="fa-solid fa-paper-plane-top "></i>
            </div>
        </div>
        <!-- -----------Main Contents----------- -->
        @yield('content')
        <div class="overlay"></div>

    </div>
    <!-- menu footer -->
    <footer class="menu-footer">
        <div class="footer-menu-link active-footer-menu">
            <a href="index.html">
                <i class="fa-duotone fa-grid-2"></i>
                Dashboard
            </a>
        </div>
        <div class="footer-menu-link">
            <a href="leads.html">
                <i class="fa-duotone fa-people-group"></i>
                Leads
            </a>
        </div>
        <div class="footer-menu-link">
            <a href="projects.html">
                <i class="fa-duotone fa-rectangle-history"></i>
                Projects
            </a>
        </div>
        <div class="footer-menu-link">
            <a href="chats.html">
                <i class="fa-duotone fa-messages"></i>
                Chats
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
            <a href="sales.html" class="d-flex align-items-center">
                <div class="more-icon">
                    <i class="fa-duotone fa-chart-mixed-up-circle-dollar"></i>
                </div>
                Sales
            </a>
        </div>
        <div class="d-flex align-items-center more-footer-link ">
            <a href="invoice-list.html" class="d-flex align-items-center ">
                <div class="more-icon">
                    <i class="fa-duotone fa-file-invoice-dollar"></i>
                </div>
                Invoices
            </a>
        </div>
        <div class="d-flex align-items-center more-footer-link">
            <a href="clients.html">
                <div class="more-icon">
                    <i class="fa-duotone fa-users-line"></i>
                </div>

                Clients
            </a>
        </div>
        <div class="d-flex align-items-center more-footer-link">
            <a href="partners.html">
                <div class="more-icon">
                    <i class="fa-duotone fa-user-group-simple"></i>
                </div>

                Partners
            </a>
        </div>

        <div class="d-flex align-items-center more-footer-link">
            <a href="staff.html">
                <div class="more-icon">
                    <i class="fa-duotone fa-user-tie"></i>
                </div>

                Staff
            </a>
        </div>
        <div class="d-flex align-items-center more-footer-link">
            <a href="support.html">
                <div class="more-icon">
                    <i class="fa-duotone fa-user-headset"></i>
                </div>

                Support
            </a>
        </div>
        <div class="d-flex align-items-center more-footer-link">
            <a href="email.html">
                <div class="more-icon">
                    <i class="fa-duotone fa-envelopes"></i>
                </div>
                Email
            </a>
        </div>
        <div class="d-flex align-items-center more-footer-link">
            <a href="log-in.html">
                <div class="more-icon">
                    <i class="fa-duotone fa-right-from-bracket"></i>
                </div>

                Logout
            </a>
        </div>
    </div>



    <div id="overlay-all" class="overlay"></div>

    <div id="overlay-sidebar"></div>

    {{-- Show toast after an operation --}}
    @if (session('status'))
        <x-toast type="success">
            {{ session('status') }}
        </x-toast>
    @endif


    <script>
        const assetUrls = {
            lightThemeURL: "{{ asset('css/light-theme.css') }}",
            darkThemeURL: "{{ asset('css/dark-theme.css') }}",
            lightLogoURL: "{{ asset('images/DigiSplix-Logo-for-Light-Mode.png') }}",
            darkLogoURL: "{{ asset('images/DigiSplix-logo-for-dark-mode.png') }}"
        };
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
