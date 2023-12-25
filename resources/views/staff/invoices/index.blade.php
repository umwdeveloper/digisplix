@extends('layouts.app')

@section('content')
    <main class="content">
        <div class="container-fluid px-lg-0">
            <div class="row justify-content-center">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-xl-3 col-md-6 mb-3">
                            <div class="box">
                                <h1 class="box-heading ">
                                    All Invoices <span class="text-primary">({{ $invoices->count() }})</span>
                                </h1>
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 box-text d-flex align-items-center">
                                        <span class="box-value">${{ $total_price }}</span>
                                    </div>
                                    <div class="box-icon">
                                        <i class="fa-duotone fa-file-lines"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-3">
                            <div class="box">
                                <h1 class="box-heading">
                                    Paid Invoices <span class="text-primary">({{ $paid_invoices->count() }})</span>
                                </h1>
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 box-text d-flex align-items-center">
                                        <span class="box-value">${{ $total_price_paid }}</span>
                                    </div>
                                    <div class="box-icon">
                                        <i class="fa-duotone fa-file-invoice-dollar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-3">
                            <div class="box">
                                <h1 class="box-heading">
                                    Overdue Invoices <span class="text-primary">({{ $overdue_invoices->count() }})</span>
                                </h1>
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 box-text d-flex align-items-center">
                                        <span class="box-value">${{ $total_price_overdue }}</span>
                                    </div>
                                    <div class="box-icon">
                                        <i class="fa-duotone fa-receipt"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-3">
                            <div class="box">
                                <h1 class="box-heading">
                                    Cancelled Invoices <span
                                        class="text-primary">({{ $cancelled_invoices->count() }})</span>
                                </h1>
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 box-text d-flex align-items-center">
                                        <span class="box-value">${{ $total_price_cancelled }}</span>
                                    </div>
                                    <div class="box-icon">
                                        <i class="fa-duotone fa-file-invoice"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12 mb-3">
                            <div class="box" style="overflow: visible !important; z-index: 1 !important">
                                <form action="{{ route('staff.invoices.filtered') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-3 col-lg-6 mb-3">
                                            <div class="multipleSelection">
                                                <div class="selectBox">
                                                    <p class="mb-0">
                                                        <svg stroke="currentColor" fill="none" stroke-width="2"
                                                            class="me-3" viewBox="0 0 24 24" stroke-linecap="round"
                                                            stroke-linejoin="round" height="1em" width="1em"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                                            <circle cx="8.5" cy="7" r="4"></circle>
                                                            <line x1="20" y1="8" x2="20"
                                                                y2="14">
                                                            </line>
                                                            <line x1="23" y1="11" x2="17"
                                                                y2="11">
                                                            </line>
                                                        </svg>
                                                        Select User
                                                    </p>
                                                    <span class="down-icon"><i class="fa fa-angle-down"
                                                            aria-hidden="true"></i></span>
                                                </div>
                                                <div class="checkBoxes" style="display: none">
                                                    <div class="arrow-up"></div>
                                                    <p class="checkbox-title">Customer Search</p>
                                                    <div class="form-custom">
                                                        <input id="clientSearchInput" type="text"
                                                            class="form-control bg-grey"
                                                            placeholder="Enter Customer Name" />
                                                    </div>
                                                    <div class="selectBox-cont">
                                                        @foreach ($clients as $client)
                                                            <label class="custom_check w-100 clientCheckbox"><input
                                                                    type="checkbox" name="clients[]"
                                                                    value="{{ $client->id }}" /><span
                                                                    class="checkmark"></span>
                                                                {{ $client->user->name }}
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 mb-3">
                                            <div class="multipleSelection">
                                                <div class="selectBox">
                                                    <p class="mb-0">
                                                        <svg class="me-3" stroke="currentColor" fill="none"
                                                            stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round"
                                                            stroke-linejoin="round" height="1em" width="1em"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <rect x="3" y="4" width="18" height="18"
                                                                rx="2" ry="2">
                                                            </rect>
                                                            <line x1="16" y1="2" x2="16"
                                                                y2="6"></line>
                                                            <line x1="8" y1="2" x2="8"
                                                                y2="6"></line>
                                                            <line x1="3" y1="10" x2="21"
                                                                y2="10"></line>
                                                        </svg>

                                                        Select Date
                                                    </p>
                                                    <span class="down-icon"><i class="fa fa-angle-down"
                                                            aria-hidden="true"></i></span>
                                                </div>
                                                <input type="hidden" name="start_date" id="start-date-value">
                                                <input type="hidden" name="end_date" id="end-date-value">
                                                <div class="checkBoxes" style="display: none">
                                                    <div class="arrow-up"></div>
                                                    <p class="checkbox-title">Date Filter</p>
                                                    <div class="selectBox-cont1 selectBox-cont-one h-auto">
                                                        <div class="d-flex flex-wrap">
                                                            <div class="date-picker flex-grow-1">
                                                                <div class="form-custom cal-icon">
                                                                    <div class="react-datepicker-wrapper">
                                                                        <div class="react-datepicker__input-container ">
                                                                            <span role="alert" aria-live="polite"
                                                                                class="react-datepicker__aria-live"></span><input
                                                                                type="date" class="form-control dates"
                                                                                id="start-date">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="date-picker flex-grow-1">
                                                                <div class="form-custom cal-icon">
                                                                    <div class="react-datepicker-wrapper">
                                                                        <div class="react-datepicker__input-container ">
                                                                            <span role="alert" aria-live="polite"
                                                                                class="react-datepicker__aria-live"></span><input
                                                                                type="date" class="form-control dates"
                                                                                id="end-date">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="date-list">
                                                            <ul>
                                                                @php
                                                                    $endDate = now();
                                                                    $startDate = now();
                                                                @endphp
                                                                <li><a href="#" id="today"
                                                                        data-start-date="{{ $startDate->format('Y/m/d') . ' 00:00:00' }}"
                                                                        data-end-date="{{ $endDate->format('Y/m/d') . ' 23:59:59' }}"
                                                                        class="btn date-btn">Today</a></li>
                                                                @php
                                                                    $endDate = now()->subDay();
                                                                    $startDate = now()->subday();
                                                                @endphp
                                                                <li><a href="#" id="yesterday"
                                                                        data-start-date="{{ $startDate->format('Y/m/d') . ' 00:00:00' }}"
                                                                        data-end-date="{{ $endDate->format('Y/m/d') . ' 23:59:59' }}"
                                                                        class="btn date-btn">Yesterday</a>
                                                                </li>
                                                                @php
                                                                    $endDate = now();
                                                                    $startDate = now()->subdays(6);
                                                                @endphp
                                                                <li><a href="#" id="days7"
                                                                        data-start-date="{{ $startDate->format('Y/m/d') . ' 00:00:00' }}"
                                                                        data-end-date="{{ $endDate->format('Y/m/d') . ' 23:59:59' }}"
                                                                        class="btn date-btn">Last 7 days</a>
                                                                </li>
                                                                @php
                                                                    $endDate = now()->endOfMonth();
                                                                    $startDate = now()->startOfMonth();
                                                                @endphp
                                                                <li><a href="#" id="month"
                                                                        data-start-date="{{ $startDate->format('Y/m/d H:i:s') }}"
                                                                        data-end-date="{{ $endDate->format('Y/m/d H:i:s') }}"
                                                                        class="btn date-btn">This month</a>
                                                                </li>
                                                                @php
                                                                    $endDate = now()
                                                                        ->subMonth()
                                                                        ->endOfMonth();
                                                                    $startDate = now()
                                                                        ->subMonth()
                                                                        ->startOfMonth();
                                                                @endphp
                                                                <li><a href="#" id="last-month"
                                                                        data-start-date="{{ $startDate->format('Y/m/d H:i:s') }}"
                                                                        data-end-date="{{ $endDate->format('Y/m/d H:i:s') }}"
                                                                        class="btn date-btn mb-0">Last
                                                                        month</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 mb-3">
                                            <div class="multipleSelection">
                                                <div class="selectBox">
                                                    <p class="mb-0">
                                                        <svg class="me-3" stroke="currentColor" fill="none"
                                                            stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round"
                                                            stroke-linejoin="round" height="1em" width="1em"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                                                            <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                                                        </svg>
                                                        Select Status
                                                    </p>
                                                    <span class="down-icon"><i class="fa fa-angle-down"
                                                            aria-hidden="true"></i></span>
                                                </div>
                                                <div class="checkBoxes" style="display: none">
                                                    <div class="arrow-up"></div>
                                                    <p class="checkbox-title">By Status</p>
                                                    <div class="selectBox-cont">
                                                        @foreach ($statuses as $status)
                                                            <label class="custom_check w-100"><input type="checkbox"
                                                                    name="statuses[]" value="{{ $status }}"><span
                                                                    class="checkmark"></span>{{ $status_labels[$status] }}</label>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 mb-3">
                                            <div class="multipleSelection">
                                                <div class="selectBox">
                                                    <p class="mb-0">
                                                        <svg class="me-3" stroke="currentColor" fill="none"
                                                            stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round"
                                                            stroke-linejoin="round" height="1em" width="1em"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z">
                                                            </path>
                                                        </svg>
                                                        By Category
                                                    </p>
                                                    <span class="down-icon"><i class="fa fa-angle-down"
                                                            aria-hidden="true"></i></span>
                                                </div>
                                                <div class="checkBoxes" style="display: none">
                                                    <div class="arrow-up"></div>
                                                    <p class="checkbox-title">Category</p>
                                                    <div class="form-custom"><input type="text"
                                                            class="form-control bg-grey" id="categorySearchInput"
                                                            placeholder="Enter Category Name">
                                                    </div>
                                                    <div class="selectBox-cont">
                                                        @foreach ($categories as $category)
                                                            <label class="custom_check w-100 categoryCheckbox"><input
                                                                    type="checkbox" name="categories[]"
                                                                    value="{{ $category->id }}"><span
                                                                    class="checkmark"></span>
                                                                {{ $category->name }}</label>
                                                        @endforeach
                                                    </div>
                                                    <div class="d-flex">
                                                        <button type="submit"
                                                            class="btn w-100 ticket-fill me-1">Apply</button><button
                                                            type="reset"
                                                            class="btn w-100 ticket-blank ms-1">Reset</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center ">
                                        <button type="submit" class="btn w-25 ticket-fill me-1 d-inline ">Apply</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 ">
                        <div class="box mb-3 box-p">
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <h1 class="f-20 w-500 mb-0 pb-0 text-dark-clr">Invoices</h1>
                                    <div class="d-flex align-items-center">
                                        <a href="{{ route('staff.invoices.create') }}" class="table-btn">
                                            Add Invoice
                                        </a>
                                    </div>
                                </div>
                                <div class="invoice-tabs-div">
                                    <div class="tab invoice-tabs">
                                        <button class="tablink" data-tab="Tab1" id="defaultOpen">
                                            All Invoices
                                        </button>
                                        <button class="tablink" data-tab="Tab2">
                                            Paid
                                        </button>
                                        <button class="tablink" data-tab="Tab3">Overdue</button>
                                        <button class="tablink" data-tab="Tab4">
                                            Draft
                                        </button>
                                        <button class="tablink" data-tab="Tab5">Recurring</button>
                                        <button class="tablink" data-tab="Tab6">
                                            Cancelled
                                        </button>
                                    </div>
                                </div>

                                <div id="Tab1" class="tabcontent-lead">
                                    <table id="example" class="table data-table-style">
                                        <thead>
                                            <tr>
                                                <th class="no-sort"></th>
                                                <th class="">
                                                    <div class="d-flex align-items-center">
                                                        <input type="checkbox" class="table-checkbox ">Invoice ID
                                                    </div>
                                                </th>
                                                <th>Category</th>
                                                <th>Created On</th>
                                                <th>Invoice to</th>
                                                <th>Amount</th>
                                                <th>Due Date</th>
                                                <th>Status</th>
                                                <th>Edit</th>
                                                <th>Mark as sent</th>
                                                <th>Send Invoice</th>
                                                <th>Clone Invoice</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($invoices as $invoice)
                                                <tr class="">
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="table-arrow">
                                                                <!-- <i class="fa-duotone fa-circle-chevron-down"></i> -->
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <input type="checkbox"
                                                                class="table-checkbox">#{{ $invoice->invoice_id }}
                                                        </div>
                                                    </td>
                                                    <td class="">{{ $invoice->category->name }}</td>
                                                    <td>{{ $invoice->created_at->format('d M Y') }}</td>
                                                    <td class="bussiness-name">{{ $invoice->invoice_to }}</td>
                                                    <td class="bussiness-name">
                                                        ${{ round($invoice->items_sum_price) }}
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($invoice->due_date)->format('d/m/y') }}
                                                    </td>

                                                    <td>
                                                        <div class="dropdown table-dropdown">
                                                            <a class="btn  dropdown-toggle table-dropdown-btn invoice-{{ $invoice->status }}"
                                                                href="#" role="button" id="dropdownMenuLink"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                {{ $status_labels[$invoice->status] }}
                                                            </a>

                                                            <ul class="dropdown-menu"
                                                                data-invoice-id="{{ $invoice->id }}"
                                                                aria-labelledby="dropdownMenuLink">
                                                                @foreach ($statuses as $status)
                                                                    <li class="change-status invoice-{{ $status }}"
                                                                        data-status="{{ $status }}"><a
                                                                            class="dropdown-item {{ $status }}"
                                                                            href="#">{{ $status_labels[$status] }}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </td>

                                                    </td>
                                                    <td><a href="{{ route('staff.invoices.edit', $invoice->id) }}"
                                                            class="edit"><i class="fa-solid fa-pencil me-2"></i>Edit</a>

                                                    </td>

                                                    <td><a class="edit mark-as-sent"
                                                            data-invoice-id="{{ $invoice->id }}"
                                                            data-sent="{{ $invoice->sent }}" href="#"><i
                                                                class="bi bi-send-check-fill me-2"></i><span>{{ $invoice->sent == 0 ? 'Mark as Sent' : 'Mark as Unsent' }}</span></a>
                                                    </td>
                                                    <td><a class="edit send-invoice"
                                                            data-invoice-id="{{ $invoice->id }}" href="#"><i
                                                                class="bi bi-receipt me-2"></i>Send
                                                            Invoice</a></td>
                                                    <td><a class="edit"
                                                            href="{{ route('staff.invoices.clone', $invoice->id) }}"><i
                                                                class="bi bi-clipboard-plus-fill me-2"></i>Clone
                                                            Invoice</a></td>
                                                    <td> <button class="delete ms-0"><i
                                                                class="fa-solid fa-trash me-2"></i>
                                                            Delete</button></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div id="Tab2" class="tabcontent-lead">
                                    <div id="In-Progress">
                                        <table id="example-inprogress" class="table data-table-style">
                                            <thead>
                                                <tr>
                                                    <th class="no-sort"></th>
                                                    <th class="">
                                                        <div class="d-flex align-items-center">
                                                            <input type="checkbox" class="table-checkbox ">Invoice
                                                            ID
                                                        </div>
                                                    </th>

                                                    <th>Created On</th>
                                                    <th>Invoice to</th>
                                                    <th>Amount</th>
                                                    <th>Paid On</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($paid_invoices as $invoice)
                                                    <tr class="">
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="table-arrow">
                                                                    <!-- <i class="fa-duotone fa-circle-chevron-down"></i> -->
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <input type="checkbox"
                                                                    class="table-checkbox">#{{ $invoice->invoice_id }}
                                                            </div>
                                                        </td>
                                                        <td>{{ $invoice->created_at->format('d M Y') }}</td>
                                                        <td class="bussiness-name">{{ $invoice->invoice_to }}</td>
                                                        <td class="bussiness-name">
                                                            ${{ round($invoice->items_sum_price) }}
                                                        </td>
                                                        <td>12/4/2034</td>

                                                        <td>
                                                            <div class="dropdown table-dropdown">
                                                                <a class="btn  dropdown-toggle table-dropdown-btn {{ $invoice->status }}"
                                                                    href="#" role="button" id="dropdownMenuLink"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                    {{ $status_labels[$invoice->status] }}
                                                                </a>

                                                                <ul class="dropdown-menu"
                                                                    data-invoice-id="{{ $invoice->id }}"
                                                                    aria-labelledby="dropdownMenuLink">
                                                                    @foreach ($statuses as $status)
                                                                        <li class="change-status"
                                                                            data-status="{{ $status }}"><a
                                                                                class="dropdown-item {{ $status }}"
                                                                                href="#">{{ $status_labels[$status] }}</a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <a href="edit-invoice.html" class="edit"><i
                                                                        class="fa-solid fa-pencil me-2"></i>Edit</a>
                                                                <button class="delete ms-3"><i
                                                                        class="fa-solid fa-trash me-2"></i>
                                                                    Delete</button>
                                                            </div>

                                                        </td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div id="Tab3" class="tabcontent-lead">
                                    <table id="example-failed" class="table data-table-style">
                                        <thead>
                                            <tr>
                                                <th class="no-sort"></th>
                                                <th class="">
                                                    <div class="d-flex align-items-center">
                                                        <input type="checkbox" class="table-checkbox ">Invoice ID
                                                    </div>
                                                </th>

                                                <th>Created On</th>
                                                <th>Invoice to</th>
                                                <th>Amount</th>
                                                <th>Last Date</th>
                                                <th>Status</th>
                                                <th>Actions</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($overdue_invoices as $invoice)
                                                <tr class="">
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="table-arrow">
                                                                <!-- <i class="fa-duotone fa-circle-chevron-down"></i> -->
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <input type="checkbox"
                                                                class="table-checkbox">#{{ $invoice->invoice_id }}
                                                        </div>
                                                    </td>
                                                    <td>{{ $invoice->created_at->format('d M Y') }}</td>
                                                    <td class="bussiness-name">{{ $invoice->invoice_to }}</td>
                                                    <td class="bussiness-name">
                                                        ${{ round($invoice->items_sum_price) }}
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($invoice->due_date)->format('d/m/y') }}
                                                    </td>

                                                    <td>
                                                        <div class="dropdown table-dropdown">
                                                            <a class="btn  dropdown-toggle table-dropdown-btn {{ $invoice->status }}"
                                                                href="#" role="button" id="dropdownMenuLink"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                {{ $status_labels[$invoice->status] }}
                                                            </a>

                                                            <ul class="dropdown-menu"
                                                                data-invoice-id="{{ $invoice->id }}"
                                                                aria-labelledby="dropdownMenuLink">
                                                                @foreach ($statuses as $status)
                                                                    <li class="change-status"
                                                                        data-status="{{ $status }}"><a
                                                                            class="dropdown-item {{ $status }}"
                                                                            href="#">{{ $status_labels[$status] }}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <a href="edit-invoice.html" class="edit"><i
                                                                    class="fa-solid fa-pencil me-2"></i>Edit</a>
                                                            <button class="delete ms-3"><i
                                                                    class="fa-solid fa-trash me-2"></i>
                                                                Delete</button>
                                                        </div>

                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div id="Tab4" class="tabcontent-lead">
                                    <table id="example-qualify" class="table data-table-style">
                                        <thead>
                                            <tr>
                                                <th class="no-sort"></th>
                                                <th class="">
                                                    <div class="d-flex align-items-center">
                                                        <input type="checkbox" class="table-checkbox ">Invoice ID
                                                    </div>
                                                </th>

                                                <th>Created On</th>
                                                <th>Invoice to</th>
                                                <th>Amount</th>
                                                <th>Status</th>

                                                <th>Actions</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($draft_invoices as $invoice)
                                                <tr class="">
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="table-arrow">
                                                                <!-- <i class="fa-duotone fa-circle-chevron-down"></i> -->
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <input type="checkbox"
                                                                class="table-checkbox">#{{ $invoice->invoice_id }}
                                                        </div>
                                                    </td>
                                                    <td>{{ $invoice->created_at->format('d M Y') }}</td>
                                                    <td class="bussiness-name">{{ $invoice->invoice_to }}</td>
                                                    <td class="bussiness-name">
                                                        ${{ round($invoice->items_sum_price) }}
                                                    </td>

                                                    <td>
                                                        <div class="dropdown table-dropdown">
                                                            <a class="btn  dropdown-toggle table-dropdown-btn {{ $invoice->status }}"
                                                                href="#" role="button" id="dropdownMenuLink"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                {{ $status_labels[$invoice->status] }}
                                                            </a>

                                                            <ul class="dropdown-menu"
                                                                data-invoice-id="{{ $invoice->id }}"
                                                                aria-labelledby="dropdownMenuLink">
                                                                @foreach ($statuses as $status)
                                                                    <li class="change-status"
                                                                        data-status="{{ $status }}"><a
                                                                            class="dropdown-item {{ $status }}"
                                                                            href="#">{{ $status_labels[$status] }}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <a href="edit-invoice.html" class="edit"><i
                                                                    class="fa-solid fa-pencil me-2"></i>Edit</a>
                                                            <button class="delete ms-3"><i
                                                                    class="fa-solid fa-trash me-2"></i>
                                                                Delete</button>
                                                        </div>

                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div id="Tab5" class="tabcontent-lead">
                                    <table id="example-recurring" class="table data-table-style">
                                        <thead>
                                            <tr>
                                                <th class="no-sort"></th>
                                                <th class="">
                                                    <div class="d-flex align-items-center">
                                                        <input type="checkbox" class="table-checkbox ">Invoice ID
                                                    </div>
                                                </th>
                                                <th>Created On</th>
                                                <th>Invoice to</th>
                                                <th>Amount</th>
                                                {{-- <th>Last Invoice</th>
                                                <th>Next Invoice</th>
                                                <th>Frequency</th> --}}
                                                <th>Status</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($recurring_invoices as $invoice)
                                                <tr class="">
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="table-arrow">
                                                                <!-- <i class="fa-duotone fa-circle-chevron-down"></i> -->
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <input type="checkbox"
                                                                class="table-checkbox">#{{ $invoice->invoice_id }}
                                                        </div>
                                                    </td>
                                                    <td>{{ $invoice->created_at->format('d M Y') }}</td>
                                                    <td class="bussiness-name">{{ $invoice->invoice_to }}</td>
                                                    <td class="bussiness-name">
                                                        ${{ round($invoice->items_sum_price) }}
                                                    </td>

                                                    <td>
                                                        <div class="dropdown table-dropdown">
                                                            <a class="btn  dropdown-toggle table-dropdown-btn {{ $invoice->status }}"
                                                                href="#" role="button" id="dropdownMenuLink"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                {{ $status_labels[$invoice->status] }}
                                                            </a>

                                                            <ul class="dropdown-menu"
                                                                data-invoice-id="{{ $invoice->id }}"
                                                                aria-labelledby="dropdownMenuLink">
                                                                @foreach ($statuses as $status)
                                                                    <li class="change-status"
                                                                        data-status="{{ $status }}"><a
                                                                            class="dropdown-item {{ $status }}"
                                                                            href="#">{{ $status_labels[$status] }}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <a href="edit-invoice.html" class="edit"><i
                                                                    class="fa-solid fa-pencil me-2"></i>Edit</a>
                                                            <button class="delete ms-3"><i
                                                                    class="fa-solid fa-trash me-2"></i>
                                                                Delete</button>
                                                        </div>

                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div id="Tab6" class="tabcontent-lead">
                                    <table id="example-cancelled" class="table data-table-style">
                                        <thead>
                                            <tr>
                                                <th class="no-sort"></th>
                                                <th class="">
                                                    <div class="d-flex align-items-center">
                                                        <input type="checkbox" class="table-checkbox ">Invoice ID
                                                    </div>
                                                </th>
                                                <th>Created On</th>
                                                <th>Invoice to</th>
                                                <th>Amount</th>
                                                {{-- <th>Last Invoice</th>
                                                <th>Next Invoice</th>
                                                <th>Frequency</th> --}}
                                                <th>Status</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cancelled_invoices as $invoice)
                                                <tr class="">
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="table-arrow">
                                                                <!-- <i class="fa-duotone fa-circle-chevron-down"></i> -->
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <input type="checkbox"
                                                                class="table-checkbox">#{{ $invoice->invoice_id }}
                                                        </div>
                                                    </td>
                                                    <td>{{ $invoice->created_at->format('d M Y') }}</td>
                                                    <td class="bussiness-name">{{ $invoice->invoice_to }}</td>
                                                    <td class="bussiness-name">
                                                        ${{ round($invoice->items_sum_price) }}
                                                    </td>

                                                    <td>
                                                        <div class="dropdown table-dropdown">
                                                            <a class="btn  dropdown-toggle table-dropdown-btn {{ $invoice->status }}"
                                                                href="#" role="button" id="dropdownMenuLink"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                {{ $status_labels[$invoice->status] }}
                                                            </a>

                                                            <ul class="dropdown-menu"
                                                                data-invoice-id="{{ $invoice->id }}"
                                                                aria-labelledby="dropdownMenuLink">
                                                                @foreach ($statuses as $status)
                                                                    <li class="change-status"
                                                                        data-status="{{ $status }}"><a
                                                                            class="dropdown-item {{ $status }}"
                                                                            href="#">{{ $status_labels[$status] }}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <a href="edit-invoice.html" class="edit"><i
                                                                    class="fa-solid fa-pencil me-2"></i>Edit</a>
                                                            <button class="delete ms-3"><i
                                                                    class="fa-solid fa-trash me-2"></i>
                                                                Delete</button>
                                                        </div>

                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-12">
                    <div class="box">
                        <p class="f-14 w-500 mb-0 pb-0 text-center text-gray text-dark-clr" id="copyright-year"></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- </div> -->
    </main>

@section('script')
    <script>
        $(document).ready(function() {
            // Click event for tab buttons
            $(".tablink").click(function() {
                var tabName = $(this).data("tab");

                // Remove the "active" class from all tab buttons
                $(".tablink").removeClass("active");

                // Hide all tab content
                $(".tabcontent-lead").hide();

                // Show the selected tab content
                $("#" + tabName).show();

                // Add the "active" class to the clicked tab button
                $(this).addClass("active");
            });

            // Trigger the default tab to open
            $("#defaultOpen").click();
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Get all selectBox and checkBoxes elements
            const selectBoxes = document.querySelectorAll(".selectBox");
            const checkBoxesList = document.querySelectorAll(".checkBoxes");

            // Add click event listener to each selectBox
            selectBoxes.forEach(function(selectBox, index) {
                selectBox.addEventListener("click", function() {
                    // Toggle the display of the corresponding checkBoxes element
                    checkBoxesList[index].style.display = checkBoxesList[index].style.display ===
                        "block" ? "none" : "block";
                });
            });

            // Close the dropdown when clicking outside of any selectBox
            document.addEventListener("click", function(event) {
                selectBoxes.forEach(function(selectBox, index) {
                    if (!selectBox.contains(event.target)) {
                        checkBoxesList[index].style.display = "none";
                    }
                });
            });

            // Prevent the dropdown from closing when clicking inside it
            checkBoxesList.forEach(function(checkBoxes) {
                checkBoxes.addEventListener("click", function(event) {
                    event.stopPropagation();
                });
            });
        });
    </script>

    {{-- Search clients --}}
    <script>
        $(document).ready(function() {
            // Handle keyup event on the search input
            $('#clientSearchInput').on('keyup', function() {
                var searchTerm = $(this).val().toLowerCase();

                // Hide or show clients based on the search term
                $('.clientCheckbox').each(function() {
                    var clientName = $(this).text().toLowerCase();
                    var isVisible = clientName.includes(searchTerm);
                    $(this).toggle(isVisible);
                });
            });
        });
    </script>

    {{-- Search categories --}}
    <script>
        $(document).ready(function() {
            // Handle keyup event on the search input
            $('#categorySearchInput').on('keyup', function() {
                var searchTerm = $(this).val().toLowerCase();

                // Hide or show clients based on the search term
                $('.categoryCheckbox').each(function() {
                    var categoryName = $(this).text().toLowerCase();
                    var isVisible = categoryName.includes(searchTerm);
                    $(this).toggle(isVisible);
                });
            });
        });
    </script>

    {{-- Update status --}}
    <script>
        $('body').on('click', '.change-status', function() {
            let status = $(this).data('status');
            let invoiceID = $(this).closest('ul').data('invoice-id');

            $.ajax({
                url: '{{ route('staff.invoices.update_invoice_status', 'invoice_id') }}'.replace(
                    'invoice_id',
                    invoiceID),
                type: 'PATCH',
                data: {
                    '_token': '{{ csrf_token() }}',
                    status
                },
                success: function(response) {
                    if (response.status == 'success') {
                        location.reload()
                    } else {
                        alert(response.message)
                    }
                }
            })
        })
    </script>

    {{-- Mark as sent --}}
    <script>
        $('body').on('click', '.mark-as-sent', function() {
            let invoiceID = $(this).data('invoice-id');
            let sent = $(this).data('sent') == 0 ? 1 : 0;

            var that = $(this)
            $.ajax({
                url: '{{ route('staff.invoices.mark_as_sent', 'invoice_id') }}'.replace(
                    'invoice_id',
                    invoiceID),
                type: 'PATCH',
                data: {
                    '_token': '{{ csrf_token() }}',
                    sent
                },
                success: function(response) {
                    if (response.status == 'success') {
                        that.data('sent', sent)
                        that.find('span').text(sent == 0 ? 'Mark as Sent' : 'Mark as Unsent')
                    } else {
                        alert(response.message)
                    }
                }
            })
        })
    </script>

    {{-- Send Invoice --}}
    <script>
        $('body').on('click', '.send-invoice', function() {
            $('.loading').removeClass('d-none');
            let invoiceID = $(this).data('invoice-id');

            let that = $(this)
            $.ajax({
                url: '{{ route('staff.invoices.send_invoice', 'invoice_id') }}'.replace(
                    'invoice_id',
                    invoiceID),
                type: 'PATCH',
                data: {
                    '_token': '{{ csrf_token() }}',
                },
                success: function(response) {
                    console.log(response);
                    if (response.status == 'success') {
                        $('.loading').addClass('d-none');
                        that.closest('tr').find('.mark-as-sent').data('sent', 1)
                        that.closest('tr').find('.mark-as-sent').find('span').text('Mark as Unsent')
                        alert("Invoice has been sent")
                    } else {
                        alert(response.message)
                    }
                }
            })
        })
    </script>

    {{-- Date filter --}}
    <script>
        $('.date-btn').on('click', function() {
            $('#start-date-value').val($(this).data('start-date'))
            $('#end-date-value').val($(this).data('end-date'))
        })

        $('.dates').on('change', function() {
            $('#start-date-value').val($('#start-date').val())
            $('#end-date-value').val($('#end-date').val())
        })
    </script>
@endsection
@endsection
