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
                            <h3 class="mb-0">Nil Yeager </h3>
                            <p class="mb-0 pb-0">Super Admin</p>
                        </div>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                        <li><a class="dropdown-item" href="profile.html"><i class="bi bi-person me-3"></i>Profile</a>
                        </li>
                        <li><a class="dropdown-item" href="settings.html"><i class="bi bi-gear me-3"></i>Settings</a>
                        <li><a class="dropdown-item" href="log-in.html"><i
                                    class="bi bi-arrow-bar-left me-3"></i>Logout</a>
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
                            <a href="index.html" class="active-menu">
                                <span class="menu-icon">
                                    <i class="fa-duotone fa-grid-2"></i>
                                </span>
                                <span class="menu-title">Dashboard </span>
                            </a>
                        </li>

                        <li class="menu-item">
                            <a href="leads.html">
                                <span class="menu-icon">
                                    <i class="fa-duotone fa-people-group"></i>

                                </span>
                                <span class="menu-title">Leads</span>
                            </a>
                        </li>

                        <li class="menu-item">
                            <a href="projects.html">
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
                            <a href="partners.html">
                                <span class="menu-icon">
                                    <i class="fa-duotone fa-user-group-simple"></i>
                                </span>

                                <span class="menu-title">Partners
                                </span>
                            </a>
                        </li>

                        <li class="menu-item">
                            <a href="clients.html">
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
                            <a href="staff.html">
                                <span class="menu-icon">
                                    <i class="fa-duotone fa-user-tie"></i>

                                </span>
                                <span class="menu-title">Staff
                                </span>
                            </a>
                        </li>

                        <li class="menu-item">
                            <a href="support.html">
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
