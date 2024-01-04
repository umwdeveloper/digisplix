@extends('layouts.partner')

@section('content')
    <main class="content ">
        <div class="container-fluid px-lg-0">
            <div class="row justify-content-center">
                <div class="col-xl-12 ">
                    <div class="row">
                        <div class="col-lg-12 h-100">
                            <div class="box mb-3 box-p">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-3">
                                        <h1 class="f-20 w-500 mb-0 pb-0 text-dark-clr">Profile</h1>
                                    </div>
                                    <form action="{{ route('partner.update', $profile->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div
                                                        class="d-flex flex-column justify-content-center align-items-center  w-100">
                                                        <div class="display-pictute text-center">
                                                            <div class="mb-0 mx-auto position-relative"><img
                                                                    class="edit-img  mx-auto "
                                                                    src="{{ getURL($profile->user->img) }}"
                                                                    id="output" />
                                                                <div class="gradient"></div>
                                                                <div class="remove-picture d-none">X</div>
                                                            </div>
                                                            <p class="mb-0"><input type="file" accept="image/*"
                                                                    name="img" id="file" onchange="loadFile(event)"
                                                                    style="display: none;"></p>
                                                            <button type="button" class="upload-img-btn ">
                                                                <label for="file" class="">
                                                                    Upload Picture
                                                                </label>
                                                            </button>
                                                        </div>
                                                        @if ($errors->has('img'))
                                                            <small class="invalid-feedback text-center "
                                                                style="font-size: 11px">
                                                                {{ $errors->first('img') }}
                                                            </small>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="text"
                                                            class="form-control crm-input {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                            id="name" name="name" value="{{ $profile->user->name }}"
                                                            placeholder="Mickel" required>
                                                        <label class="crm-label form-label" for="name">Name<span
                                                                class="text-danger">*</span></label>
                                                        @if ($errors->has('name'))
                                                            <small class="invalid-feedback " style="font-size: 11px">
                                                                {{ $errors->first('name') }}
                                                            </small>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="email"
                                                            class="form-control crm-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                                            id="email" name="email" required
                                                            value="{{ $profile->user->email }}" placeholder="ABC">
                                                        <label class="crm-label form-label" for="email">Email
                                                            Address<span class="text-danger">*</span></label>
                                                        @if ($errors->has('email'))
                                                            <small class="invalid-feedback " style="font-size: 11px">
                                                                {{ $errors->first('email') }}
                                                            </small>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="text"
                                                            class="form-control crm-input {{ $errors->has('designation') ? 'is-invalid' : '' }}"
                                                            id="designation" name="designation" required
                                                            value="{{ $profile->user->designation }}" placeholder="ABC">
                                                        <label class="crm-label form-label" for="email">Designation<span
                                                                class="text-danger">*</span></label>
                                                        @if ($errors->has('designation'))
                                                            <small class="invalid-feedback " style="font-size: 11px">
                                                                {{ $errors->first('designation') }}
                                                            </small>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class=" mb-3">
                                                        <label class="country-label form-label mb-2"
                                                            for="country">Country<span
                                                                class="text-danger">*</span></label><br>
                                                        <input type="text"
                                                            class=" {{ $errors->has('country') ? 'is-invalid' : '' }}"
                                                            id="country" name="country" required value=""
                                                            placeholder="Pakistan">
                                                        <input type="hidden" id="country_code" value=""
                                                            name="country_code">
                                                        <!-- <label class="crm-label form-label" for="country">Country<span
                                                                    class="text-danger">*</span></label> -->
                                                        @if ($errors->has('country'))
                                                            <small class="invalid-feedback " style="font-size: 11px">
                                                                {{ $errors->first('country') }}
                                                            </small>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="text"
                                                            class="form-control crm-input {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                                            id="address" name="address"
                                                            value="{{ $profile->user->address }}" placeholder="ABC">
                                                        <label class="crm-label form-label" for="address">Address</label>
                                                        @if ($errors->has('address'))
                                                            <small class="invalid-feedback " style="font-size: 11px">
                                                                {{ $errors->first('address') }}
                                                            </small>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="text"
                                                            class="form-control crm-input {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                                                            id="p-number" name="phone" required
                                                            value="{{ $profile->user->phone }}" placeholder="ABC">
                                                        <label class="crm-label form-label" for="p-number">Phone
                                                            Number<span class="text-danger">*</span></label>
                                                        @if ($errors->has('phone'))
                                                            <small class="invalid-feedback " style="font-size: 11px">
                                                                {{ $errors->first('phone') }}
                                                            </small>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="text"
                                                            class="form-control crm-input {{ $errors->has('facebook') ? 'is-invalid' : '' }}"
                                                            id="feedback" name="facebook"
                                                            value="{{ $profile->facebook }}" placeholder="">
                                                        <label class="crm-label form-label" for="feedback">Facebook Link
                                                            <span class="f-12">(Optional)</span></label>
                                                        @if ($errors->has('facebook'))
                                                            <small class="invalid-feedback " style="font-size: 11px">
                                                                {{ $errors->first('facebook') }}
                                                            </small>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="text"
                                                            class="form-control crm-input {{ $errors->has('instagram') ? 'is-invalid' : '' }}"
                                                            id="feedback" name="instagram"
                                                            value="{{ $profile->instagram }}" placeholder="">
                                                        <label class="crm-label form-label" for="feedback">Instagram Link
                                                            <span class="f-12">(Optional)</span></label>
                                                        @if ($errors->has('instagram'))
                                                            <small class="invalid-feedback " style="font-size: 11px">
                                                                {{ $errors->first('instagram') }}
                                                            </small>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="text"
                                                            class="form-control crm-input {{ $errors->has('linkedin') ? 'is-invalid' : '' }}"
                                                            id="feedback" name="linkedin"
                                                            value="{{ $profile->linkedin }}" placeholder="">
                                                        <label class="crm-label form-label" for="feedback">Linkedin Link
                                                            <span class="f-12">(Optional)</span></label>
                                                        @if ($errors->has('linkedin'))
                                                            <small class="invalid-feedback " style="font-size: 11px">
                                                                {{ $errors->first('linkedin') }}
                                                            </small>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div
                                                        class="d-flex justify-content-lg-end justify-content-center mt-3 mb-3">
                                                        <!-- <button type="button" class="modal-btn-cancel me-3"
                                                                                                                                                                                                                                                        data-bs-dismiss="modal">Cancel</button> -->
                                                        <button class="modal-btn-save ">Save </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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
    </main>

@section('script')
    <script>
        $("#country").countrySelect({
            defaultCountry: '{{ $profile->user->country_code }}'
        });

        var loadFile = function(event) {
            var image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);
            $(".remove-picture").removeClass("d-none")
            event.stopPropagation();
        };

        $(".remove-picture").click(function() {
            $("#output").attr('src', 'assets/images/Asset 2 (1).png')
            $(this).addClass("d-none")
        })
    </script>
@endsection
@endsection
