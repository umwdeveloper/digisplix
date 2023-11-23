@extends('layouts.app')

@section('content')
    @if (session('status'))
        <x-toast type="success">
            {{ session('status') }}
        </x-toast>
    @endif

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
                                <h1 class="box-heading">Ongoing</h1>
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
                                        <button class="table-btn" id="projectModal-btn" class="btn btn-primary"
                                            type="button" data-bs-toggle="modal" data-bs-target="#clientModal">Add
                                            New</button>
                                        <button class="table-btn d-none " id="editProjectModal-btn" type="button"
                                            data-bs-toggle="modal" data-bs-target="#settingModal">Edit
                                            Project</button>
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
                                            <a type="button" data-project-id="{{ $project->id }}" data-bs-toggle="modal"
                                                data-bs-target="#settingModal" class="settingModal"><i
                                                    class="fa-duotone fa-gear-complex me-2"></i></a>
                                            <div class="project-msg ms-2">
                                                <a href="chats.html"> <i class="fa-solid fa-envelope"></i></a>
                                                <div class="project-msg-number">
                                                    3</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="project-detail.html" class="project-card-data">
                                        <img src="{{ getURL($project->img) }}" alt="">
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
                    <form action="{{ route('staff.projects.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-floating mb-3">
                                        <select
                                            class="form-select crm-input {{ $errors->createProject->has('client_id') ? 'is-invalid' : '' }}"
                                            required id="client" name="client_id"
                                            aria-label="Floating label select example">
                                            <option selected disabled>Select</option>
                                            @foreach ($clients as $client)
                                                <option {{ old('client_id') == $client->id ? 'selected' : '' }}
                                                    value="{{ $client->id }}">
                                                    {{ $client->user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label class="crm-label form-label" for="select-status">Client<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->createProject->has('client_id'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->createProject->first('client_id') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" required name="name"
                                            class="form-control crm-input {{ $errors->createProject->has('name') ? 'is-invalid' : '' }}"
                                            id="project" value="{{ old('name') }}" placeholder="ABC">
                                        <label class="crm-label form-label" for="project">Project Name<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->createProject->has('name'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->createProject->first('name') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="date" required
                                            class="form-control crm-input {{ $errors->createProject->has('deadline') ? 'is-invalid' : '' }}"
                                            id="date" name="deadline" value="{{ old('deadline') }}" required
                                            placeholder="ABC">
                                        <label class="crm-label form-label" for="date">Deadline<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->createProject->has('deadline'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->createProject->first('deadline') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-floating mb-3">
                                        <textarea name="description" required
                                            class="form-control crm-input {{ $errors->createProject->has('description') ? 'is-invalid' : '' }}"
                                            placeholder="ABC" id="description" rows="10">{{ old('description') }}</textarea>
                                        <label class="crm-label form-label" for="description">Description<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->createProject->has('description'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->createProject->first('description') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-12 mb-3">

                                    <label class="file crm-input pb-1 w-100" style="position: relative;">
                                        <label class="crm-label form-label " for="file">Picture <span
                                                class="f-12">(Optional)</span></label><br>
                                        <label for="file" class="custom-file-upload" id="upload-text">
                                            <span>Click to Upload <Picture></Picture></span>
                                        </label>
                                        <span class="selected-file-name" style="display: none;"></span>
                                        <span class="delete-icon" id="delete-icon" style="display: none;">&times;</span>

                                        <input type="file" id="file" name="img"
                                            aria-label="File browser example"
                                            class="files ps-0 {{ $errors->createProject->has('img') ? 'is-invalid' : '' }}">

                                    </label>
                                    @if ($errors->createProject->has('img'))
                                        <small class="invalid-feedback " style="font-size: 11px">
                                            {{ $errors->createProject->first('img') }}
                                        </small>
                                    @endif
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

    {{-- Edit Project Modal --}}
    <div class="modal fade" id="settingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-medium">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Project</h5>
                    <button type="button" class=" close-btn text-white" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fa-duotone fa-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('staff.projects.update', old('project_id') ? old('project_id') : '1') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-floating mb-3">
                                        <select
                                            class="form-select crm-input {{ $errors->updateProject->has('client_id') ? 'is-invalid' : '' }}"
                                            required id="client" name="client_id"
                                            aria-label="Floating label select example">
                                            <option selected disabled>Select</option>
                                            @foreach ($clients as $client)
                                                <option {{ old('client_id') == $client->id ? 'selected' : '' }}
                                                    value="{{ $client->id }}">
                                                    {{ $client->user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label class="crm-label form-label" for="select-status">Client<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->updateProject->has('client_id'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->updateProject->first('client_id') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" required name="name"
                                            class="form-control crm-input {{ $errors->updateProject->has('name') ? 'is-invalid' : '' }}"
                                            id="name" value="{{ old('name') }}" placeholder="ABC">
                                        <label class="crm-label form-label" for="project">Project Name<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->updateProject->has('name'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->updateProject->first('name') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="date" required
                                            class="form-control crm-input {{ $errors->updateProject->has('deadline') ? 'is-invalid' : '' }}"
                                            id="deadline" name="deadline" value="{{ old('deadline') }}" required
                                            placeholder="ABC">
                                        <label class="crm-label form-label" for="date">Deadline<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->updateProject->has('deadline'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->updateProject->first('deadline') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <select
                                            class="form-select crm-input {{ $errors->updateProject->has('billing_status') ? 'is-invalid' : '' }}"
                                            name="billing_status" id="select-billing"
                                            aria-label="Floating label select example">
                                            <option selected disabled>Select</option>

                                            <option {{ old('billing_status') == '0' ? 'selected' : '' }} value="0"
                                                style="color: #063AF6; ">
                                                Overdue</option>


                                            <option {{ old('billing_status') == '1' ? 'selected' : '' }} value="1"
                                                style="color: #039227; ">Paid
                                            </option>
                                        </select>
                                        <label class="crm-label form-label" for="select-billing">Billing Status<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->updateProject->has('billing_status'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->updateProject->first('billing_status') }}
                                            </small>
                                        @endif
                                    </div>

                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <select
                                            class="form-select crm-input {{ $errors->updateProject->has('current_status') ? 'is-invalid' : '' }}"
                                            name="current_status" id="select-status"
                                            aria-label="Floating label select example">
                                            <option selected disabled>Select</option>

                                            <option {{ old('current_status') == '0' ? 'selected' : '' }} value="0"
                                                style="color: #063AF6; ">
                                                Ongoing</option>


                                            <option {{ old('current_status') == '1' ? 'selected' : '' }} value="1"
                                                style="color: #039227; ">Completed
                                            </option>
                                        </select>
                                        <label class="crm-label form-label" for="select-status">Current Status<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->updateProject->has('current_status'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->updateProject->first('current_status') }}
                                            </small>
                                        @endif
                                    </div>

                                </div>
                                <div class="col-lg-12">
                                    <div class="form-floating mb-3">
                                        <textarea name="description" required id="description"
                                            class="form-control crm-input {{ $errors->updateProject->has('description') ? 'is-invalid' : '' }}"
                                            placeholder="ABC" id="description" rows="10">{{ old('description') }}</textarea>
                                        <label class="crm-label form-label" for="description">Description<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->updateProject->has('description'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->updateProject->first('description') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-12 mb-3">

                                    <label class="file crm-input pb-1 w-100" style="position: relative;">
                                        <label class="crm-label form-label " for="file">Picture <span
                                                class="f-12">(Optional)</span></label><br>
                                        <label for="file" class="custom-file-upload" id="upload-text">
                                            <span>Click to Upload <Picture></Picture></span>
                                        </label>
                                        <span class="selected-file-name" id="selected-file-name"
                                            style="display: none;"></span>
                                        <span class="delete-icon" id="delete-icon" style="display: none;">&times;</span>

                                        <input type="file" id="file" name="img"
                                            aria-label="File browser example"
                                            class="files ps-0 {{ $errors->updateProject->has('img') ? 'is-invalid' : '' }}">

                                    </label>
                                    @if ($errors->updateProject->has('img'))
                                        <small class="invalid-feedback " style="font-size: 11px">
                                            {{ $errors->updateProject->first('img') }}
                                        </small>
                                    @endif
                                </div>


                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-lg-end justify-content-center mt-3 mb-3">
                                        <button type="button" class="modal-btn-cancel me-3"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <input type="hidden" name="project_id" id="project_id"
                                            value="{{ old('project_id') ? old('project_id') : '1' }}">
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
    @if ($errors->createProject->any())
        <script>
            $('#projectModal-btn').click()
        </script>
    @endif

    @if ($errors->updateProject->any())
        <script>
            $("#editProjectModal-btn").click();
        </script>
    @endif

    <script>
        $('body').on('click', '.custom-file-upload', function() {
            let parentEl = $(this).closest('.crm-input')
            parentEl.find('.files').click();
        })

        $('.files').on('change', function() {
            let parentEl = $(this).closest('.crm-input')
            const fileName = this.files[0].name;
            parentEl.find('.selected-file-name').text(fileName)
            parentEl.find('.selected-file-name').css('display', 'inline')
            parentEl.find('.delete-icon').css('display', 'inline')
            parentEl.find('.custom-file-upload').css('display', 'none')
        })

        $('.delete-icon').on('click', function(e) {
            e.preventDefault()

            let parentEl = $(this).closest('.crm-input')
            parentEl.find('.files').val('')
            parentEl.find('.selected-file-name').text('')
            parentEl.find('.selected-file-name').css('display', 'none')
            parentEl.find('.delete-icon').css('display', 'none')
            parentEl.find('.custom-file-upload').css('display', 'block')
        })
    </script>

    <script>
        // const customFileUpload = document.querySelector('.custom-file-upload');
        // const fileInput = document.querySelector('#file');
        // const selectedFileName = document.querySelector('#selected-file-name');
        // const deleteIcon = document.querySelector('#delete-icon');
        // const uploadText = document.querySelector('#upload-text');

        // customFileUpload.addEventListener('click', () => {
        //     fileInput.click();
        // });

        // fileInput.addEventListener('change', () => {
        //     const fileName = fileInput.files[0]?.name || '';
        //     selectedFileName.textContent = fileName;
        //     selectedFileName.style.display = 'inline';
        //     deleteIcon.style.display = 'inline';
        //     uploadText.style.display = 'none'; // Hide the "Click here to upload" text
        // });

        // deleteIcon.addEventListener('click', (event) => {
        //     event.preventDefault(); // Prevent the file dialog from opening
        //     fileInput.value = ''; // Clear the selected file
        //     selectedFileName.textContent = '';
        //     selectedFileName.style.display = 'none';
        //     deleteIcon.style.display = 'none';
        //     uploadText.style.display = 'block'; // Show the "Click here to upload" text
        // });

        // // If there's an initial file selection, hide the "Click here to upload" text
        // if (fileInput.value) {
        //     uploadText.style.display = 'none';
        // }
    </script>
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
        document.addEventListener("DOMContentLoaded", function() {
            const selectStatus = document.getElementById("select-billing");

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

    {{-- Fetch project on Edit click --}}
    <script>
        $('body').on('click', '.settingModal', function() {
            let projectID = $(this).data('project-id');
            $('#settingModal form').attr('action', "{{ route('staff.projects.update', 'project_id') }}"
                .replace('project_id', projectID))
            $('#settingModal #project_id').val(projectID)
            $.ajax({
                url: '{{ route('staff.projects.fetch_project', 'project_id') }}'
                    .replace('project_id', projectID),
                method: 'GET',
                success: function(response) {
                    if (response.status == 'success') {
                        $("#settingModal #client").val(response.project.client_id)
                        $("#settingModal #name").val(response.project.name)
                        $("#settingModal #deadline").val(response.project.deadline)
                        $("#settingModal #select-billing").val(response.project.billing_status)
                        $("#settingModal #select-status").val(response.project.current_status)
                        $("#settingModal #description").val(response.project.description)
                        // $('#settingModal-btn').click()
                    } else {}
                }
            })
        })
    </script>
@endsection
@endsection
