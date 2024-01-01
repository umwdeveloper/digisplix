@extends('layouts.app')

@section('content')

    <main class="content ">
        <div class="container-fluid px-lg-0">
            <div class="row justify-content-center">
                <div class="col-xl-12 ">
                    <div class="row">
                        <div class="col-xl-12  mb-3">
                            <div class="box box-p">
                                <div
                                    class="d-flex align-items-lg-center justify-content-between flex-md-row flex-column align-items-start">
                                    <div>
                                        <h2 class="f-16 w-500 text-primary mb-0 pb-0">
                                            {{ $currentPartner->user->name }}'s Detail
                                        </h2>
                                    </div>

                                    <div class="d-flex align-items-center mt-md-0 mt-3">
                                        <a href="{{ route('staff.partners.index') }}" class="text-gray text-dark-clr"> <i
                                                class="fa-solid fa-circle-left me-2"></i> Back Partners</a>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="box-white">
                                <div class=" tabProjects tab">
                                    <button class="tablinksProjects tablink" data-tab="Leads"
                                        id="defaultOpen2">Leads</button>
                                    <button class="tablinksProjects tablink" data-tab="Commission">Commission</button>

                                </div>

                                <div id="Leads" class="tabcontent-lead">
                                    <div class="row">

                                        <div class="col-xl-4 col-md-6 mb-3">
                                            <div class="box">
                                                <h1 class="box-heading">New Leads</h1>
                                                <div class="d-flex align-items-center">
                                                    <div class=" flex-grow-1  box-text d-flex align-items-center">

                                                        <span class="box-value">{{ $new_leads_count }}</span>

                                                    </div>
                                                    <div class="box-icon">
                                                        <i class="fa-duotone fa-user-group "></i>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-6 mb-3">
                                            <div class="box">
                                                <h1 class="box-heading">Follow Up</h1>
                                                <div class="d-flex align-items-center">
                                                    <div class=" flex-grow-1  box-text d-flex align-items-center">

                                                        <span class="box-value">{{ $follow_up_leads->count() }}</span>

                                                    </div>
                                                    <div class="box-icon">
                                                        <i class="fa-duotone fa-arrows-down-to-people"></i>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-6 mb-3">
                                            <div class="box">
                                                <h1 class="box-heading">Leads In Progress</h1>
                                                <div class="d-flex align-items-center">
                                                    <div class=" flex-grow-1  box-text d-flex align-items-center">
                                                        <span class="box-value">{{ $in_progress_leads->count() }}</span>

                                                    </div>
                                                    <div class="box-icon">
                                                        <i class="fa-duotone fa-bars-progress"></i>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6 mb-3">
                                            <div class="box">
                                                <h1 class="box-heading">Failed Leads</h1>
                                                <div class="d-flex align-items-center">
                                                    <div class=" flex-grow-1  box-text d-flex align-items-center">
                                                        <span class="box-value">{{ $failed_leads->count() }}</span>

                                                    </div>
                                                    <div class="box-icon">
                                                        <i class="fa-duotone fa-diamond-exclamation"></i>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-12 mb-3">
                                            <div class="box">
                                                <h1 class="box-heading">Qualified Leads</h1>
                                                <div class="d-flex align-items-center">
                                                    <div class=" flex-grow-1  box-text d-flex align-items-center">
                                                        <span class="box-value">{{ $qualified_leads->count() }}</span>

                                                    </div>
                                                    <div class="box-icon">
                                                        <i class="fa-duotone fa-trophy-star"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 h-100">
                                            <div class="box mb-3 box-p">
                                                <div class="flex-grow-1">
                                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                                        <h1 class="f-20 w-500 mb-0 pb-0 text-dark-clr">Leads</h1>
                                                    </div>


                                                    <div class="tab2">
                                                        <button class="tablink2 active2" data-tab="Tab1"
                                                            id="defaultOpen">New</button>
                                                        <button class="tablink2" data-tab="Tab2">In-progress</button>
                                                        <button class="tablink2" data-tab="Tab3">Failed</button>
                                                        <button class="tablink2" data-tab="Tab4">Qualified</button>
                                                    </div>

                                                    <div id="Tab1" class="tabcontent-lead2">

                                                        <table id="example" class="table data-table-style ">
                                                            <thead>
                                                                <tr>
                                                                    <th class="no-sort"></th>
                                                                    <th>Client Name</th>
                                                                    <th>Title</th>
                                                                    <th>Bussiness Name</th>
                                                                    <th>Email</th>
                                                                    <th>Status</th>
                                                                    <th>Partner</th>
                                                                    <th>Country</th>
                                                                    <th>Phone Number</th>
                                                                    <th>Joined Date</th>
                                                                    <th>Follow-Up Date</th>
                                                                    <th>URL</th>
                                                                    <th>Address</th>
                                                                    <th>Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($new_leads as $lead)
                                                                    <tr class="">
                                                                        <td>
                                                                            <div class="d-flex align-items-center">
                                                                                <div class="table-arrow">
                                                                                    <!-- <i class="fa-duotone fa-circle-chevron-down"></i> -->
                                                                                </div>
                                                                            </div>
                                                                        </td>

                                                                        <td>{{ $lead->user->name }}</td>
                                                                        <td class="">
                                                                            {{ $lead->title }}
                                                                        </td>
                                                                        <td class="bussiness-name">
                                                                            {{ $lead->business_name }}</td>
                                                                        <td>{{ $lead->user->email }}</td>
                                                                        <td>
                                                                            <div class="dropdown table-dropdown">
                                                                                <a class="btn  dropdown-toggle table-dropdown-btn {{ $lead->status }}"
                                                                                    href="#" role="button"
                                                                                    id="dropdownMenuLink"
                                                                                    data-bs-toggle="dropdown"
                                                                                    aria-expanded="false">
                                                                                    {{ $status_labels[$lead->status] }}
                                                                                </a>

                                                                                <ul class="dropdown-menu"
                                                                                    data-lead-id="{{ $lead->id }}"
                                                                                    aria-labelledby="dropdownMenuLink">
                                                                                    @foreach ($statuses as $status)
                                                                                        <li class="change-status"
                                                                                            data-status="{{ $status }}">
                                                                                            <a class="dropdown-item {{ $status }}"
                                                                                                href="#">{{ $status_labels[$status] }}</a>
                                                                                        </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            </div>
                                                                        </td>
                                                                        <td>{{ $lead->partner->user->name }}</td>

                                                                        <td>
                                                                            {{ $lead->user->country }}
                                                                        </td>

                                                                        <td>
                                                                            {{ $lead->user->phone }}
                                                                        </td>
                                                                        <td>
                                                                            {{ \Carbon\Carbon::parse($lead->joined_at)->format('F j, Y') }}
                                                                        </td>
                                                                        <td>{{ \Carbon\Carbon::parse($lead->followup_date)->format('F j, Y') }}
                                                                        </td>
                                                                        <td>
                                                                            <a
                                                                                href="{{ $lead->url }}">{{ $lead->url }}</a>
                                                                        </td>
                                                                        <td>
                                                                            {{ $lead->user->address }}
                                                                        </td>
                                                                        <td>
                                                                            <div
                                                                                class="table-actions d-flex align-items-center">
                                                                                <button class="edit"
                                                                                    data-lead-id="{{ $lead->id }}">Edit</button>
                                                                                <form
                                                                                    action="{{ route('staff.leads.destroy', $lead->id) }}"
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

                                                    <div id="Tab2" class="tabcontent-lead2" style="display: none">
                                                        <div id="In-Progress">
                                                            <table id="example-inprogress"
                                                                class="table data-table-style ">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="no-sort"></th>
                                                                        <th>Client Name</th>
                                                                        <th>Title</th>
                                                                        <th>Bussiness Name</th>
                                                                        <th>Email</th>
                                                                        <th>Status</th>
                                                                        <th>Partner</th>
                                                                        <th>Country</th>
                                                                        <th>Phone Number</th>
                                                                        <th>Date</th>
                                                                        <th>Follow-Up Date</th>
                                                                        <th>URL</th>
                                                                        <th>Address</th>
                                                                        <th>Actions</th>


                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($in_progress_leads as $lead)
                                                                        <tr class="">
                                                                            <td>
                                                                                <div class="d-flex align-items-center">
                                                                                    <div class="table-arrow">
                                                                                        <!-- <i class="fa-duotone fa-circle-chevron-down"></i> -->
                                                                                    </div>
                                                                                </div>
                                                                            </td>

                                                                            <td>{{ $lead->user->name }}</td>
                                                                            <td class="">
                                                                                {{ $lead->title }}
                                                                            </td>
                                                                            <td class="bussiness-name">
                                                                                {{ $lead->business_name }}
                                                                            </td>
                                                                            <td>{{ $lead->user->email }}</td>
                                                                            <td>
                                                                                <div class="dropdown table-dropdown">
                                                                                    <a class="btn  dropdown-toggle table-dropdown-btn {{ $lead->status }}"
                                                                                        href="#" role="button"
                                                                                        id="dropdownMenuLink"
                                                                                        data-bs-toggle="dropdown"
                                                                                        aria-expanded="false">
                                                                                        {{ $status_labels[$lead->status] }}
                                                                                    </a>

                                                                                    <ul class="dropdown-menu"
                                                                                        data-lead-id="{{ $lead->id }}"
                                                                                        aria-labelledby="dropdownMenuLink">
                                                                                        @foreach ($statuses as $status)
                                                                                            <li class="change-status"
                                                                                                data-status="{{ $status }}">
                                                                                                <a class="dropdown-item {{ $status }}"
                                                                                                    href="#">{{ $status_labels[$status] }}</a>
                                                                                            </li>
                                                                                        @endforeach
                                                                                    </ul>
                                                                                </div>
                                                                            </td>
                                                                            <td>{{ $lead->partner->user->name }}</td>

                                                                            <td>
                                                                                {{ $lead->user->country }}
                                                                            </td>

                                                                            <td>
                                                                                {{ $lead->user->phone }}
                                                                            </td>
                                                                            <td>
                                                                                {{ \Carbon\Carbon::parse($lead->joined_at)->format('F j, Y') }}
                                                                            </td>
                                                                            <td>{{ \Carbon\Carbon::parse($lead->followup_date)->format('F j, Y') }}
                                                                            </td>
                                                                            <td>
                                                                                <a
                                                                                    href="{{ $lead->url }}">{{ $lead->url }}</a>
                                                                            </td>
                                                                            <td>
                                                                                {{ $lead->user->address }}
                                                                            </td>
                                                                            <td>
                                                                                <div
                                                                                    class="table-actions d-flex align-items-center">
                                                                                    <button class="edit"
                                                                                        data-lead-id="{{ $lead->id }}">Edit</button>
                                                                                    <form
                                                                                        action="{{ route('staff.leads.destroy', $lead->id) }}"
                                                                                        method="POST">
                                                                                        @csrf
                                                                                        @method('DELETE')
                                                                                        <button
                                                                                            class="delete">Delete</button>
                                                                                    </form>
                                                                                </div>


                                                                            </td>
                                                                        </tr>
                                                                    @endforeach

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                    <div id="Tab3" class="tabcontent-lead2" style="display: none">

                                                        <table id="example-failed" class="table data-table-style ">
                                                            <thead>
                                                                <tr>
                                                                    <th class="no-sort"></th>
                                                                    <th>Client Name</th>
                                                                    <th>Title</th>
                                                                    <th>Bussiness Name</th>
                                                                    <th>Email</th>
                                                                    <th>Status</th>
                                                                    <th>Partner</th>
                                                                    <th>Country</th>
                                                                    <th>Phone Number</th>
                                                                    <th>Date</th>
                                                                    <th>Follow-Up Date</th>
                                                                    <th>URL</th>
                                                                    <th>Address</th>
                                                                    <th>Actions</th>


                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($failed_leads as $lead)
                                                                    <tr class="">
                                                                        <td>
                                                                            <div class="d-flex align-items-center">
                                                                                <div class="table-arrow">
                                                                                    <!-- <i class="fa-duotone fa-circle-chevron-down"></i> -->
                                                                                </div>
                                                                            </div>
                                                                        </td>

                                                                        <td>{{ $lead->user->name }}</td>
                                                                        <td class="">
                                                                            {{ $lead->title }}
                                                                        </td>
                                                                        <td class="bussiness-name">
                                                                            {{ $lead->business_name }}</td>
                                                                        <td>{{ $lead->user->email }}</td>
                                                                        <td>
                                                                            <div class="dropdown table-dropdown">
                                                                                <a class="btn  dropdown-toggle table-dropdown-btn {{ $lead->status }}"
                                                                                    href="#" role="button"
                                                                                    id="dropdownMenuLink"
                                                                                    data-bs-toggle="dropdown"
                                                                                    aria-expanded="false">
                                                                                    {{ $status_labels[$lead->status] }}
                                                                                </a>

                                                                                <ul class="dropdown-menu"
                                                                                    data-lead-id="{{ $lead->id }}"
                                                                                    aria-labelledby="dropdownMenuLink">
                                                                                    @foreach ($statuses as $status)
                                                                                        <li class="change-status"
                                                                                            data-status="{{ $status }}">
                                                                                            <a class="dropdown-item {{ $status }}"
                                                                                                href="#">{{ $status_labels[$status] }}</a>
                                                                                        </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            </div>
                                                                        </td>
                                                                        <td>{{ $lead->partner->user->name }}</td>

                                                                        <td>
                                                                            {{ $lead->user->country }}
                                                                        </td>

                                                                        <td>
                                                                            {{ $lead->user->phone }}
                                                                        </td>
                                                                        <td>
                                                                            {{ \Carbon\Carbon::parse($lead->joined_at)->format('F j, Y') }}
                                                                        </td>
                                                                        <td>{{ \Carbon\Carbon::parse($lead->followup_date)->format('F j, Y') }}
                                                                        </td>
                                                                        <td>
                                                                            <a
                                                                                href="{{ $lead->url }}">{{ $lead->url }}</a>
                                                                        </td>
                                                                        <td>
                                                                            {{ $lead->user->address }}
                                                                        </td>
                                                                        <td>
                                                                            <div
                                                                                class="table-actions d-flex align-items-center">
                                                                                <button class="edit"
                                                                                    data-lead-id="{{ $lead->id }}">Edit</button>
                                                                                <form
                                                                                    action="{{ route('staff.leads.destroy', $lead->id) }}"
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

                                                    <div id="Tab4" class="tabcontent-lead2" style="display: none">
                                                        <table id="example-qualify" class="table data-table-style ">
                                                            <thead>
                                                                <tr>
                                                                    <th class="no-sort"></th>
                                                                    <th>Client Name</th>
                                                                    <th>Title</th>
                                                                    <th>Bussiness Name</th>
                                                                    <th>Email</th>
                                                                    <th>Status</th>
                                                                    <th>Partner</th>
                                                                    <th>Country</th>
                                                                    <th>Phone Number</th>
                                                                    <th>Date</th>
                                                                    <th>Follow-Up Date</th>
                                                                    <th>URL</th>
                                                                    <th>Address</th>
                                                                    <th>Actions</th>


                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($qualified_leads as $lead)
                                                                    <tr class="">
                                                                        <td>
                                                                            <div class="d-flex align-items-center">
                                                                                <div class="table-arrow">
                                                                                    <!-- <i class="fa-duotone fa-circle-chevron-down"></i> -->
                                                                                </div>
                                                                            </div>
                                                                        </td>

                                                                        <td>{{ $lead->user->name }}</td>
                                                                        <td class="">
                                                                            {{ $lead->title }}
                                                                        </td>
                                                                        <td class="bussiness-name">
                                                                            {{ $lead->business_name }}</td>
                                                                        <td>{{ $lead->user->email }}</td>
                                                                        <td>
                                                                            <div class="dropdown table-dropdown">
                                                                                <a class="btn  dropdown-toggle table-dropdown-btn {{ $lead->status }}"
                                                                                    href="#" role="button"
                                                                                    id="dropdownMenuLink"
                                                                                    data-bs-toggle="dropdown"
                                                                                    aria-expanded="false">
                                                                                    {{ $status_labels[$lead->status] }}
                                                                                </a>

                                                                                <ul class="dropdown-menu"
                                                                                    data-lead-id="{{ $lead->id }}"
                                                                                    aria-labelledby="dropdownMenuLink">
                                                                                    @foreach ($statuses as $status)
                                                                                        <li class="change-status"
                                                                                            data-status="{{ $status }}">
                                                                                            <a class="dropdown-item {{ $status }}"
                                                                                                href="#">{{ $status_labels[$status] }}</a>
                                                                                        </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            </div>
                                                                        </td>
                                                                        <td>{{ $lead->partner->user->name }}</td>

                                                                        <td>
                                                                            {{ $lead->user->country }}
                                                                        </td>

                                                                        <td>
                                                                            {{ $lead->user->phone }}
                                                                        </td>
                                                                        <td>
                                                                            {{ \Carbon\Carbon::parse($lead->joined_at)->format('F j, Y') }}
                                                                        </td>
                                                                        <td>{{ \Carbon\Carbon::parse($lead->followup_date)->format('F j, Y') }}
                                                                        </td>
                                                                        <td>
                                                                            <a
                                                                                href="{{ $lead->url }}">{{ $lead->url }}</a>
                                                                        </td>
                                                                        <td>
                                                                            {{ $lead->user->address }}
                                                                        </td>
                                                                        <td>
                                                                            <div
                                                                                class="table-actions d-flex align-items-center">
                                                                                <button class="edit"
                                                                                    data-lead-id="{{ $lead->id }}">Edit</button>
                                                                                <form
                                                                                    action="{{ route('staff.leads.destroy', $lead->id) }}"
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

                                <div id="Commission" class="tabcontent-lead">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-12">
                                            <div class="row">
                                                <div class="col-xl-4 col-md-4 mb-3">
                                                    <div class="box">
                                                        <div class="d-flex justify-content-between align-items-start">
                                                            <h1 class="box-heading">Total Sales</h1>
                                                            <select class="form-select select-duration mb-1 filter"
                                                                aria-label="Default select example" data-filter="sales">
                                                                <option selected value="weekly">Weekly</option>
                                                                <option value="monthly">Monthly</option>
                                                                <option value="months_6">6 Months</option>
                                                                <option value="yearly">Yearly</option>
                                                                <option value="lifetime">Lifetime</option>
                                                            </select>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <div class=" flex-grow-1  box-text d-flex align-items-center">

                                                                <span class="box-value"
                                                                    id="sales">{{ $sales }}</span>

                                                            </div>
                                                            <div class="box-icon">
                                                                <i class="fa-solid fa-chart-mixed-up-circle-currency"></i>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-4 mb-3">
                                                    <div class="box">
                                                        <div class="d-flex justify-content-between align-items-start">
                                                            <h1 class="box-heading">Total Revenue</h1>
                                                            <select class="form-select select-duration mb-1 filter"
                                                                aria-label="Default select example" data-filter="revenue">
                                                                <option selected value="weekly">Weekly</option>
                                                                <option value="monthly">Monthly</option>
                                                                <option value="months_6">6 Months</option>
                                                                <option value="yearly">Yearly</option>
                                                                <option value="lifetime">Lifetime</option>
                                                            </select>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <div class=" flex-grow-1  box-text d-flex align-items-center">

                                                                <span class="box-value">$<span
                                                                        id="revenue">{{ round($revenue) }}</span></span>

                                                            </div>
                                                            <div class="box-icon">
                                                                <i class="fa-solid fa-chart-line-up"></i>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-4 mb-3">
                                                    <div class="box">
                                                        <div class="d-flex justify-content-between align-items-start">
                                                            <h1 class="box-heading">Commission Earned</h1>
                                                            <select class="form-select select-duration mb-1 filter"
                                                                aria-label="Default select example"
                                                                data-filter="commission">
                                                                <option selected value="weekly">Weekly</option>
                                                                <option value="monthly">Monthly</option>
                                                                <option value="months_6">6 Months</option>
                                                                <option value="yearly">Yearly</option>
                                                                <option value="lifetime">Lifetime</option>
                                                            </select>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <div class=" flex-grow-1  box-text d-flex align-items-center">

                                                                <span class="box-value">$<span
                                                                        id="commission">{{ round($commission) }}</span></span>

                                                            </div>
                                                            <div class="box-icon">
                                                                <i class="fa-duotone fa-money-bill-trend-up"></i>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 h-100">
                                                    <div class="box mb-3   ">
                                                        <div class="flex-grow-1">
                                                            <h1 class="f-20 w-500 mb-3 text-dark-clr">Commission by Project
                                                            </h1>
                                                            <div class="table-responsive-div">
                                                                <table id="upcoming-table"
                                                                    class="table data-table-style  ">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="no-sort"></th>
                                                                            <th scope="col">#</th>
                                                                            <th scope="col">Client Name</th>
                                                                            <th scope="col">Bussiness Name</th>
                                                                            <th scope="col">Project Name</th>
                                                                            <th scope="col">Deal Size</th>
                                                                            <th scope="col">Commission</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($invoices as $key => $invoice)
                                                                            <tr class="">
                                                                                <td>
                                                                                    <div class="d-flex align-items-center">
                                                                                        <div class="table-arrow">
                                                                                            <!-- <i class="fa-duotone fa-circle-chevron-down"></i> -->
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>{{ ++$key }}</td>
                                                                                <td>{{ $invoice->client->user->name }}</td>
                                                                                <td>{{ $invoice->client->business_name }}
                                                                                </td>
                                                                                <td class="">
                                                                                    <p title="Ecommerece Website lorem abscd"
                                                                                        class="project-name mb-0 pb-0">
                                                                                        {{ $invoice->category->name }}</p>
                                                                                </td>
                                                                                <td>${{ round($invoice->items_sum_price) }}
                                                                                </td>
                                                                                <td>${{ round($invoice->items_sum_price * ($invoice->client->partner->commission / 100)) }}
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
                                    <div class="row justify-content-center mt-lg-0 mt-2">
                                        <div class="col-md-7 mb-3">
                                            <div class="box h-100 ">
                                                <h1 class="f-20 w-500 mb-3 border-bottom pb-3 text-dark-clr">Regional Sales
                                                </h1>
                                                <div class="d-flex justify-content-center">
                                                    <canvas id="regional-sales"></canvas>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-5 mb-3">
                                            <div class="box h-100 d-flex flex-column">
                                                <h1 class="f-20 w-500 mb-3 border-bottom pb-3 text-dark-clr">Sales by
                                                    Customer Location</h1>
                                                <div class="flex-grow-1  my-auto d-flex align-items-center">
                                                    <div id="customer_location"></div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="row mb-3 mt-3">
                <div class="col-lg-12">
                    <div class="box">
                        <p class="f-14 w-500 mb-0 pb-0 text-center text-gray text-dark-clr" id="copyright-year"></p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="leadModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-medium">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Commission</h5>
                    <button type="button" class=" close-btn text-white" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fa-duotone fa-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control crm-input" id="name"
                                            placeholder="Mickel">
                                        <label class="crm-label form-label" for="name">Client Name<span
                                                class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control crm-input" id="bussiness-name"
                                            placeholder="Mickel">
                                        <label class="crm-label form-label" for="bussiness-name">Bussiness Name<span
                                                class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control crm-input" id="project"
                                            placeholder="ABC">
                                        <label class="crm-label form-label" for="project">Project name<span
                                                class="text-danger">*</span></label>
                                    </div>
                                </div>

                                <!-- <div class="col-lg-6">
                                                                                                                        <div class="form-floating mb-3">
                                                                                                                            <input type="email" class="form-control crm-input" id="email" placeholder="ABC">
                                                                                                                            <label class="crm-label form-label" for="email">Email Address<span
                                                                                                                                    class="text-danger">*</span></label>
                                                                                                                        </div>
                                                                                                                    </div> -->
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="date" class="form-control crm-input" id="date"
                                            placeholder="ABC">
                                        <label class="crm-label form-label" for="date">Deal Close Date<span
                                                class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control crm-input" id="size"
                                            placeholder="ABC">
                                        <label class="crm-label form-label" for="size">Deal Size<span
                                                class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control crm-input" id="comission"
                                            placeholder="ABC">
                                        <label class="crm-label form-label" for="comission">Commission<span
                                                class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-lg-6">

                                    <div class="form-floating">
                                        <select class="form-select crm-input" id="select-status"
                                            aria-label="Floating label select example">
                                            <option>Select</option>
                                            <option value="1" style="color: #06F7F0; ">New Lead
                                            </option>
                                            <option value="2" style="color: #063AF6; ">
                                                Contracted</option>
                                            <option value="3" style="color: #E400F7; ">Follow-Up
                                            </option>
                                            <option value="4" style="color: #F75C06; ">
                                                In-Progress</option>
                                            <option value="5" style="color: #F70606; ">Failed
                                            </option>
                                            <option value="6" style="color: #06F744; ">Qualified
                                            </option>
                                        </select>
                                        <label class="crm-label form-label" for="select-status">Status<span
                                                class="text-danger">*</span></label>
                                    </div>

                                </div>

                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-lg-end justify-content-center mt-3 mb-3">
                                        <button type="button" class="modal-btn-cancel me-3"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="button" class="modal-btn-save ">Save </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const selectStatus = document.getElementById("select-status");

            selectStatus.addEventListener("change", function() {
                // Get the selected option
                const selectedOption = selectStatus.options[selectStatus.selectedIndex];

                // Get the styles from the selected option
                const backgroundColor = selectedOption.style.backgroundColor;
                const color = selectedOption.style.color;

                // Apply the styles to the select element
                selectStatus.style.backgroundColor = backgroundColor;
                selectStatus.style.color = color;
            });
        });
    </script>

    <!-- table tabs -->
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
                console.log(tabName);
                $("#" + tabName).show();

                // Add the "active" class to the clicked tab button
                $(this).addClass("active");
            });

            // Trigger the default tab to open
            $("#defaultOpen2").click();
        });
    </script>

    <!--main tabs -->
    <script>
        $(document).ready(function() {
            // Click event for tab buttons
            $(".tablink2").click(function() {
                var tabName2 = $(this).data("tab");

                // Remove the "active" class from all tab buttons
                $(".tablink2").removeClass("active2");

                // Hide all tab content
                $(".tabcontent-lead2").hide();

                // Show the selected tab content
                console.log(tabName2);
                $("#" + tabName2).show();

                // Add the "active" class to the clicked tab button
                $(this).addClass("active2");
            });

            // Trigger the default tab to open
            $("#defaultOpen3").click();
        });
    </script>

    <script>
        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }
    </script>

    <script>
        var regionalSalesData = @json($regional_sales);

        var bubbleSeriesData = [
            @foreach ($regional_sales as $region)
                {
                    id: "{{ $region->region_code }}",
                    name: "{{ $region->region }}",
                    value: {{ $region->sales_count }},
                    circleTemplate: {
                        fill: getRandomColor()
                    }, // Assuming you have a getRandomColor() function
                },
            @endforeach
        ];

        console.log(bubbleSeriesData);
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <script src="{{ asset('js/charts.js') }}"></script>

    <script>
        $('.filter').change(function() {
            var duration = $(this).val();
            var filter = $(this).data('filter');

            // Make an AJAX request to fetch data based on the selected duration
            $.ajax({
                url: '{{ route('staff.partners.total_sales') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    duration,
                    filter,
                    'partner_id': '{{ $currentPartner->id }}'
                },
                success: function(data) {
                    $('#' + filter).text(data.total);
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        });
    </script>

    <script>
        $('body').on('click', '.change-status', function() {
            let status = $(this).data('status');
            let leadID = $(this).closest('ul').data('lead-id');

            $.ajax({
                url: '{{ route('staff.leads.update_lead_status', 'lead_id') }}'.replace('lead_id',
                    leadID),
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
@endsection
@endsection
