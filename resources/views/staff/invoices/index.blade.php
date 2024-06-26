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
                                        <span class="box-value">${{ number_format($total_price, 0, ',') }}</span>
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
                                        <span class="box-value">${{ number_format($total_price_paid, 0, ',') }}</span>
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
                                        <span class="box-value">${{ number_format($total_price_overdue, 0, ',') }}</span>
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
                                        <span class="box-value">${{ number_format($total_price_cancelled, 0, ',') }}</span>
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
                                                <th class="">Invoice ID</th>
                                                <th>Category</th>
                                                <th>Created On</th>
                                                <th>Invoice to</th>
                                                <th>Amount</th>
                                                <th>Due Date</th>
                                                <th>Status</th>
                                                <th>View</th>
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
                                                        <div class="d-flex align-items-center previewBtn"
                                                            style="cursor: pointer" data-id="{{ $invoice->id }}">
                                                            #{{ $invoice->invoice_id }}
                                                        </div>
                                                    </td>
                                                    <td class="">{{ $invoice->category->name }}</td>
                                                    <td>{{ $invoice->created_at->format('d M Y') }}</td>
                                                    <td class="bussiness-name">{{ $invoice->client->user->name }}</td>
                                                    <td class="bussiness-name">
                                                        ${{ number_format(round($invoice->items_sum_price), 0, ',') }}
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($invoice->due_date)->format('d M Y') }}
                                                    </td>

                                                    <td>
                                                        <div class="dropdown table-dropdown">
                                                            <a class="btn  dropdown-toggle table-dropdown-btn invoice-{{ $invoice->status }}"
                                                                href="#"
                                                                style="{{ $invoice->status == 'pending' ? 'color: black' : '' }}"
                                                                role="button" id="dropdownMenuLink"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                {{ $status_labels[$invoice->status] }}
                                                            </a>

                                                            <ul class="dropdown-menu"
                                                                data-invoice-id="{{ $invoice->id }}"
                                                                aria-labelledby="dropdownMenuLink">
                                                                @foreach ($statuses as $status)
                                                                    <li class="change-status invoice-{{ $status }}"
                                                                        style="{{ $status === 'pending' ? 'color: black !important' : '' }}"
                                                                        data-status="{{ $status }}"><a
                                                                            class="dropdown-item {{ $status }}"
                                                                            style="{{ $status === 'pending' ? 'color: black !important' : '' }}"
                                                                            href="#">{{ $status_labels[$status] }}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </td>

                                                    <td><a class="edit previewBtn" data-id="{{ $invoice->id }}"
                                                            href="#"><i class="bi bi-eye me-2"></i>View</a></td>
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
                                                    <td>
                                                        <form action="{{ route('staff.invoices.destroy', $invoice->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="delete">Delete</button>
                                                        </form>
                                                    </td>
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
                                                    <th class="">Invoice ID</th>

                                                    <th>Created On</th>
                                                    <th>Invoice to</th>
                                                    <th>Amount</th>
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
                                                            <div class="d-flex align-items-center previewBtn"
                                                                style="cursor: pointer" data-id="{{ $invoice->id }}">
                                                                #{{ $invoice->invoice_id }}
                                                            </div>
                                                        </td>
                                                        <td>{{ $invoice->created_at->format('d M Y') }}</td>
                                                        <td class="bussiness-name">{{ $invoice->client->user->name }}</td>
                                                        <td class="bussiness-name">
                                                            ${{ number_format(round($invoice->items_sum_price), 0, ',') }}
                                                        </td>

                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <a href="edit-invoice.html" class="edit"><i
                                                                        class="fa-solid fa-pencil me-2"></i>Edit</a>
                                                                <form
                                                                    action="{{ route('staff.invoices.destroy', $invoice->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="delete">Delete</button>
                                                                </form>
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
                                                <th class="">Invoice ID</th>

                                                <th>Created On</th>
                                                <th>Invoice to</th>
                                                <th>Amount</th>
                                                <th>Last Date</th>
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
                                                        <div class="d-flex align-items-center previewBtn"
                                                            style="cursor: pointer" data-id="{{ $invoice->id }}">
                                                            #{{ $invoice->invoice_id }}
                                                        </div>
                                                    </td>
                                                    <td>{{ $invoice->created_at->format('d M Y') }}</td>
                                                    <td class="bussiness-name">{{ $invoice->client->user->name }}</td>
                                                    <td class="bussiness-name">
                                                        ${{ number_format(round($invoice->items_sum_price), 0, ',') }}
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($invoice->due_date)->format('d M Y') }}
                                                    </td>

                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <a href="edit-invoice.html" class="edit"><i
                                                                    class="fa-solid fa-pencil me-2"></i>Edit</a>
                                                            <form
                                                                action="{{ route('staff.invoices.destroy', $invoice->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="delete">Delete</button>
                                                            </form>
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
                                                <th class="">Invoice ID</th>

                                                <th>Created On</th>
                                                <th>Invoice to</th>
                                                <th>Amount</th>
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
                                                        <div class="d-flex align-items-center previewBtn"
                                                            style="cursor: pointer" data-id="{{ $invoice->id }}">
                                                            #{{ $invoice->invoice_id }}
                                                        </div>
                                                    </td>
                                                    <td>{{ $invoice->created_at->format('d M Y') }}</td>
                                                    <td class="bussiness-name">{{ $invoice->client->user->name }}</td>
                                                    <td class="bussiness-name">
                                                        ${{ number_format(round($invoice->items_sum_price), 0, ',') }}
                                                    </td>

                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <a href="edit-invoice.html" class="edit"><i
                                                                    class="fa-solid fa-pencil me-2"></i>Edit</a>
                                                            <form
                                                                action="{{ route('staff.invoices.destroy', $invoice->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="delete">Delete</button>
                                                            </form>
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
                                                <th class="">Invoice ID</th>
                                                <th>Created On</th>
                                                <th>Invoice to</th>
                                                <th>Amount</th>
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
                                                        <div class="d-flex align-items-center previewBtn"
                                                            style="cursor: pointer" data-id="{{ $invoice->id }}">
                                                            #{{ $invoice->invoice_id }}
                                                        </div>
                                                    </td>
                                                    <td>{{ $invoice->created_at->format('d M Y') }}</td>
                                                    <td class="bussiness-name">{{ $invoice->client->user->name }}</td>
                                                    <td class="bussiness-name">
                                                        ${{ number_format(round($invoice->items_sum_price), 0, ',') }}
                                                    </td>

                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <a href="edit-invoice.html" class="edit"><i
                                                                    class="fa-solid fa-pencil me-2"></i>Edit</a>
                                                            <form
                                                                action="{{ route('staff.invoices.destroy', $invoice->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="delete">Delete</button>
                                                            </form>
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
                                                <th class="">Invoice ID</th>
                                                <th>Created On</th>
                                                <th>Invoice to</th>
                                                <th>Amount</th>
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
                                                        <div class="d-flex align-items-center previewBtn"
                                                            style="cursor: pointer" data-id="{{ $invoice->id }}">
                                                            #{{ $invoice->invoice_id }}
                                                        </div>
                                                    </td>
                                                    <td>{{ $invoice->created_at->format('d M Y') }}</td>
                                                    <td class="bussiness-name">{{ $invoice->client->user->name }}</td>
                                                    <td class="bussiness-name">
                                                        ${{ number_format(round($invoice->items_sum_price), 0, ',') }}
                                                    </td>

                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <a href="edit-invoice.html" class="edit"><i
                                                                    class="fa-solid fa-pencil me-2"></i>Edit</a>
                                                            <form
                                                                action="{{ route('staff.invoices.destroy', $invoice->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="delete">Delete</button>
                                                            </form>
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
        </div>
        <!-- </div> -->
    </main>

    {{-- View Invoice Modal --}}
    <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" style="height: 100%">

            <div class="modal-content" style="height: 100%">
                <button class="ticket-fill invoice-download"><i class="fa fa-download f-18 me-2"
                        aria-hidden="true"></i>Download</button>
                <div class="modal-body p-0">
                    <iframe width="100%" height="100%" id="preview-frame" src="" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"
        integrity="sha512-qZvrmS2ekKPF2mSznTQsxqPgnpkI4DNTlrdUmTzrDgektczlKNRRhy5X5AAOnx5S09ydFYWWNSfcEqDTTHgtNA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"
        integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.1/jspdf.plugin.autotable.min.js"
        integrity="sha512-8+n4PSpp8TLHbSf28qpjRfu51IuWuJZdemtTC1EKCHsZmWi2O821UEdt6S3l4+cHyUQhU8uiAAUeVI1MUiFATA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/canvg/1.1/canvg.js"
        integrity="sha512-Qw1+j4vl/AjCqxrx/omDzobdEepDHathD3Z0bwulQSrLlaTtTWhiH3sMSDU4oK2TP2EfyzHgg33gh2zxUAI3EQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('js/Poppins-Regular-normal.js') }}"></script>
    <script src="{{ asset('js/Poppins-Bold-normal.js') }}"></script>
    <script>
        const baseUrl = '{{ url('/') }}';
    </script>

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

    {{-- View Invoice --}}
    <script id="pv-items-template" type="text/template">
        <tr class="">
            <td>{sr_num}</td>
            <td scope="row" style="white-space: normal;">
                {description}
            </td>
            <td>${price}</td>
            <td class="text-center">
                {qty}
            </td>
            <td>${total}</td>

        </tr>
    </script>

    <script>
        var pdfData = {};
        $('body').on('click', '.previewBtn', function(e) {
            $('.loading').removeClass('d-none')
            let invoice_id = $(this).data('id')

            $.ajax({
                url: '{{ route('staff.invoices.fetch_invoice', 'invoice_id') }}'.replace(
                    'invoice_id',
                    invoice_id),
                type: 'PATCH',
                data: {
                    '_token': '{{ csrf_token() }}',
                },
                success: function(response) {
                    pdfData = {};
                    if (response.status == 'success') {
                        $('.loading').addClass('d-none')
                        var invoice = response.invoice;
                        var invoice_id = invoice.invoice_id
                        var invoice_from = invoice.invoice_from
                        var invoice_to = invoice.invoice_to
                        var termsNConditions = invoice.terms_n_conditions;
                        var note = invoice.note
                        let total = invoice.items_sum_price

                        // const date = new Date();
                        // const year = date.getFullYear();
                        // const month = date.getMonth() + 1; // Months are 0-indexed
                        // const day = date.getDate().toString().padStart(2, '0');
                        // const monthName = date.toLocaleString('default', {
                        //     month: 'short'
                        // }).toUpperCase(); // Get short month name in uppercase

                        // const formattedDate = `${day} ${monthName} ${year}`;

                        pdfData.invoice_id = invoice_id
                        pdfData.invoice_from = invoice_from
                        pdfData.invoice_to = invoice_to
                        pdfData.termsNConditions = termsNConditions
                        pdfData.note = note
                        pdfData.total = total
                        pdfData.created_at = invoice.created_at
                        pdfData.due_date = invoice.due_date

                        pdfData.items = []

                        // Items
                        $(invoice.items).each(function(index, item) {
                            var description = item.description;
                            var price = item.price;
                            var quantity = item.quantity;

                            var total = price * quantity;

                            pdfData.items.push({
                                description,
                                price,
                                quantity,
                                total
                            })
                        });

                        generatePDF(pdfData)
                        $('#previewModal').modal('show')

                    } else {
                        alert(response.message)
                    }
                }
            })
        })

        $('.invoice-download').click(function() {
            downloadPDF(pdfData.invoice_id)
        })
    </script>
@endsection
@endsection
