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

                                        <span class="box-value">{{ $new_leads->count() }}</span>

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
                                        <button class="table-btn" type="button" class="btn btn-primary"
                                            data-bs-toggle="modal" data-bs-target="#leadModal">Add New</button>
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
                                                        <td>{{ $lead->business_email }}</td>
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
                                                                <button class="edit">Edit</button>
                                                                <button class="save">Save</button>
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
                                                        <th>Partners</th>
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
                                                            <td class="bussiness-name">{{ $lead->business_name }}</td>
                                                            <td>{{ $lead->business_email }}</td>
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
                                                                    <button class="edit">Edit</button>
                                                                    <button class="save">Save</button>
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
                                                    <th>Partners</th>
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
                                                        <td>{{ $lead->business_email }}</td>
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
                                                                <button class="edit">Edit</button>
                                                                <button class="save">Save</button>
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
                                                    <th>Partners</th>
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
                                                        <td>{{ $lead->business_email }}</td>
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
                                                                <button class="edit">Edit</button>
                                                                <button class="save">Save</button>
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

    <!-- Modal -->
    <div class="modal fade" id="leadModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-medium">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Lead</h5>
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
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control crm-input" id="Title"
                                            placeholder="ABC">
                                        <label class="crm-label form-label" for="Title">Title<span
                                                class="text-danger">*</span></label>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control crm-input" id="email"
                                            placeholder="ABC">
                                        <label class="crm-label form-label" for="email">Email Address<span
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
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control crm-input" id="url"
                                            placeholder="ABC">
                                        <label class="crm-label form-label" for="url">URL<span
                                                class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control crm-input" id="partner"
                                            placeholder="ABC">
                                        <label class="crm-label form-label" for="partner">Partner<span
                                                class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control crm-input" id="country"
                                            placeholder="ABC">
                                        <label class="crm-label form-label" for="country">Country<span
                                                class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control crm-input" id="address"
                                            placeholder="ABC">
                                        <label class="crm-label form-label" for="address">Address<span
                                                class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control crm-input" id="p-number"
                                            placeholder="ABC">
                                        <label class="crm-label form-label" for="p-number">Phone Number<span
                                                class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="date" class="form-control crm-input" id="date"
                                            placeholder="ABC">
                                        <label class="crm-label form-label" for="date">Date<span
                                                class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="date" class="form-control crm-input" id="follow-date"
                                            placeholder="ABC">
                                        <label class="crm-label form-label" for="follow-date">Follow-up Date<span
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
        $('.change-status').on('click', function() {
            let status = $(this).data('status');
            let leadID = $(this).closest('ul').data('lead-id');

            $.ajax({
                url: '{{ route('staff.update_lead_status', 'lead_id') }}'.replace('lead_id', leadID),
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
