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

                                        <span class="box-value">{{ number_format($completed_projects, 0, ',') }}</span>

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

                                        <span class="box-value">{{ number_format($ongoing_projects, 0, ',') }}</span>

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
                                        <span class="box-value">{{ number_format($paid_projects, 0, ',') }}</span>

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
                                        <span class="box-value">{{ number_format($overdue_projects, 0, ',') }}</span>

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
                                        @can('staff.projects')
                                            <button class="table-btn" id="projectModal-btn" class="btn btn-primary"
                                                type="button" data-bs-toggle="modal" data-bs-target="#clientModal">Add
                                                New</button>
                                        @endcan
                                        <button class="table-btn d-none " id="editProjectModal-btn" type="button"
                                            data-bs-toggle="modal" data-bs-target="#settingModal">Edit
                                            Project</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <select class="form-select box ms-auto" id="filter-select" aria-label="Default select example">
                                <option selected value="all" class="w-600">All</option>
                                <option {{ request('filter') === 'ongoing' ? 'selected' : '' }} value="ongoing"
                                    class="w-500 f-16">Ongoing</option>
                                <option {{ request('filter') === 'completed' ? 'selected' : '' }} value="completed"
                                    class="w-500 f-16">Completed</option>
                            </select>
                        </div>
                        @forelse ($projects as $project)
                            <div class=" col-xxl-3 col-xl-4  col-md-6 mb-3">
                                <div class="project-card">
                                    <div class="project-card--header">
                                        <h2 class="mb-0 pb-0 ">{{ $status_labels[$project->current_status] }}</h2>
                                        <div class="d-flex align-items-center">
                                            <form action="{{ route('staff.projects.destroy', $project->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="me-3">
                                                    <button type="submit" class="btn p-0 delete-anchor"><a class="p-0">
                                                            <i class="fa-duotone fa-trash"></i></a></button>
                                                </div>
                                            </form>
                                            <a type="button" data-project-id="{{ $project->id }}" data-bs-toggle="modal"
                                                data-bs-target="#settingModal" class="settingModal"><i
                                                    class="fa-duotone fa-gear-complex me-2"></i></a>
                                            <div class="project-msg ms-2">
                                                <a href="{{ route('user', $project->client->user->id) }}"> <i
                                                        class="fa-solid fa-envelope"></i></a>
                                                @if ($project->messagesCount > 0)
                                                    <div class="project-msg-number">
                                                        {{ $project->messagesCount }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <a href="{{ route('staff.projects.show', $project->id) }}" class="project-card-data">
                                        <img src="{{ $project->img ? getURL($project->img) : asset('images/placeholder.png') }}"
                                            alt="">
                                        <div class="ms-2">
                                            <h1 class="mb-0 pb-0">{{ $project->name }}</h1>
                                        </div>
                                    </a>
                                    <div class="project-card-details">
                                        <p class="mb-0 pb-0" style="font-weight: 600; font-size: 17px">
                                            {{ $project->client->business_name }}
                                        </p>
                                        <p class="mb-0 pb-0">
                                            {{ $project->client->user->name }}
                                        </p>
                                        <div class="d-flex justify-content-between align-items-end mt-4">
                                            <button
                                                class="{{ $project->billing_status == 0 ? 'overdue' : 'paid' }}">{{ $billing_labels[$project->billing_status] }}</button>
                                            <div>
                                                <div class="completed">
                                                    <i class="fa-duotone fa-calendar-days me-1"></i>
                                                    <span
                                                        class="mb-0 pb-0">{{ \Carbon\Carbon::parse($project->deadline)->format('d M Y') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <x-no_data></x-no_data>
                        @endforelse
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
                                                <option
                                                    {{ $errors->hasBag('createProject') && old('client_id') == $client->id ? 'selected' : '' }}
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
                                            id="project"
                                            value="{{ $errors->hasBag('createProject') ? old('name') : '' }}"
                                            placeholder="ABC">
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
                                            id="date" name="deadline"
                                            value="{{ $errors->hasBag('createProject') ? old('deadline') : '' }}" required
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
                                        <input type="hidden" name="progress" value="0">
                                        <input type="hidden" name="billing_status" value="1">
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
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <select
                                            class="form-select crm-input {{ $errors->updateProject->has('client_id') ? 'is-invalid' : '' }}"
                                            required id="client" name="client_id"
                                            aria-label="Floating label select example">
                                            <option selected disabled>Select</option>
                                            @foreach ($clients as $client)
                                                <option
                                                    {{ $errors->hasBag('updateProject') && old('client_id') == $client->id ? 'selected' : '' }}
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
                                            id="name"
                                            value="{{ $errors->hasBag('updateProject') ? old('name') : '' }}"
                                            placeholder="ABC">
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
                                            id="deadline" name="deadline"
                                            value="{{ $errors->hasBag('updateProject') ? old('deadline') : '' }}" required
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

                                            <option
                                                {{ $errors->hasBag('updateProject') && old('billing_status') == '0' ? 'selected' : '' }}
                                                value="0" style="color: #063AF6; ">
                                                Overdue</option>


                                            <option
                                                {{ $errors->hasBag('updateProject') && old('billing_status') == '1' ? 'selected' : '' }}
                                                value="1" style="color: #039227; ">Paid
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

                                            <option
                                                {{ $errors->hasBag('updateProject') && old('current_status') == '0' ? 'selected' : '' }}
                                                value="0" style="color: #063AF6; ">
                                                Ongoing</option>


                                            <option
                                                {{ $errors->hasBag('updateProject') && old('current_status') == '1' ? 'selected' : '' }}
                                                value="1" style="color: #039227; ">Completed
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
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" required name="progress"
                                            class="form-control crm-input {{ $errors->updateProject->has('progress') ? 'is-invalid' : '' }}"
                                            id="progress"
                                            value="{{ $errors->hasBag('updateProject') ? old('progress') : '' }}"
                                            placeholder="ABC">
                                        <label class="crm-label form-label" for="project">Project Progress<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->updateProject->has('progress'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->updateProject->first('progress') }}
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
                                            value="{{ $errors->hasBag('updateProject') && old('project_id') ? old('project_id') : '1' }}">
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
        <script>
            window.onload = function() {
                @if ($errors->createProject->any())
                    $('#projectModal-btn').click()
                @endif

                @if ($errors->updateProject->any())
                    $("#editProjectModal-btn").click();
                @endif
            }
        </script>

        <script>
            $("#filter-select").on('change', function() {
                var url;
                if ($(this).val() === "all") {
                    url = "{{ route('staff.projects.index') }}"
                } else {
                    url = "{{ route('staff.projects.index') }}" +
                        "?filter=" + $(this).val()
                }
                window.location.href = url
            })
        </script>

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
                $('#settingModal form')[0].reset();

                // Remove validation errors
                $('.is-invalid').removeClass('is-invalid')
                $('.invalid-feedback').remove()

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
                            $("#settingModal #progress").val(response.project.progress)
                            $("#settingModal #description").val(response.project.description)
                            // $('#settingModal-btn').click()
                        } else {}
                    }
                })
            })
        </script>
    @endsection
@endsection
