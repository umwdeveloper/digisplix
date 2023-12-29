@extends('layouts.app')

@section('content')
    <main class="content ">
        <div class="container-fluid px-lg-0">
            <div class="row justify-content-center">
                <div class="col-xl-12 ">
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
                                        @can('staff.leads')
                                            <button class="table-btn" id="leadModal-btn" type="button" class="btn btn-primary"
                                                data-bs-toggle="modal" data-bs-target="#leadModal">Add New</button>
                                        @endcan
                                        <button class="table-btn d-none" id="editLeadModal-btn" type="button"
                                            class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#editLeadModal">Edit
                                            Lead</button>
                                    </div>


                                    <div class="tab">
                                        <button class="tablink" data-tab="Tab1" id="defaultOpen">New</button>
                                        <button class="tablink" data-tab="Tab2">In-progress</button>
                                        <button class="tablink" data-tab="Tab3">Failed</button>
                                        <button class="tablink" data-tab="Tab4">Qualified</button>
                                    </div>

                                    <div id="Tab1" class="tabcontent-lead">

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
                                                        <td class="bussiness-name">{{ $lead->business_name }}</td>
                                                        <td>{{ $lead->user->email }}</td>
                                                        <td>
                                                            <div class="dropdown table-dropdown">
                                                                <a class="btn  dropdown-toggle table-dropdown-btn {{ $lead->status }}"
                                                                    href="#" role="button" id="dropdownMenuLink"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                    {{ $status_labels[$lead->status] }}
                                                                </a>

                                                                <ul class="dropdown-menu"
                                                                    data-lead-id="{{ $lead->id }}"
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
                                                            <a href="{{ $lead->url }}">{{ $lead->url }}</a>
                                                        </td>
                                                        <td>
                                                            {{ $lead->user->address }}
                                                        </td>
                                                        <td>
                                                            <div class="table-actions d-flex align-items-center">
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

                                    <div id="Tab2" class="tabcontent-lead">
                                        <div id="In-Progress">
                                            <table id="example-inprogress" class="table data-table-style ">
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
                                                            <td class="bussiness-name">{{ $lead->business_name }}
                                                            </td>
                                                            <td>{{ $lead->user->email }}</td>
                                                            <td>
                                                                <div class="dropdown table-dropdown">
                                                                    <a class="btn  dropdown-toggle table-dropdown-btn {{ $lead->status }}"
                                                                        href="#" role="button"
                                                                        id="dropdownMenuLink" data-bs-toggle="dropdown"
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
                                                                <a href="{{ $lead->url }}">{{ $lead->url }}</a>
                                                            </td>
                                                            <td>
                                                                {{ $lead->user->address }}
                                                            </td>
                                                            <td>
                                                                <div class="table-actions d-flex align-items-center">
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

                                    <div id="Tab3" class="tabcontent-lead">

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
                                                        <td class="bussiness-name">{{ $lead->business_name }}</td>
                                                        <td>{{ $lead->user->email }}</td>
                                                        <td>
                                                            <div class="dropdown table-dropdown">
                                                                <a class="btn  dropdown-toggle table-dropdown-btn {{ $lead->status }}"
                                                                    href="#" role="button" id="dropdownMenuLink"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                    {{ $status_labels[$lead->status] }}
                                                                </a>

                                                                <ul class="dropdown-menu"
                                                                    data-lead-id="{{ $lead->id }}"
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
                                                            <a href="{{ $lead->url }}">{{ $lead->url }}</a>
                                                        </td>
                                                        <td>
                                                            {{ $lead->user->address }}
                                                        </td>
                                                        <td>
                                                            <div class="table-actions d-flex align-items-center">
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

                                    <div id="Tab4" class="tabcontent-lead">
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
                                                        <td class="bussiness-name">{{ $lead->business_name }}</td>
                                                        <td>{{ $lead->user->email }}</td>
                                                        <td>
                                                            <div class="dropdown table-dropdown">
                                                                <a class="btn  dropdown-toggle table-dropdown-btn {{ $lead->status }}"
                                                                    href="#" role="button" id="dropdownMenuLink"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                    {{ $status_labels[$lead->status] }}
                                                                </a>

                                                                <ul class="dropdown-menu"
                                                                    data-lead-id="{{ $lead->id }}"
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
                                                            <a href="{{ $lead->url }}">{{ $lead->url }}</a>
                                                        </td>
                                                        <td>
                                                            {{ $lead->user->address }}
                                                        </td>
                                                        <td>
                                                            <div class="table-actions d-flex align-items-center">
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
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <div class="box">
                                <p class="f-14 w-500 mb-0 pb-0 text-center text-gray text-dark-clr" id="copyright-year">
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </main>

    <!-- New Lead Modal -->
    <div class="modal fade" id="leadModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-medium">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Lead</h5>
                    <button type="button" class=" close-btn text-white" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fa-duotone fa-xmark"></i></button>
                </div>
                <div class="modal-body">
                    @if ($errors->createLead->has('db_error'))
                        <small>{{ $errors->createLead->first('db_error') }}</small>
                    @endif
                    <form action="{{ route('staff.leads.store') }}" method="POST" novalidate>
                        @csrf
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control crm-input {{ $errors->createLead->has('name') ? 'is-invalid' : '' }}"
                                            id="name" name="name" required
                                            value="{{ $errors->hasBag('createLead') ? old('name') : '' }}"
                                            placeholder="Mickel">
                                        <label class="crm-label form-label" for="name">Client Name<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->createLead->has('name'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->createLead->first('name') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control crm-input {{ $errors->createLead->has('business_name') ? 'is-invalid' : '' }}"
                                            id="business-name" name="business_name" required
                                            value="{{ $errors->hasBag('createLead') ? old('business_name') : '' }}"
                                            placeholder="Mickel">
                                        <label class="crm-label form-label" for="business-name">Business Name<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->createLead->has('business_name'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->createLead->first('business_name') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control crm-input {{ $errors->createLead->has('business_email') ? 'is-invalid' : '' }}"
                                            id="business-email" name="business_email" required
                                            value="{{ $errors->hasBag('createLead') ? old('business_email') : '' }}"
                                            placeholder="Mickel">
                                        <label class="crm-label form-label" for="business-email">Business
                                            Email<span class="text-danger">*</span></label>
                                        @if ($errors->createLead->has('business_email'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->createLead->first('business_email') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control crm-input {{ $errors->createLead->has('business_phone') ? 'is-invalid' : '' }}"
                                            id="business-phone" name="business_phone" required
                                            value="{{ $errors->hasBag('createLead') ? old('business_phone') : '' }}"
                                            placeholder="Mickel">
                                        <label class="crm-label form-label" for="business-phone">Business
                                            Phone<span class="text-danger">*</span></label>
                                        @if ($errors->createLead->has('business_phone'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->createLead->first('business_phone') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control crm-input {{ $errors->createLead->has('title') ? 'is-invalid' : '' }}"
                                            id="Title" name="title" required
                                            value="{{ $errors->hasBag('createLead') ? old('title') : '' }}"
                                            placeholder="ABC">
                                        <label class="crm-label form-label" for="Title">Title<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->createLead->has('title'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->createLead->first('title') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="email"
                                            class="form-control crm-input {{ $errors->createLead->has('email') ? 'is-invalid' : '' }}"
                                            id="email" name="email" required
                                            value="{{ $errors->hasBag('createLead') ? old('email') : '' }}"
                                            placeholder="ABC">
                                        <input type="hidden"
                                            class="form-control crm-input {{ $errors->createLead->has('password') ? 'is-invalid' : '' }}"
                                            id="password" name="password" required
                                            value="{{ generateRandomPassword() }}" placeholder="ABC">
                                        <label class="crm-label form-label" for="email">Email Address<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->createLead->has('email'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->createLead->first('email') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                {{-- <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control crm-input {{ $errors->createLead->has('password') ? 'is-invalid' : '' }}"
                                            id="password" name="password" required
                                            value="{{ generateRandomPassword() }}" placeholder="ABC">
                                        <label class="crm-label form-label" for="email">Password<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->createLead->has('password'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->createLead->first('password') }}
                                            </small>
                                        @endif
                                    </div>
                                </div> --}}
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control crm-input {{ $errors->createLead->has('designation') ? 'is-invalid' : '' }}"
                                            id="designation" name="designation" required
                                            value="{{ $errors->hasBag('createLead') ? old('designation') : '' }}"
                                            placeholder="ABC">
                                        <label class="crm-label form-label" for="email">Designation<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->createLead->has('designation'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->createLead->first('designation') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">

                                    <div class="form-floating">
                                        <select
                                            class="form-select crm-input {{ $errors->createLead->has('status') ? 'is-invalid' : '' }}"
                                            required id="select-status" name="status"
                                            aria-label="Floating label select example">
                                            <option selected disabled>Select</option>
                                            @foreach ($statuses as $status)
                                                @if ($status == 'in_progress' || $status == 'failed' || $status == 'qualified')
                                                    @continue
                                                @endif
                                                <option
                                                    {{ $errors->hasBag('createLead') && old('status') === $status ? 'selected' : '' }}
                                                    value="{{ $status }}"
                                                    style="color: {{ $status_colors[$status] }}; ">
                                                    {{ $status_labels[$status] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label class="crm-label form-label" for="select-status">Status<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->createLead->has('status'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->createLead->first('status') }}
                                            </small>
                                        @endif
                                    </div>

                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control crm-input {{ $errors->createLead->has('url') ? 'is-invalid' : '' }}"
                                            id="url" name="url" required
                                            value="{{ $errors->hasBag('createLead') ? old('url') : '' }}"
                                            placeholder="ABC">
                                        <label class="crm-label form-label" for="url">URL<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->createLead->has('url'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->createLead->first('url') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating">
                                        <select
                                            class="form-select crm-input {{ $errors->createLead->has('partner_id') ? 'is-invalid' : '' }}"
                                            required id="partner_id" name="partner_id"
                                            aria-label="Floating label select example">
                                            <option selected disabled>Select</option>
                                            @foreach ($partners as $partner)
                                                <option
                                                    {{ $errors->hasBag('createLead') && old('partner_id') == $partner->id ? 'selected' : '' }}
                                                    value="{{ $partner->id }}">
                                                    {{ $partner->user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label class="crm-label form-label" for="partner_id">Partner<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->createLead->has('partner_id'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->createLead->first('partner_id') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control crm-input {{ $errors->createLead->has('phone') ? 'is-invalid' : '' }}"
                                            id="p-number" name="phone" required
                                            value="{{ $errors->hasBag('createLead') ? old('phone') : '' }}"
                                            placeholder="ABC">
                                        <label class="crm-label form-label" for="p-number">Phone Number<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->createLead->has('phone'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->createLead->first('phone') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class=" mb-3">
                                        <label class="country-label form-label mb-2" for="country">Country<span
                                                class="text-danger">*</span></label><br>
                                        <input type="text"
                                            class=" {{ $errors->createLead->has('country') ? 'is-invalid' : '' }}"
                                            id="country" name="country" required
                                            value="{{ $errors->hasBag('createLead') ? old('country') : '' }}"
                                            placeholder="Pakistan">
                                        <input type="hidden" id="country_code" name="country_code">
                                        <!-- <label class="crm-label form-label" for="country">Country<span
                                                                                                class="text-danger">*</span></label> -->
                                        @if ($errors->createLead->has('country'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->createLead->first('country') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control crm-input {{ $errors->createLead->has('address') ? 'is-invalid' : '' }}"
                                            id="address" name="address" required
                                            value="{{ $errors->hasBag('createLead') ? old('address') : '' }}"
                                            placeholder="ABC">
                                        <label class="crm-label form-label" for="address">Address<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->createLead->has('address'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->createLead->first('address') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="date"
                                            class="form-control crm-input {{ $errors->createLead->has('joined_date') ? 'is-invalid' : '' }}"
                                            id="date" name="joined_date" required
                                            value="{{ $errors->hasBag('createLead') ? old('joined_date') : '' }}"
                                            placeholder="ABC">
                                        <label class="crm-label form-label" for="date">Joined Date<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->createLead->has('joined_date'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->createLead->first('joined_date') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="date"
                                            class="form-control crm-input {{ $errors->createLead->has('followup_date') ? 'is-invalid' : '' }}"
                                            id="follow-date" name="followup_date" required
                                            value="{{ $errors->hasBag('createLead') ? old('followup_date') : '' }}"
                                            placeholder="ABC">
                                        <label class="crm-label form-label" for="follow-date">Follow-up Date<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->createLead->has('followup_date'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->createLead->first('followup_date') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-lg-end justify-content-center mt-3 mb-3">
                                        <button type="button" class="modal-btn-cancel me-3"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" name="submit" class="modal-btn-save ">Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Lead Modal -->
    <div class="modal fade" id="editLeadModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-medium">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Lead</h5>
                    <button type="button" class=" close-btn text-white" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fa-duotone fa-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('staff.leads.update', old('lead_id') ? old('lead_id') : '1') }}"
                        method="POST" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control crm-input {{ $errors->updateLead->has('name') ? 'is-invalid' : '' }}"
                                            id="name" name="name" required
                                            value="{{ $errors->hasBag('updateLead') ? old('name') : '' }}"
                                            placeholder="Mickel">
                                        <label class="crm-label form-label" for="name">Client Name<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->updateLead->has('name'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->updateLead->first('name') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control crm-input {{ $errors->updateLead->has('business_name') ? 'is-invalid' : '' }}"
                                            id="business-name" name="business_name" required
                                            value="{{ $errors->hasBag('updateLead') ? old('business_name') : '' }}"
                                            placeholder="Mickel">
                                        <label class="crm-label form-label" for="business-name">Business Name<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->updateLead->has('business_name'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->updateLead->first('business_name') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control crm-input {{ $errors->updateLead->has('business_email') ? 'is-invalid' : '' }}"
                                            id="business-email" name="business_email" required
                                            value="{{ $errors->hasBag('updateLead') ? old('business_email') : '' }}"
                                            placeholder="Mickel">
                                        <label class="crm-label form-label" for="business-email">Business
                                            Email<span class="text-danger">*</span></label>
                                        @if ($errors->updateLead->has('business_email'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->updateLead->first('business_email') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control crm-input {{ $errors->updateLead->has('business_phone') ? 'is-invalid' : '' }}"
                                            id="business-phone" name="business_phone" required
                                            value="{{ $errors->hasBag('updateLead') ? old('business_phone') : '' }}"
                                            placeholder="Mickel">
                                        <label class="crm-label form-label" for="business-phone">Business
                                            Phone<span class="text-danger">*</span></label>
                                        @if ($errors->updateLead->has('business_phone'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->updateLead->first('business_phone') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control crm-input {{ $errors->updateLead->has('title') ? 'is-invalid' : '' }}"
                                            id="Title" name="title" required
                                            value="{{ $errors->hasBag('updateLead') ? old('title') : '' }}"
                                            placeholder="ABC">
                                        <label class="crm-label form-label" for="Title">Title<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->updateLead->has('title'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->updateLead->first('title') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="email"
                                            class="form-control crm-input {{ $errors->updateLead->has('email') ? 'is-invalid' : '' }}"
                                            id="email" name="email" required
                                            value="{{ $errors->hasBag('updateLead') ? old('email') : '' }}"
                                            placeholder="ABC">
                                        <label class="crm-label form-label" for="email">Email Address<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->updateLead->has('email'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->updateLead->first('email') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control crm-input {{ $errors->updateLead->has('designation') ? 'is-invalid' : '' }}"
                                            id="designation" name="designation" required
                                            value="{{ $errors->hasBag('updateLead') ? old('designation') : '' }}"
                                            placeholder="ABC">
                                        <label class="crm-label form-label" for="email">Designation<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->updateLead->has('designation'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->updateLead->first('designation') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">

                                    <div class="form-floating">
                                        <select
                                            class="form-select crm-input {{ $errors->updateLead->has('status') ? 'is-invalid' : '' }}"
                                            required id="select-status2" name="status"
                                            aria-label="Floating label select example">
                                            @foreach ($statuses as $status)
                                                <option
                                                    {{ $errors->hasBag('updateLead') && old('status') === $status ? 'selected' : '' }}
                                                    value="{{ $status }}"
                                                    style="color: {{ $status_colors[$status] }}; ">
                                                    {{ $status_labels[$status] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label class="crm-label form-label" for="select-status">Status<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->updateLead->has('status'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->updateLead->first('status') }}
                                            </small>
                                        @endif
                                    </div>

                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control crm-input {{ $errors->updateLead->has('url') ? 'is-invalid' : '' }}"
                                            id="url" name="url" required
                                            value="{{ $errors->hasBag('updateLead') ? old('url') : '' }}"
                                            placeholder="ABC">
                                        <label class="crm-label form-label" for="url">URL<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->updateLead->has('url'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->updateLead->first('url') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating">
                                        <select
                                            class="form-select crm-input {{ $errors->updateLead->has('partner_id') ? 'is-invalid' : '' }}"
                                            required id="partner_id" name="partner_id"
                                            aria-label="Floating label select example">
                                            <option selected disabled>Select</option>
                                            @foreach ($partners as $partner)
                                                <option
                                                    {{ $errors->hasBag('updateLead') && old('partner_id') == $partner->id ? 'selected' : '' }}
                                                    value="{{ $partner->id }}">
                                                    {{ $partner->user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label class="crm-label form-label" for="partner_id">Partner<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->updateLead->has('partner_id'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->updateLead->first('partner_id') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control crm-input {{ $errors->updateLead->has('phone') ? 'is-invalid' : '' }}"
                                            id="p-number" name="phone" required
                                            value="{{ $errors->hasBag('updateLead') ? old('phone') : '' }}"
                                            placeholder="ABC">
                                        <label class="crm-label form-label" for="p-number">Phone Number<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->updateLead->has('phone'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->updateLead->first('phone') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class=" mb-3">
                                        <label class="country-label form-label mb-2" for="country2">Country<span
                                                class="text-danger">*</span></label><br>
                                        <input type="text"
                                            class=" {{ $errors->updateLead->has('country') ? 'is-invalid' : '' }}"
                                            id="country2" name="country" required
                                            value="{{ $errors->hasBag('updateLead') ? old('country') : '' }}"
                                            placeholder="Pakistan">
                                        <input type="hidden" id="country2_code" name="country_code">

                                        @if ($errors->updateLead->has('country'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->updateLead->first('country') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control crm-input {{ $errors->updateLead->has('address') ? 'is-invalid' : '' }}"
                                            id="address" name="address" required
                                            value="{{ $errors->hasBag('updateLead') ? old('address') : '' }}"
                                            placeholder="ABC">
                                        <label class="crm-label form-label" for="address">Address<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->updateLead->has('address'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->updateLead->first('address') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="date"
                                            class="form-control crm-input {{ $errors->updateLead->has('joined_date') ? 'is-invalid' : '' }}"
                                            id="date" name="joined_date" required
                                            value="{{ $errors->hasBag('updateLead') ? old('joined_date') : '' }}"
                                            placeholder="ABC">
                                        <label class="crm-label form-label" for="date">Joined Date<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->updateLead->has('joined_date'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->updateLead->first('joined_date') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="date"
                                            class="form-control crm-input {{ $errors->updateLead->has('followup_date') ? 'is-invalid' : '' }}"
                                            id="follow-date" name="followup_date" required
                                            value="{{ $errors->hasBag('updateLead') ? old('followup_date') : '' }}"
                                            placeholder="ABC">
                                        <label class="crm-label form-label" for="follow-date">Follow-up Date<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->updateLead->has('followup_date'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->updateLead->first('followup_date') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-lg-end justify-content-center mt-3 mb-3">
                                        <button type="button" class="modal-btn-cancel me-3"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <input type="hidden" name="lead_id" id="lead_id"
                                            value="{{ old('lead_id') ? old('lead_id') : '1' }}">
                                        <button type="submit" name="submit" class="modal-btn-save ">Update
                                        </button>
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
    @if ($errors->createLead->any())
        <script>
            $('#leadModal-btn').click()
        </script>
    @endif

    @if ($errors->updateLead->any())
        <script>
            $("#country2").countrySelect({
                defaultCountry: "us"
            });
            $("#country2").countrySelect("setCountry", "{{ $errors->hasBag('updateLead') ? old('country') : '' }}");
            $('#editLeadModal-btn').click()
        </script>
    @endif

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let selectStatus = document.getElementById("select-status");

            selectStatus.addEventListener("change", function() {
                // Get the selected option
                let selectedOption = selectStatus.options[selectStatus.selectedIndex];

                // Get the styles from the selected option
                let backgroundColor = selectedOption.style.backgroundColor;
                let color = selectedOption.style.color;

                // Apply the styles to the select element
                selectStatus.style.backgroundColor = backgroundColor;
                selectStatus.style.color = color;
            });

            selectStatus = document.getElementById("select-status2");

            selectStatus.addEventListener("change", function() {
                // Get the selected option
                let selectedOption = selectStatus.options[selectStatus.selectedIndex];

                // Get the styles from the selected option
                let backgroundColor = selectedOption.style.backgroundColor;
                let color = selectedOption.style.color;

                // Apply the styles to the select element
                selectStatus.style.backgroundColor = backgroundColor;
                selectStatus.style.color = color;
            });
        });
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

        // Country Selector
        $("#country").countrySelect();
    </script>

    {{-- Fetch lead on Edit click --}}
    <script>
        $('body').on('click', '.edit', function() {

            $('.loading').removeClass('d-none')

            // Remove validation errors
            $('.is-invalid').removeClass('is-invalid')
            $('.invalid-feedback').remove()

            let leadID = $(this).data('lead-id');
            $('#editLeadModal form').attr('action', "{{ route('staff.leads.update', 'lead_id') }}"
                .replace('lead_id', leadID))
            $('#editLeadModal #lead_id').val(leadID)
            $.ajax({
                url: '{{ route('staff.leads.fetch_lead', 'lead_id') }}'
                    .replace('lead_id', leadID),
                method: 'GET',
                success: function(response) {
                    $('.loading').addClass('d-none')
                    if (response.status == 'success') {
                        $("#editLeadModal #name").val(response.lead.user.name)
                        $("#editLeadModal #business-name").val(response.lead.business_name)
                        $("#editLeadModal #business-email").val(response.lead.business_email)
                        $("#editLeadModal #business-phone").val(response.lead.business_phone)
                        $("#editLeadModal #Title").val(response.lead.title)
                        $("#editLeadModal #email").val(response.lead.user.email)
                        $("#editLeadModal #designation").val(response.lead.user.designation)
                        $("#editLeadModal #select-status2").val(response.lead.status)
                        $("#editLeadModal #url").val(response.lead.url)
                        $("#editLeadModal #partner_id").val(response.lead.partner.id)
                        $("#editLeadModal #address").val(response.lead.user.address)
                        $("#editLeadModal #p-number").val(response.lead.user.phone)
                        $("#editLeadModal #date").val(response.lead.joined_at.split(" ")[0])
                        $("#editLeadModal #follow-date").val(response.lead.followup_date.split(" ")[0])

                        $("#country2").countrySelect({
                            defaultCountry: response.lead.user.country
                        });
                        $("#country2").countrySelect("setCountry", response.lead.user.country);
                        $('#editLeadModal-btn').click()
                    } else {}
                }
            })
        })
    </script>
@endsection
@endsection
