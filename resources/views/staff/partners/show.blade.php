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
                                                        <button class="tablink2" data-tab="Tab1"
                                                            id="defaultOpen3">New</button>
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
                                                                    <th>Status</th>
                                                                    <th>Designation</th>
                                                                    <th>Bussiness Name</th>
                                                                    <th>Email</th>
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
                                                                        <td>
                                                                            <div class="dropdown table-dropdown">
                                                                                <a class="btn table-dropdown-btn {{ $lead->status }}"
                                                                                    href="#" role="button"
                                                                                    id="dropdownMenuLink"
                                                                                    data-bs-toggle="dropdown"
                                                                                    aria-expanded="false">
                                                                                    {{ $status_labels[$lead->status] }}
                                                                                </a>
                                                                            </div>
                                                                        </td>
                                                                        <td class="">
                                                                            {{ $lead->user->designation }}
                                                                        </td>
                                                                        <td class="bussiness-name">
                                                                            {{ $lead->business_name }}</td>
                                                                        <td>{{ $lead->user->email }}</td>

                                                                        <td>{{ $lead->partner->user->name }}</td>

                                                                        <td>
                                                                            {{ $lead->user->country }}
                                                                        </td>

                                                                        <td>
                                                                            {{ $lead->user->phone }}
                                                                        </td>
                                                                        <td>
                                                                            {{ !empty($lead->joined_at) ? \Carbon\Carbon::parse($lead->joined_at)->format('F j, Y') : 'None' }}
                                                                        </td>
                                                                        <td>{{ !empty($lead->followup_date) ? \Carbon\Carbon::parse($lead->followup_date)->format('F j, Y') : 'None' }}
                                                                        </td>
                                                                        <td>
                                                                            @if (!empty($lead->url))
                                                                                <a
                                                                                    href="{{ $lead->url }}">{{ $lead->url }}</a>
                                                                            @else
                                                                                None
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            {{ $lead->user->address ?? 'None' }}
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

                                                    <div id="Tab2" class="tabcontent-lead2">
                                                        <div id="In-Progress">
                                                            <table id="example-inprogress"
                                                                class="table data-table-style ">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="no-sort"></th>
                                                                        <th>Client Name</th>
                                                                        <th>Status</th>
                                                                        <th>Designation</th>
                                                                        <th>Bussiness Name</th>
                                                                        <th>Email</th>
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
                                                                            <td>
                                                                                <div class="dropdown table-dropdown">
                                                                                    <a class="btn table-dropdown-btn {{ $lead->status }}"
                                                                                        href="#" role="button"
                                                                                        id="dropdownMenuLink"
                                                                                        data-bs-toggle="dropdown"
                                                                                        aria-expanded="false">
                                                                                        {{ $status_labels[$lead->status] }}
                                                                                    </a>
                                                                                </div>
                                                                            </td>
                                                                            <td class="">
                                                                                {{ $lead->user->designation }}
                                                                            </td>
                                                                            <td class="bussiness-name">
                                                                                {{ $lead->business_name }}
                                                                            </td>
                                                                            <td>{{ $lead->user->email }}</td>

                                                                            <td>{{ $lead->partner->user->name }}</td>

                                                                            <td>
                                                                                {{ $lead->user->country }}
                                                                            </td>

                                                                            <td>
                                                                                {{ $lead->user->phone }}
                                                                            </td>
                                                                            <td>
                                                                                {{ !empty($lead->joined_at) ? \Carbon\Carbon::parse($lead->joined_at)->format('F j, Y') : 'None' }}
                                                                            </td>
                                                                            <td>{{ !empty($lead->followup_date) ? \Carbon\Carbon::parse($lead->followup_date)->format('F j, Y') : 'None' }}
                                                                            </td>
                                                                            <td>
                                                                                @if (!empty($lead->url))
                                                                                    <a
                                                                                        href="{{ $lead->url }}">{{ $lead->url }}</a>
                                                                                @else
                                                                                    None
                                                                                @endif
                                                                            </td>
                                                                            <td>
                                                                                {{ $lead->user->address ?? 'None' }}
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

                                                    <div id="Tab3" class="tabcontent-lead2">

                                                        <table id="example-failed" class="table data-table-style ">
                                                            <thead>
                                                                <tr>
                                                                    <th class="no-sort"></th>
                                                                    <th>Client Name</th>
                                                                    <th>Status</th>
                                                                    <th>Designation</th>
                                                                    <th>Bussiness Name</th>
                                                                    <th>Email</th>
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
                                                                        <td>
                                                                            <div class="dropdown table-dropdown">
                                                                                <a class="btn table-dropdown-btn {{ $lead->status }}"
                                                                                    href="#" role="button"
                                                                                    id="dropdownMenuLink"
                                                                                    data-bs-toggle="dropdown"
                                                                                    aria-expanded="false">
                                                                                    {{ $status_labels[$lead->status] }}
                                                                                </a>
                                                                            </div>
                                                                        </td>
                                                                        <td class="">
                                                                            {{ $lead->user->designation }}
                                                                        </td>
                                                                        <td class="bussiness-name">
                                                                            {{ $lead->business_name }}</td>
                                                                        <td>{{ $lead->user->email }}</td>

                                                                        <td>{{ $lead->partner->user->name }}</td>

                                                                        <td>
                                                                            {{ $lead->user->country }}
                                                                        </td>

                                                                        <td>
                                                                            {{ $lead->user->phone }}
                                                                        </td>
                                                                        <td>
                                                                            {{ !empty($lead->joined_at) ? \Carbon\Carbon::parse($lead->joined_at)->format('F j, Y') : 'None' }}
                                                                        </td>
                                                                        <td>{{ !empty($lead->followup_date) ? \Carbon\Carbon::parse($lead->followup_date)->format('F j, Y') : 'None' }}
                                                                        </td>
                                                                        <td>
                                                                            @if (!empty($lead->url))
                                                                                <a
                                                                                    href="{{ $lead->url }}">{{ $lead->url }}</a>
                                                                            @else
                                                                                None
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            {{ $lead->user->address ?? 'None' }}
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

                                                    <div id="Tab4" class="tabcontent-lead2">
                                                        <table id="example-qualify" class="table data-table-style ">
                                                            <thead>
                                                                <tr>
                                                                    <th class="no-sort"></th>
                                                                    <th>Client Name</th>
                                                                    <th>Status</th>
                                                                    <th>Designation</th>
                                                                    <th>Bussiness Name</th>
                                                                    <th>Email</th>
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
                                                                        <td>
                                                                            <div class="dropdown table-dropdown">
                                                                                <a class="btn table-dropdown-btn {{ $lead->status }}"
                                                                                    href="#" role="button"
                                                                                    id="dropdownMenuLink"
                                                                                    data-bs-toggle="dropdown"
                                                                                    aria-expanded="false">
                                                                                    {{ $status_labels[$lead->status] }}
                                                                                </a>
                                                                            </div>
                                                                        </td>
                                                                        <td class="">
                                                                            {{ $lead->user->designation }}
                                                                        </td>
                                                                        <td class="bussiness-name">
                                                                            {{ $lead->business_name }}</td>
                                                                        <td>{{ $lead->user->email }}</td>

                                                                        <td>{{ $lead->partner->user->name }}</td>

                                                                        <td>
                                                                            {{ $lead->user->country }}
                                                                        </td>

                                                                        <td>
                                                                            {{ $lead->user->phone }}
                                                                        </td>
                                                                        <td>
                                                                            {{ !empty($lead->joined_at) ? \Carbon\Carbon::parse($lead->joined_at)->format('F j, Y') : 'None' }}
                                                                        </td>
                                                                        <td>{{ !empty($lead->followup_date) ? \Carbon\Carbon::parse($lead->followup_date)->format('F j, Y') : 'None' }}
                                                                        </td>
                                                                        <td>
                                                                            @if ($lead->url)
                                                                                <a
                                                                                    href="{{ $lead->url }}">{{ $lead->url }}</a>
                                                                            @else
                                                                                None
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            {{ $lead->user->address ?? 'None' }}
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
                                                            <select class="form-select select-duration mb-1 filter-revenue"
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
                                                            <select
                                                                class="form-select select-duration mb-1 filter-commission"
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
                                                            <div
                                                                class="d-flex align-items-center justify-content-between mb-3">
                                                                <h1 class="f-20 w-500 mb-0 pb-0 text-dark-clr">Commission
                                                                    by Project</h1>
                                                                <button class="table-btn" id="leadModal-btn"
                                                                    type="button" data-bs-toggle="modal"
                                                                    data-bs-target="#leadModal">Add
                                                                    New</button>
                                                                <button class="table-btn d-none"
                                                                    id="updateCommissionModal-btn" type="button"
                                                                    class="btn btn-primary" data-bs-toggle="modal"
                                                                    data-bs-target="#updateCommissionModal">Edit
                                                                    Lead</button>
                                                            </div>
                                                            <div class="table-responsive-div">
                                                                <table id="upcoming-table"
                                                                    class="table data-table-style  ">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="no-sort"></th>
                                                                            <th scope="col">#</th>
                                                                            <th scope="col">Client Name</th>
                                                                            <th scope="col">Status</th>
                                                                            <th scope="col">Bussiness Name</th>
                                                                            <th scope="col">Project Name</th>
                                                                            <th scope="col">Deal Size</th>
                                                                            <th scope="col">Commission</th>
                                                                            <th scope="col">Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($commissions as $key => $commission)
                                                                            <tr class="">
                                                                                <td>
                                                                                    <div class="d-flex align-items-center">
                                                                                        <div class="table-arrow">
                                                                                            <!-- <i class="fa-duotone fa-circle-chevron-down"></i> -->
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>{{ ++$key }}</td>
                                                                                <td>{{ $commission->client->user->name }}
                                                                                </td>
                                                                                <td>
                                                                                    <div class="dropdown table-dropdown">
                                                                                        <a style="background-color: {{ $commission_status_colors[$commission->status] }}"
                                                                                            class="btn  dropdown-toggle table-dropdown-btn ticket-paid"
                                                                                            href="#" role="button"
                                                                                            id="dropdownMenuLink"
                                                                                            data-bs-toggle="dropdown"
                                                                                            aria-expanded="false"
                                                                                            data-commission-id="{{ $commission->id }}">
                                                                                            {{ $commission_status_labels[$commission->status] }}
                                                                                        </a>

                                                                                        <ul class="dropdown-menu"
                                                                                            data-commission-id="{{ $commission->id }}"
                                                                                            aria-labelledby="dropdownMenuLink">
                                                                                            @foreach ($commission_statuses as $status)
                                                                                                <li class="change-commission-status"
                                                                                                    data-status="{{ $status }}"
                                                                                                    data-label="{{ $commission_status_labels[$status] }}"
                                                                                                    data-color="{{ $commission_status_colors[$status] }}">
                                                                                                    <a class="dropdown-item"
                                                                                                        style="background-color: {{ $commission_status_colors[$status] }}"
                                                                                                        href="#">{{ $commission_status_labels[$status] }}</a>
                                                                                                </li>
                                                                                            @endforeach

                                                                                        </ul>
                                                                                    </div>
                                                                                </td>
                                                                                <td>{{ $commission->client->business_name }}
                                                                                </td>
                                                                                <td class="">
                                                                                    <p class="project-name mb-0 pb-0">
                                                                                        {{ $commission->project->name }}
                                                                                    </p>
                                                                                </td>
                                                                                <td>${{ round($commission->deal_size) }}
                                                                                </td>
                                                                                <td>${{ round($commission->deal_size * ($commission->commission / 100)) }}
                                                                                </td>
                                                                                <td>
                                                                                    <div
                                                                                        class="table-actions d-flex align-items-center">
                                                                                        <button class="edit"
                                                                                            data-commission-id="{{ $commission->id }}">Edit</button>
                                                                                        <form
                                                                                            action="{{ route('staff.commissions.destroy', $commission->id) }}"
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
                    <form action="{{ route('staff.commissions.store') }}" method="POST">
                        @csrf
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-floating">
                                        <select name="client_id" required
                                            class="form-select crm-input {{ $errors->createCommission->has('client_id') ? 'is-invalid' : '' }}"
                                            aria-label="Floating label select example">
                                            <option selected>Select</option>
                                            @foreach ($clients as $client)
                                                <option value="{{ $client->id }}">{{ $client->user->name }}</option>
                                            @endforeach
                                        </select>
                                        <label class="crm-label form-label" for="select-status">Client<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->createCommission->has('client_id'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->createCommission->first('client_id') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating">
                                        <select name="project_id" required
                                            class="form-select crm-input {{ $errors->createCommission->has('project_id') ? 'is-invalid' : '' }}"
                                            aria-label="Floating label select example">
                                            <option selected>Select</option>
                                            @foreach ($projects as $project)
                                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                                            @endforeach
                                        </select>
                                        <label class="crm-label form-label" for="select-status">Project<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->createCommission->has('project_id'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->createCommission->first('project_id') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="date" name="deal_date" required
                                            class="form-control crm-input {{ $errors->createCommission->has('deal_date') ? 'is-invalid' : '' }}"
                                            id="date" placeholder="ABC">
                                        <label class="crm-label form-label" for="date">Deal Close Date<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->createCommission->has('deal_date'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->createCommission->first('deal_date') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="deal_size" required
                                            class="form-control crm-input {{ $errors->createCommission->has('deal_size') ? 'is-invalid' : '' }}"
                                            id="size" placeholder="ABC">
                                        <label class="crm-label form-label" for="size">Deal Size<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->createCommission->has('deal_size'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->createCommission->first('deal_size') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="commission" required
                                            class="form-control crm-input {{ $errors->createCommission->has('commission') ? 'is-invalid' : '' }}"
                                            id="comission" placeholder="ABC">
                                        <label class="crm-label form-label" for="comission">Commission<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->createCommission->has('commission'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->createCommission->first('commission') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-floating">
                                        <select name="status" required id="select-status"
                                            class="form-select crm-input {{ $errors->createCommission->has('status') ? 'is-invalid' : '' }}"
                                            aria-label="Floating label select example">
                                            @foreach ($commission_statuses as $status)
                                                <option value="{{ $status }}">
                                                    {{ $commission_status_labels[$status] }}</option>
                                            @endforeach
                                        </select>
                                        <label class="crm-label form-label" for="select-status">Status<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->createCommission->has('status'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->createCommission->first('status') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-lg-end justify-content-center mt-3 mb-3">
                                        <button type="button" class="modal-btn-cancel me-3"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="modal-btn-save ">Save </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div class="modal fade" id="updateCommissionModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-medium">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Commission</h5>
                    <button type="button" class=" close-btn text-white" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fa-duotone fa-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <form
                        action="{{ route('staff.commissions.update', old('commission_id') ? old('commission_id') : '1') }}"
                        method="POST">
                        @csrf
                        @method('put')
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-floating">
                                        <select name="client_id" id="client_id" required
                                            class="form-select crm-input {{ $errors->updateCommission->has('client_id') ? 'is-invalid' : '' }}"
                                            aria-label="Floating label select example">
                                            <option selected>Select</option>
                                            @foreach ($clients as $client)
                                                <option
                                                    {{ $errors->hasBag('updateCommission') && old('client_id') == $client->id ? 'selected' : '' }}
                                                    value="{{ $client->id }}">
                                                    {{ $client->user->name }}</option>
                                            @endforeach
                                        </select>
                                        <label class="crm-label form-label" for="select-status">Client<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->updateCommission->has('client_id'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->updateCommission->first('client_id') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating">
                                        <select name="project_id" id="project_id" required
                                            class="form-select crm-input {{ $errors->updateCommission->has('project_id') ? 'is-invalid' : '' }}"
                                            aria-label="Floating label select example">
                                            <option selected>Select</option>
                                            @foreach ($projects as $project)
                                                <option
                                                    {{ $errors->hasBag('updateCommission') && old('project_id') == $project->id ? 'selected' : '' }}
                                                    value="{{ $project->id }}">{{ $project->name }}</option>
                                            @endforeach
                                        </select>
                                        <label class="crm-label form-label" for="select-status">Project<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->updateCommission->has('project_id'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->updateCommission->first('project_id') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="date"
                                            value="{{ $errors->hasBag('updateCommission') ? old('deal_date') : '' }}"
                                            name="deal_date" id="deal_date" required
                                            class="form-control crm-input {{ $errors->updateCommission->has('deal_date') ? 'is-invalid' : '' }}"
                                            id="date" placeholder="ABC">
                                        <label class="crm-label form-label" for="date">Deal Close Date<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->updateCommission->has('deal_date'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->updateCommission->first('deal_date') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            value="{{ $errors->hasBag('updateCommission') ? old('deal_size') : '' }}"
                                            name="deal_size" id="deal_size" required
                                            class="form-control crm-input {{ $errors->updateCommission->has('deal_size') ? 'is-invalid' : '' }}"
                                            id="size" placeholder="ABC">
                                        <label class="crm-label form-label" for="size">Deal Size<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->updateCommission->has('deal_size'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->updateCommission->first('deal_size') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            value="{{ $errors->hasBag('updateCommission') ? old('commission') : '' }}"
                                            name="commission" id="commission" required
                                            class="form-control crm-input {{ $errors->updateCommission->has('commission') ? 'is-invalid' : '' }}"
                                            id="comission" placeholder="ABC">
                                        <label class="crm-label form-label" for="comission">Commission<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->updateCommission->has('commission'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->updateCommission->first('commission') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-floating">
                                        <select name="status" required id="select-status2"
                                            class="form-select crm-input {{ $errors->updateCommission->has('status') ? 'is-invalid' : '' }}"
                                            aria-label="Floating label select example">
                                            @foreach ($commission_statuses as $status)
                                                <option
                                                    {{ $errors->hasBag('updateCommission') && old('status') == $status ? 'selected' : '' }}
                                                    value="{{ $status }}">
                                                    {{ $commission_status_labels[$status] }}</option>
                                            @endforeach
                                        </select>
                                        <label class="crm-label form-label" for="select-status">Status<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->updateCommission->has('status'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->updateCommission->first('status') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-lg-end justify-content-center mt-3 mb-3">
                                        <button type="button" class="modal-btn-cancel me-3"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <input type="hidden" name="commission_id" id="commission_id"
                                            value="{{ old('commission_id') ? old('commission_id') : '1' }}">
                                        <button type="submit" class="modal-btn-save ">Update </button>
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
    @if ($errors->createCommission->any())
        <script>
            $('#leadModal-btn').click()
        </script>
    @endif

    @if ($errors->updateCommission->any())
        <script>
            $('#updateCommissionModal-btn').click()
        </script>
    @endif

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
            // Make an AJAX request to fetch data based on the selected duration
            $.ajax({
                url: '{{ route('staff.partners.total_sales') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    duration,
                    'partner_id': '{{ $currentPartner->id }}'
                },
                success: function(data) {
                    $('#sales').text(data.total);
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        });

        $('.filter-revenue').change(function() {
            var duration = $(this).val();
            // Make an AJAX request to fetch data based on the selected duration
            $.ajax({
                url: '{{ route('staff.partners.total_revenue') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    duration,
                    'partner_id': '{{ $currentPartner->id }}'
                },
                success: function(data) {
                    $('#revenue').text(data.total);
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        });

        $('.filter-commission').change(function() {
            var duration = $(this).val();
            // Make an AJAX request to fetch data based on the selected duration
            $.ajax({
                url: '{{ route('staff.partners.total_commission') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    duration,
                    'partner_id': '{{ $currentPartner->id }}'
                },
                success: function(data) {
                    $('#commission').text(data.total);
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

    <script>
        $('body').on('click', '.change-commission-status', function() {
            let status = $(this).data('status');
            let label = $(this).data('label');
            let color = $(this).data('color');
            let commissionID = $(this).closest('ul').data('commission-id');

            var that = $(this)
            $.ajax({
                url: '{{ route('staff.commissions.update_commission_status', 'commission_id') }}'.replace(
                    'commission_id',
                    commissionID),
                type: 'PATCH',
                data: {
                    '_token': '{{ csrf_token() }}',
                    status
                },
                success: function(response) {
                    if (response.status == 'success') {
                        $(`.dropdown-toggle[data-commission-id="${commissionID}"]`).text(label)
                        $(`.dropdown-toggle[data-commission-id="${commissionID}"]`).css(
                            'background-color', color)
                    }
                }
            })
        })
    </script>

    {{-- Fetch commission on Edit click --}}
    <script>
        $('body').on('click', '.edit', function() {

            $('.loading').removeClass('d-none')

            // Remove validation errors
            $('.is-invalid').removeClass('is-invalid')
            $('.invalid-feedback').remove()

            let commissionID = $(this).data('commission-id');
            $('#updateCommissionModal form').attr('action',
                "{{ route('staff.commissions.update', 'commission_id') }}"
                .replace('commission_id', commissionID))
            $('#updateCommissionModal #commission_id').val(commissionID)
            $.ajax({
                url: '{{ route('staff.commissions.fetch_commission', 'commission_id') }}'
                    .replace('commission_id', commissionID),
                method: 'GET',
                success: function(response) {
                    $('.loading').addClass('d-none')
                    if (response.status == 'success') {
                        console.log(response.commission.status);
                        $("#updateCommissionModal #client_id").val(response.commission.client_id)
                        $("#updateCommissionModal #project_id").val(response.commission.project_id)
                        $("#updateCommissionModal #deal_date").val(response.commission.deal_date)
                        $("#updateCommissionModal #deal_size").val(response.commission.deal_size)
                        $("#updateCommissionModal #commission").val(response.commission.commission)
                        $("#updateCommissionModal #select-status2").val(response.commission.status)
                        $('#updateCommissionModal-btn').click()
                    } else {}
                }
            })
        })
    </script>
@endsection
@endsection
