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
                                    All Invoices <span class="text-primary">(20)</span>
                                </h1>
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 box-text d-flex align-items-center">
                                        <span class="box-value">$7628</span>
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
                                    Paid Invoices <span class="text-primary">(345)</span>
                                </h1>
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 box-text d-flex align-items-center">
                                        <span class="box-value">$987</span>
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
                                    Unpaid Invoices <span class="text-primary">(43)</span>
                                </h1>
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 box-text d-flex align-items-center">
                                        <span class="box-value">$143</span>
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
                                    Cancelled Invoices <span class="text-primary">(65)</span>
                                </h1>
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 box-text d-flex align-items-center">
                                        <span class="box-value">$873</span>
                                    </div>
                                    <div class="box-icon">
                                        <i class="fa-duotone fa-file-invoice"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12 mb-3">
                            <div class="box" style="overflow: visible !important; z-index: 1 !important">
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
                                                        <line x1="20" y1="8" x2="20" y2="14">
                                                        </line>
                                                        <line x1="23" y1="11" x2="17" y2="11">
                                                        </line>
                                                    </svg>
                                                    Select User
                                                </p>
                                                <span class="down-icon"><i class="fa fa-angle-down"
                                                        aria-hidden="true"></i></span>
                                            </div>
                                            <div class="checkBoxes" style="display: none">
                                                <form action="#">
                                                    <div class="arrow-up"></div>
                                                    <p class="checkbox-title">Customer Search</p>
                                                    <div class="form-custom">
                                                        <input type="text" class="form-control bg-grey"
                                                            placeholder="Enter Customer Name" />
                                                    </div>
                                                    <div class="selectBox-cont">
                                                        <label class="custom_check w-100"><input type="checkbox"
                                                                name="username" /><span class="checkmark"></span>
                                                            Brian Johnson
                                                        </label>
                                                        <label class="custom_check w-100"><input type="checkbox"
                                                                name="username" /><span class="checkmark"></span>
                                                            Russell Copeland</label>
                                                        <label class="custom_check w-100"><input type="checkbox"
                                                                name="username" /><span class="checkmark"></span>
                                                            Greg Lynch</label>
                                                        <label class="custom_check w-100"><input type="checkbox"
                                                                name="username" /><span class="checkmark"></span>
                                                            John Blair</label>
                                                        <label class="custom_check w-100"><input type="checkbox"
                                                                name="username" /><span class="checkmark"></span>
                                                            Barbara Moore</label>
                                                        <label class="custom_check w-100"><input type="checkbox"
                                                                name="username" /><span class="checkmark"></span>
                                                            Hendry Evan</label>
                                                        <label class="custom_check w-100"><input type="checkbox"
                                                                name="username" /><span class="checkmark"></span>
                                                            Richard Miles</label>
                                                    </div>
                                                    <div class="d-flex">
                                                        <button type="submit" class="btn ticket-fill me-1">
                                                            Apply
                                                        </button>
                                                        <button type="reset" class="btn ticket-blank ms-1">
                                                            Reset
                                                        </button>
                                                    </div>
                                                </form>
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
                                                        <rect x="3" y="4" width="18" height="18" rx="2"
                                                            ry="2">
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
                                            <div class="checkBoxes" style="display: none">
                                                <form action="#">
                                                    <div class="arrow-up"></div>
                                                    <p class="checkbox-title">Date Filter</p>
                                                    <div class="selectBox-cont1 selectBox-cont-one h-auto">
                                                        <div class="d-flex flex-wrap">
                                                            <div class="date-picker me-1 flex-grow-1">
                                                                <div class="form-custom cal-icon">
                                                                    <div class="react-datepicker-wrapper">
                                                                        <div class="react-datepicker__input-container ">
                                                                            <span role="alert" aria-live="polite"
                                                                                class="react-datepicker__aria-live"></span><input
                                                                                type="date" class="form-control"
                                                                                value="06/10/2023">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="date-picker ms-1 flex-grow-1">
                                                                <div class="form-custom cal-icon">
                                                                    <div class="react-datepicker-wrapper">
                                                                        <div class="react-datepicker__input-container ">
                                                                            <span role="alert" aria-live="polite"
                                                                                class="react-datepicker__aria-live"></span><input
                                                                                type="date" class="form-control"
                                                                                value="06/10/2023">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="date-list">
                                                            <ul>
                                                                <li><a href="#" class="btn date-btn">Today</a></li>
                                                                <li><a href="#" class="btn date-btn">Yesterday</a>
                                                                </li>
                                                                <li><a href="#" class="btn date-btn">Last 7 days</a>
                                                                </li>
                                                                <li><a href="#" class="btn date-btn">This month</a>
                                                                </li>
                                                                <li><a href="#" class="btn date-btn mb-0">Last
                                                                        month</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </form>
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
                                                <form action="#">
                                                    <div class="arrow-up"></div>
                                                    <p class="checkbox-title">By Status</p>
                                                    <div class="selectBox-cont"><label class="custom_check w-100"><input
                                                                type="checkbox" name="name"><span
                                                                class="checkmark"></span> All
                                                            Invoices</label><label class="custom_check w-100"><input
                                                                type="checkbox" name="name"><span
                                                                class="checkmark"></span> Paid</label><label
                                                            class="custom_check w-100"><input type="checkbox"
                                                                name="name"><span class="checkmark"></span>
                                                            Overdue</label><label class="custom_check w-100"><input
                                                                type="checkbox" name="name"><span
                                                                class="checkmark"></span> Draft</label><label
                                                            class="custom_check w-100"><input type="checkbox"
                                                                name="name"><span class="checkmark"></span>
                                                            Recurring</label><label class="custom_check w-100"><input
                                                                type="checkbox" name="name"><span
                                                                class="checkmark"></span>
                                                            Cancelled</label></div>
                                                    <div class="d-flex">
                                                        <button type="submit"
                                                            class="btn w-100 ticket-fill me-1">Apply</button><button
                                                            type="reset"
                                                            class="btn w-100 ticket-blank ms-1">Reset</button>
                                                    </div>
                                                </form>
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
                                                    By Catrgory
                                                </p>
                                                <span class="down-icon"><i class="fa fa-angle-down"
                                                        aria-hidden="true"></i></span>
                                            </div>
                                            <div class="checkBoxes" style="display: none">
                                                <form action="#">
                                                    <div class="arrow-up"></div>
                                                    <p class="checkbox-title">Category</p>
                                                    <div class="form-custom"><input type="text"
                                                            class="form-control bg-grey"
                                                            placeholder="Enter Category Name"></div>
                                                    <div class="selectBox-cont"><label class="custom_check w-100"><input
                                                                type="checkbox" name="category"><span
                                                                class="checkmark"></span>
                                                            Advertising</label><label class="custom_check w-100"><input
                                                                type="checkbox" name="category"><span
                                                                class="checkmark"></span>
                                                            Food</label><label class="custom_check w-100"><input
                                                                type="checkbox" name="category"><span
                                                                class="checkmark"></span> Marketing</label><label
                                                            class="custom_check w-100"><input type="checkbox"
                                                                name="category"><span class="checkmark"></span>
                                                            Repairs</label><label class="custom_check w-100"><input
                                                                type="checkbox" name="category"><span
                                                                class="checkmark"></span> Software</label><label
                                                            class="custom_check w-100"><input type="checkbox"
                                                                name="category"><span class="checkmark"></span>
                                                            Stationary</label><label class="custom_check w-100"><input
                                                                type="checkbox" name="category"><span
                                                                class="checkmark"></span>
                                                            Travel</label></div>
                                                    <div class="d-flex">
                                                        <button type="submit"
                                                            class="btn w-100 ticket-fill me-1">Apply</button><button
                                                            type="reset"
                                                            class="btn w-100 ticket-blank ms-1">Reset</button>
                                                    </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
                                                <th>View</th>
                                                <th>Edit</th>
                                                <th>Mark as sent</th>
                                                <th>Send Invoice</th>
                                                <th>Clone Invoice</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
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
                                                        <input type="checkbox" class="table-checkbox">#645872
                                                    </div>
                                                </td>
                                                <td class="">Advertising</td>
                                                <td>16 Mar 2022</td>
                                                <td class="bussiness-name">Jhon Alley D.</td>
                                                <td class="bussiness-name">
                                                    $76389
                                                </td>
                                                <td>12/4/2034</td>

                                                <td>
                                                    <div class="invoice-paid">Paid</div>
                                                </td>

                                                <td><a href="invoice-list.html" class="edit"><i
                                                            class="fa-solid fa-eye me-2"></i>View</a>

                                                </td>
                                                <td><a href="edit-invoice.html" class="edit"><i
                                                            class="fa-solid fa-pencil me-2"></i>Edit</a>

                                                </td>

                                                <td><a class="edit"><i class="bi bi-send-check-fill me-2"></i>Mark
                                                        as Sent</a></td>
                                                <td><a class="edit"><i class="bi bi-receipt me-2"></i>Send
                                                        Invoice</a></td>
                                                <td><button class="edit"><i
                                                            class="bi bi-clipboard-plus-fill me-2"></i>Clone
                                                        Invoice</button></td>
                                                <td> <button class="delete ms-0"><i class="fa-solid fa-trash me-2"></i>
                                                        Delete</button></td>
                                            </tr>
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
                                                        <input type="checkbox" class="table-checkbox">#645872
                                                    </div>
                                                </td>
                                                <td class="">Advertising</td>
                                                <td>16 Mar 2022</td>
                                                <td class="bussiness-name">Jhon Alley D.</td>
                                                <td class="bussiness-name">
                                                    $76389
                                                </td>
                                                <td>12/4/2034</td>

                                                <td>
                                                    <div class="invoice-overdue">Overdue</div>
                                                </td>

                                                <td><a href="invoice-list.html" class="edit"><i
                                                            class="fa-solid fa-eye me-2"></i>View</a>

                                                </td>
                                                <td><a href="edit-invoice.html" class="edit"><i
                                                            class="fa-solid fa-pencil me-2"></i>Edit</a>

                                                </td>

                                                <td><a class="edit"><i class="bi bi-send-check-fill me-2"></i>Mark
                                                        as Sent</a></td>
                                                <td><a class="edit"><i class="bi bi-receipt me-2"></i>Send
                                                        Invoice</a></td>
                                                <td><button class="edit"><i
                                                            class="bi bi-clipboard-plus-fill me-2"></i>Clone
                                                        Invoice</button></td>
                                                <td> <button class="delete ms-0"><i class="fa-solid fa-trash me-2"></i>
                                                        Delete</button></td>
                                            </tr>

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
                                                        <input type="checkbox" class="table-checkbox">#645872
                                                    </div>
                                                </td>
                                                <td class="">Advertising</td>
                                                <td>16 Mar 2022</td>
                                                <td class="bussiness-name">Jhon Alley D.</td>
                                                <td class="bussiness-name">
                                                    $76389
                                                </td>
                                                <td>12/4/2034</td>

                                                <td>
                                                    <div class="invoice-cancelled">Cancelled</div>
                                                </td>

                                                <td><a href="invoice-list.html" class="edit"><i
                                                            class="fa-solid fa-eye me-2"></i>View</a>

                                                </td>
                                                <td><a href="edit-invoice.html" class="edit"><i
                                                            class="fa-solid fa-pencil me-2"></i>Edit</a>

                                                </td>

                                                <td><a class="edit"><i class="bi bi-send-check-fill me-2"></i>Mark
                                                        as Sent</a></td>
                                                <td><a class="edit"><i class="bi bi-receipt me-2"></i>Send
                                                        Invoice</a></td>
                                                <td><button class="edit"><i
                                                            class="bi bi-clipboard-plus-fill me-2"></i>Clone
                                                        Invoice</button></td>
                                                <td> <button class="delete ms-0"><i class="fa-solid fa-trash me-2"></i>
                                                        Delete</button></td>
                                            </tr>
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
                                                            <input type="checkbox" class="table-checkbox">#645872
                                                        </div>
                                                    </td>
                                                    <td>16 Mar 2022</td>
                                                    <td class="bussiness-name">Jhon Alley D.</td>
                                                    <td class="bussiness-name">
                                                        $76389
                                                    </td>
                                                    <td>12/4/2034</td>

                                                    <td>
                                                        <div class="invoice-paid">Paid</div>
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
                                                            <input type="checkbox" class="table-checkbox">#645872
                                                        </div>
                                                    </td>
                                                    <td>16 Mar 2022</td>
                                                    <td class="bussiness-name">Jhon Alley D.</td>
                                                    <td class="bussiness-name">
                                                        $76389
                                                    </td>
                                                    <td>12/4/2034</td>

                                                    <td>
                                                        <div class="invoice-paid">Paid</div>
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
                                                            <input type="checkbox" class="table-checkbox">#645872
                                                        </div>
                                                    </td>
                                                    <td>16 Mar 2022</td>
                                                    <td class="bussiness-name">Jhon Alley D.</td>
                                                    <td class="bussiness-name">
                                                        $76389
                                                    </td>
                                                    <td>12/4/2034</td>

                                                    <td>
                                                        <div class="invoice-paid">Paid</div>
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
                                                        <input type="checkbox" class="table-checkbox">#645872
                                                    </div>
                                                </td>
                                                <td>16 Mar 2022</td>
                                                <td class="bussiness-name">Jhon Alley D.</td>
                                                <td class="bussiness-name">
                                                    $76389
                                                </td>
                                                <td>12/4/2034</td>

                                                <td>
                                                    <div class="invoice-overdue">Overdue 7 days</div>
                                                </td>

                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <a href="edit-invoice.html" class="edit"><i
                                                                class="fa-solid fa-pencil me-2"></i>Edit</a>
                                                        <button class="delete ms-3"><i class="fa-solid fa-trash me-2"></i>
                                                            Delete</button>
                                                    </div>

                                                </td>

                                            </tr>
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
                                                        <input type="checkbox" class="table-checkbox">#645872
                                                    </div>
                                                </td>
                                                <td>16 Mar 2022</td>
                                                <td class="bussiness-name">Jhon Alley D.</td>
                                                <td class="bussiness-name">
                                                    $76389
                                                </td>
                                                <td>12/4/2034</td>

                                                <td>
                                                    <div class="invoice-overdue">Overdue 7 days</div>
                                                </td>

                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <a href="edit-invoice.html" class="edit"><i
                                                                class="fa-solid fa-pencil me-2"></i>Edit</a>
                                                        <button class="delete ms-3"><i class="fa-solid fa-trash me-2"></i>
                                                            Delete</button>
                                                    </div>

                                                </td>

                                            </tr>
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
                                                        <input type="checkbox" class="table-checkbox">#645872
                                                    </div>
                                                </td>
                                                <td>16 Mar 2022</td>
                                                <td class="bussiness-name">Jhon Alley D.</td>
                                                <td class="bussiness-name">
                                                    $76389
                                                </td>
                                                <td>12/4/2034</td>

                                                <td>
                                                    <div class="invoice-overdue">Overdue 7 days</div>
                                                </td>

                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <a href="edit-invoice.html" class="edit"><i
                                                                class="fa-solid fa-pencil me-2"></i>Edit</a>
                                                        <button class="delete ms-3"><i class="fa-solid fa-trash me-2"></i>
                                                            Delete</button>
                                                    </div>

                                                </td>

                                            </tr>
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

                                                <th>Actions</th>

                                            </tr>
                                        </thead>
                                        <tbody>
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
                                                        <input type="checkbox" class="table-checkbox">#645872
                                                    </div>
                                                </td>
                                                <td>16 Mar 2022</td>
                                                <td class="bussiness-name">Jhon Alley D.</td>
                                                <td class="bussiness-name">
                                                    $76389
                                                </td>

                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <a href="edit-invoice.html" class="edit"><i
                                                                class="fa-solid fa-pencil me-2"></i>Edit</a>
                                                        <button class="delete ms-3"><i class="fa-solid fa-trash me-2"></i>
                                                            Delete</button>
                                                    </div>

                                                </td>

                                            </tr>
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
                                                        <input type="checkbox" class="table-checkbox">#645872
                                                    </div>
                                                </td>
                                                <td>16 Mar 2022</td>
                                                <td class="bussiness-name">Jhon Alley D.</td>
                                                <td class="bussiness-name">
                                                    $76389
                                                </td>


                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <a href="edit-invoice.html" class="edit"><i
                                                                class="fa-solid fa-pencil me-2"></i>Edit</a>
                                                        <button class="delete ms-3"><i class="fa-solid fa-trash me-2"></i>
                                                            Delete</button>
                                                    </div>

                                                </td>

                                            </tr>
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
                                                        <input type="checkbox" class="table-checkbox">#645872
                                                    </div>
                                                </td>
                                                <td>16 Mar 2022</td>
                                                <td class="bussiness-name">Jhon Alley D.</td>
                                                <td class="bussiness-name">
                                                    $76389
                                                </td>


                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <a href="edit-invoice.html" class="edit"><i
                                                                class="fa-solid fa-pencil me-2"></i>Edit</a>
                                                        <button class="delete ms-3"><i class="fa-solid fa-trash me-2"></i>
                                                            Delete</button>
                                                    </div>

                                                </td>

                                            </tr>
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
                                                <th>Last Invoice</th>
                                                <th>Next Invoice</th>
                                                <th>Frequency</th>
                                                <th>Status</th>

                                            </tr>
                                        </thead>
                                        <tbody>
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
                                                        <input type="checkbox" class="table-checkbox">#645872
                                                    </div>
                                                </td>
                                                <td>16 Mar 2022</td>
                                                <td class="bussiness-name">Jhon Alley D.</td>
                                                <td class="bussiness-name">
                                                    $76389
                                                </td>
                                                <td>12/4/2034</td>
                                                <td>12/4/2034</td>
                                                <td>14 Month</td>
                                                <td>
                                                    <div class="invoice-active">Active</div>
                                                </td>

                                            </tr>
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
                                                        <input type="checkbox" class="table-checkbox">#645872
                                                    </div>
                                                </td>
                                                <td>16 Mar 2022</td>
                                                <td class="bussiness-name">Jhon Alley D.</td>
                                                <td class="bussiness-name">
                                                    $76389
                                                </td>
                                                <td>12/4/2034</td>
                                                <td>12/4/2034</td>
                                                <td>14 Month</td>
                                                <td>
                                                    <div class="invoice-expired">Expired</div>
                                                </td>

                                            </tr>
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
                                                        <input type="checkbox" class="table-checkbox">#645872
                                                    </div>
                                                </td>
                                                <td>16 Mar 2022</td>
                                                <td class="bussiness-name">Jhon Alley D.</td>
                                                <td class="bussiness-name">
                                                    $76389
                                                </td>
                                                <td>12/4/2034</td>
                                                <td>12/4/2034</td>
                                                <td>14 Month</td>
                                                <td>
                                                    <div class="invoice-active">Active</div>
                                                </td>

                                            </tr>
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
                                                <th>Cancelled On</th>
                                                <th>Actions</th>

                                            </tr>
                                        </thead>
                                        <tbody>
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
                                                        <input type="checkbox" class="table-checkbox">#645872
                                                    </div>
                                                </td>
                                                <td>16 Mar 2022</td>
                                                <td class="bussiness-name">Jhon Alley D.</td>
                                                <td class="bussiness-name">
                                                    $76389
                                                </td>
                                                <td>16 Mar 2022</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <a href="edit-invoice.html" class="edit"><i
                                                                class="fa-solid fa-pencil me-2"></i>Edit</a>
                                                        <button class="delete ms-3"><i class="fa-solid fa-trash me-2"></i>
                                                            Delete</button>
                                                    </div>

                                                </td>

                                            </tr>
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
                                                        <input type="checkbox" class="table-checkbox">#645872
                                                    </div>
                                                </td>
                                                <td>16 Mar 2022</td>
                                                <td class="bussiness-name">Jhon Alley D.</td>
                                                <td class="bussiness-name">
                                                    $76389
                                                </td>
                                                <td>16 Mar 2022</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <a href="edit-invoice.html" class="edit"><i
                                                                class="fa-solid fa-pencil me-2"></i>Edit</a>
                                                        <button class="delete ms-3"><i class="fa-solid fa-trash me-2"></i>
                                                            Delete</button>
                                                    </div>

                                                </td>

                                            </tr>
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
                                                        <input type="checkbox" class="table-checkbox">#645872
                                                    </div>
                                                </td>
                                                <td>16 Mar 2022</td>
                                                <td class="bussiness-name">Jhon Alley D.</td>
                                                <td class="bussiness-name">
                                                    $76389
                                                </td>
                                                <td>16 Mar 2022</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <a href="edit-invoice.html" class="edit"><i
                                                                class="fa-solid fa-pencil me-2"></i>Edit</a>
                                                        <button class="delete ms-3"><i class="fa-solid fa-trash me-2"></i>
                                                            Delete</button>
                                                    </div>

                                                </td>

                                            </tr>
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
@endsection
@endsection
