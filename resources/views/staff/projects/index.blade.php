@extends('layouts.app')

@section('content')
    <main class="content ">
        <div class="container-fluid px-lg-0">
            <div class="row justify-content-center">
                <div class="col-xl-12 ">
                    <div class="row">

                        <div class="col-xl-3  col-md-6 mb-3">
                            <div class="box">
                                <h1 class="box-heading">Completed</h1>
                                <div class="d-flex align-items-center">
                                    <div class=" flex-grow-1  box-text d-flex align-items-center">

                                        <span class="box-value">{{ $completed_projects }}</span>

                                    </div>
                                    <div class="box-icon">
                                        <i class="fa-duotone fa-ballot-check"></i>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3  col-md-6 mb-3">
                            <div class="box">
                                <h1 class="box-heading">On-Going</h1>
                                <div class="d-flex align-items-center">
                                    <div class=" flex-grow-1  box-text d-flex align-items-center">

                                        <span class="box-value">{{ $ongoing_projects }}</span>

                                    </div>
                                    <div class="box-icon">
                                        <i class="fa-duotone fa-bars-progress"></i>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3  col-md-6 mb-3">
                            <div class="box">
                                <h1 class="box-heading">Paid</h1>
                                <div class="d-flex align-items-center">
                                    <div class=" flex-grow-1  box-text d-flex align-items-center">
                                        <span class="box-value">{{ $paid_projects }}</span>

                                    </div>
                                    <div class="box-icon">
                                        <i class="fa-duotone fa-sack-dollar"></i>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3  col-md-6 mb-3">
                            <div class="box">
                                <h1 class="box-heading">Overdue</h1>
                                <div class="d-flex align-items-center">
                                    <div class=" flex-grow-1  box-text d-flex align-items-center">
                                        <span class="box-value">{{ $overdue_projects }}</span>

                                    </div>
                                    <div class="box-icon">
                                        <i class="fa-duotone fa-sack"></i>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 h-100">
                            <div class=" mb-3 mt-3">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-3">
                                        <h1 class="f-20 w-500 mb-0 pb-0 text-dark-clr">Projects</h1>
                                        <button class="table-btn" class="btn btn-primary" type="button"
                                            data-bs-toggle="modal" data-bs-target="#clientModal">Add New</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <select class="form-select box ms-auto" aria-label="Default select example">
                                <option selected class="w-600">Filter</option>
                                <option value="On-Going" class="w-500 f-16">On-Going</option>
                                <option value="Completed" class="w-500 f-16">Completed</option>
                            </select>
                        </div>
                        @foreach ($projects as $project)
                            <div class=" col-xxl-3 col-xl-4  col-md-6 mb-3">
                                <div class="project-card">
                                    <div class="project-card--header">
                                        <h2 class="mb-0 pb-0 ">{{ $status_labels[$project->current_status] }}</h2>
                                        <div class="d-flex align-items-center">
                                            <a type="button" data-bs-toggle="modal" data-bs-target="#settingModal"><i
                                                    class="fa-duotone fa-gear-complex me-2"></i></a>
                                            <div class="project-msg ms-2">
                                                <a href="chats.html"> <i class="fa-solid fa-envelope"></i></a>
                                                <div class="project-msg-number">
                                                    3</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="project-detail.html" class="project-card-data">
                                        <img src="assets/images/vatar.png" alt="">
                                        <div class="ms-2">
                                            <h1 class="mb-0 pb-0">{{ $project->name }}</h1>
                                            <h3 class="mb-0 pb-0">{{ $project->client->user->name }}</h3>
                                        </div>
                                    </a>
                                    <div class="project-card-details">
                                        <p class="mb-0 pb-0">
                                            {{ $project->description }}
                                        </p>
                                        <div class="d-flex justify-content-between align-items-end mt-4">
                                            <button
                                                class="{{ $project->billing_status == 0 ? 'overdue' : 'paid' }}">{{ $billing_labels[$project->billing_status] }}</button>
                                            <div>
                                                <div class="completed">
                                                    <i class="fa-duotone fa-calendar-days me-1"></i>
                                                    <span class="mb-0 pb-0">{{ $project->deadline }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
    </main>

    <!-- Add Project Modal -->
    <div class="modal fade" id="clientModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-medium">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Project</h5>
                    <button type="button" class=" close-btn text-white" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fa-duotone fa-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('staff.projects.create') }}" method="POST">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-floating mb-3">
                                        <select class="form-select crm-input" required id="client" name="client_id"
                                            aria-label="Floating label select example">
                                            <option selected disabled>Select</option>
                                            @foreach ($clients as $client)
                                                <option value="{{ $client->id }}">
                                                    {{ $client->user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label class="crm-label form-label" for="select-status">Client<span
                                                class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control crm-input" id="project"
                                            placeholder="ABC">
                                        <label class="crm-label form-label" for="project">Project Name<span
                                                class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="date" class="form-control crm-input" id="date"
                                            name="deadline" required placeholder="ABC">
                                        <label class="crm-label form-label" for="date">Deadline<span
                                                class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-floating mb-3">
                                        <textarea name="description" class="form-control crm-input" placeholder="ABC" id="description" rows="10"></textarea>
                                        <label class="crm-label form-label" for="description">Description<span
                                                class="text-danger">*</span></label>
                                    </div>
                                </div>

                                <div class="col-lg-12 mb-3">

                                    <label class="file crm-input pb-1 w-100" style="position: relative;">
                                        <label class="crm-label form-label " for="commission">Picture <span
                                                class="f-12">(Optional)</span></label><br>
                                        <label for="file" class="custom-file-upload" id="upload-text">
                                            <span>Click to Upload <Picture></Picture></span>
                                        </label>
                                        <span id="selected-file-name" style="display: none;"></span>
                                        <span class="delete-icon" id="delete-icon" style="display: none;">&times;</span>

                                        <input type="file" id="file" aria-label="File browser example"
                                            class="ps-0">

                                    </label>
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

    <!-- Edit Project Modal -->
    <div class="modal fade" id="settingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-medium">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Project Settings</h5>
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
                                        <select class="form-select crm-input" id="select-billing"
                                            aria-label="Floating label select example">
                                            <option>Select</option>

                                            <option value="2" style="color: #063AF6; ">
                                                Overdue</option>


                                            <option value="6" style="color: #039227; ">Paid
                                            </option>
                                        </select>
                                        <label class="crm-label form-label" for="select-billing">Billing Status<span
                                                class="text-danger">*</span></label>
                                    </div>

                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <select class="form-select crm-input" id="select-status"
                                            aria-label="Floating label select example">
                                            <option>Select</option>

                                            <option value="2" style="color: #063AF6; ">
                                                On-Going</option>


                                            <option value="6" style="color: #039227; ">Completed
                                            </option>
                                        </select>
                                        <label class="crm-label form-label" for="select-status">Changing Status<span
                                                class="text-danger">*</span></label>
                                    </div>

                                </div>
                                <div class="col-lg-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control crm-input" id="project"
                                            placeholder="ABC">
                                        <label class="crm-label form-label" for="project">Project Name<span
                                                class="text-danger">*</span></label>
                                    </div>
                                </div>

                                <div class="col-lg-12 mb-3">

                                    <label class="file crm-input pb-1 w-100" style="position: relative;">
                                        <label class="crm-label form-label " for="commission">Picture <span
                                                class="f-12">(Optional)</span></label><br>
                                        <label for="file" class="custom-file-upload" id="upload-text">
                                            <span>Click to Upload <Picture></Picture></span>
                                        </label>
                                        <span id="selected-file-name" style="display: none;"></span>
                                        <span class="delete-icon" id="delete-icon" style="display: none;">&times;</span>

                                        <input type="file" id="file" aria-label="File browser example"
                                            class="ps-0">

                                    </label>
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
@endsection
