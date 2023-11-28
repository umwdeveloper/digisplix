@extends('layouts.app')

@section('content')
    <main class="content ">
        <div class="container-fluid px-lg-0">
            <div class="row justify-content-center">
                <div class="col-xl-12 ">
                    <div class="row">
                        <div class="col-lg-12 mb-3 mt-3 d-flex justify-content-between align-items-center">
                            <h4 class="page-title">Staff</h4>
                            <button class="table-btn" id="staffModal-btn" type="button" data-bs-toggle="modal"
                                data-bs-target="#staffModal">Add
                                Staff</button>
                        </div>
                        @foreach ($staff as $member)
                            <div class="col-xl-4 col-md-6 mb-3">
                                <div class="person-card">
                                    <div class="person-image">
                                        <div class="carousel__slide">
                                            <figure>
                                                <div>
                                                    <img src="{{ getURL($member->user->img) }}" alt=""
                                                        class="person-img">
                                                </div>
                                            </figure>
                                        </div>
                                        <div class="dots-dropdown">
                                            <button class="dots-btn2">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <div class=" dots-menu2">
                                                <a class="dropdown-item" href="#">Edit</a>
                                                <!-- <a class="dropdown-item" href="#">Save</a> -->
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="person-detail pb-3">
                                        <h1>{{ $member->user->name }}</h1>
                                        <p class="mb-0">{{ $member->user->designation }}</p>
                                        <p class="mb-0"><a href="">{{ $member->user->phone }}</a></p>
                                        <p class=""><a href="">{{ $member->user->email }}</a></p>
                                        <h2 class="mb-3 ">Allowed Roles</h2>
                                        <div class="row justify-content-center">
                                            <div class="row ">
                                                @foreach ($member->permissions as $permission)
                                                    <div class="col-4">
                                                        <p class="mb-0 text-start"><i class="  fa-solid fa-check"></i>
                                                            {{ ucfirst($permission->name) }}
                                                        </p>
                                                    </div>
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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

    <!-- Add Staff Modal -->
    <div class="modal fade" id="staffModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-medium">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Staff</h5>
                    <button type="button" class=" close-btn text-white" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fa-duotone fa-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('staff.staff.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="">
                                        <div class="form-floating mb-3">
                                            <input type="text"
                                                class="form-control crm-input {{ $errors->createStaff->has('name') ? 'is-invalid' : '' }}"
                                                id="name" name="name"
                                                value="{{ $errors->hasBag('createStaff') ? old('name') : '' }}"
                                                placeholder="Mickel" required>
                                            <label class="crm-label form-label" for="name">Staff Name<span
                                                    class="text-danger">*</span></label>
                                            @if ($errors->createStaff->has('name'))
                                                <small class="invalid-feedback " style="font-size: 11px">
                                                    {{ $errors->createStaff->first('name') }}
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="form-floating mb-3">
                                            <input type="email"
                                                class="form-control crm-input {{ $errors->createStaff->has('email') ? 'is-invalid' : '' }}"
                                                id="email" name="email" required
                                                value="{{ $errors->hasBag('createStaff') ? old('email') : '' }}"
                                                placeholder="ABC">
                                            <label class="crm-label form-label" for="email">Email Address<span
                                                    class="text-danger">*</span></label>
                                            @if ($errors->createStaff->has('email'))
                                                <small class="invalid-feedback " style="font-size: 11px">
                                                    {{ $errors->createStaff->first('email') }}
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="form-floating mb-3">
                                            <input type="text"
                                                class="form-control crm-input {{ $errors->createStaff->has('password') ? 'is-invalid' : '' }}"
                                                id="password" name="password" required
                                                value="{{ generateRandomPassword() }}" placeholder="ABC">
                                            <label class="crm-label form-label" for="email">Password<span
                                                    class="text-danger">*</span></label>
                                            @if ($errors->createStaff->has('password'))
                                                <small class="invalid-feedback " style="font-size: 11px">
                                                    {{ $errors->createStaff->first('password') }}
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="form-floating mb-3">
                                            <input type="text"
                                                class="form-control crm-input {{ $errors->createStaff->has('designation') ? 'is-invalid' : '' }}"
                                                id="designation" name="designation" required
                                                value="{{ $errors->hasBag('createStaff') ? old('designation') : '' }}"
                                                placeholder="ABC">
                                            <label class="crm-label form-label" for="email">Designation<span
                                                    class="text-danger">*</span></label>
                                            @if ($errors->createStaff->has('designation'))
                                                <small class="invalid-feedback " style="font-size: 11px">
                                                    {{ $errors->createStaff->first('designation') }}
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="form-floating mb-3">
                                            <input type="text"
                                                class=" {{ $errors->createStaff->has('country') ? 'is-invalid' : '' }}"
                                                id="country" name="country" required
                                                value="{{ $errors->hasBag('createStaff') ? old('country') : '' }}"
                                                placeholder="Pakistan">
                                            <input type="hidden" id="country_code"
                                                value="{{ $errors->hasBag('createStaff') ? old('country_code') : '' }}"
                                                name="country_code">
                                            <label class="crm-label form-label" for="country">Country<span
                                                    class="text-danger">*</span></label>
                                            @if ($errors->createStaff->has('country'))
                                                <small class="invalid-feedback " style="font-size: 11px">
                                                    {{ $errors->createStaff->first('country') }}
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="form-floating mb-3">
                                            <input type="text"
                                                class="form-control crm-input {{ $errors->createStaff->has('address') ? 'is-invalid' : '' }}"
                                                id="address" name="address" required
                                                value="{{ $errors->hasBag('createStaff') ? old('address') : '' }}"
                                                placeholder="ABC">
                                            <label class="crm-label form-label" for="address">Address<span
                                                    class="text-danger">*</span></label>
                                            @if ($errors->createStaff->has('address'))
                                                <small class="invalid-feedback " style="font-size: 11px">
                                                    {{ $errors->createStaff->first('address') }}
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="form-floating mb-3">
                                            <input type="text"
                                                class="form-control crm-input {{ $errors->createStaff->has('phone') ? 'is-invalid' : '' }}"
                                                id="p-number" name="phone" required
                                                value="{{ $errors->hasBag('createStaff') ? old('phone') : '' }}"
                                                placeholder="ABC">
                                            <label class="crm-label form-label" for="p-number">Phone Number<span
                                                    class="text-danger">*</span></label>
                                            @if ($errors->createStaff->has('phone'))
                                                <small class="invalid-feedback " style="font-size: 11px">
                                                    {{ $errors->createStaff->first('phone') }}
                                                </small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mb-3">

                                        <label class="file crm-input pb-1 w-100" style="position: relative;">
                                            <label class="crm-label form-label " for="file">Picture <span
                                                    class="f-12">(Optional)</span></label><br>
                                            <label for="file" class="custom-file-upload" id="upload-text">
                                                <span>Click to Upload <Picture></Picture></span>
                                            </label>
                                            <span class="selected-file-name" id="selected-file-name"
                                                style="display: none;"></span>
                                            <span class="delete-icon" id="delete-icon"
                                                style="display: none;">&times;</span>

                                            <input type="file" id="file" name="img"
                                                aria-label="File browser example"
                                                class="files ps-0 {{ $errors->createStaff->has('img') ? 'is-invalid' : '' }}">

                                        </label>
                                        @if ($errors->createStaff->has('img'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->createStaff->first('img') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <h3 class="mb-3 text-lg-center text-start text-dark-clr">Allowed Roles</h3>
                                    <div class="mx-lg-auto mx-0" style="width: fit-content;">
                                        @foreach ($permissions as $permission)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    value="{{ $permission->id }}" name="permissions[]"
                                                    id="flexCheckChecked{{ $permission->id }}"
                                                    {{ in_array($permission->id, old('permissions', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label crm-label"
                                                    for="flexCheckChecked{{ $permission->id }}">
                                                    {{ ucfirst($permission->name) }}
                                                </label>
                                            </div>
                                        @endforeach
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

@section('script')
    @if ($errors->createStaff->any())
        <script>
            $('#staffModal-btn').click()
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

        // Country Selector
        $("#country").countrySelect();
    </script>
    <script>
        // Add a click event handler for each .dots-btn2 element
        // Add a click event handler for each .dots-btn2 element
        $(".dots-btn2").on("click", function(event) {
            event.stopPropagation(); // Prevent the click event from propagating to the document

            // Find the corresponding .dots-menu2 for the clicked .dots-btn2
            var $menu = $(this).closest('.dots-dropdown').find('.dots-menu2');

            // Toggle the class for the specific .dots-menu2 associated with this button
            $menu.toggleClass("dots-menu2-show");

            // Remove the dots-menu2-show class from all other .dots-menu2 elements
            $(".dots-menu2").not($menu).removeClass("dots-menu2-show");
        });

        // Add a document click event handler to close all .dots-menu2 elements
        $(document).on("click", function(event) {
            if (!$(event.target).closest(".dots-dropdown").length) {
                $(".dots-menu2").removeClass("dots-menu2-show");
            }
        });
        // Add a click event handler for inside .dots-menu2 elements to close them
        $(".dots-menu2").on("click", function(event) {
            $(this).removeClass("dots-menu2-show");
        });
        // Add a click event handler for each .dots-menu2 element
        $(".dots-menu2").on("click", function(event) {
            event.stopPropagation(); // Prevent the click event from propagating to the document
        });
    </script>
@endsection
@endsection
