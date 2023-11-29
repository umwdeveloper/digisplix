@extends('layouts.app')

@section('content')
    <main class="content ">
        <div class="container-fluid px-lg-0">
            <div class="row justify-content-center">
                <div class="col-xl-12 ">
                    <div class="row">
                        <div class="col-lg-12 mb-3 mt-3 d-flex justify-content-between align-items-center">
                            <h4 class="page-title">Partners</h4>
                            @can('staff.partners')
                                <button class="table-btn" type="button" id="partnerModal-btn" class="btn btn-primary"
                                    data-bs-toggle="modal" data-bs-target="#partnerModal">Add Partner</button>
                            @endcan
                            <button class="table-btn d-none" type="button" id="editPartnerModal-btn"
                                class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editPartnerModal">Edit
                                Partner</button>
                        </div>
                        @foreach ($partners as $partner)
                            <div class="col-xl-4 col-md-6 mb-3">
                                <a href="partner-detail.html">
                                    <div class="person-card">
                                        <div class="ribbon-two ribbon-two-success"><span
                                                style="background-color: {{ getRandomColor() }}">{{ $partner->commission }}%</span>
                                        </div>
                                        <div class="carousel__slide">
                                            <figure>
                                                <div>
                                                    <img src="{{ getURL($partner->user->img) }}" alt=""
                                                        class="person-img">
                                                </div>
                                            </figure>
                                            <img src="{{ asset('vendor/blade-flags/country-' . $partner->user->country_code . '.svg') }}"
                                                alt="" class="person-flag">
                                            {{-- <x-dynamic-component
                                                component="flag-country-{{ $partner->user->country_code }}" /> --}}
                                        </div>
                                        <div class="person-detail">
                                            <div class="d-flex justify-content-center align-items-center contact-icon mb-3">
                                                <div class="d-flex justify-content-center align-items-center fb mx-1">
                                                    @php
                                                        $facebook = strpos($partner->facebook, 'http://') === 0 || strpos($partner->facebook, 'https://') === 0 ? $partner->facebook : 'http://' . $partner->facebook;
                                                    @endphp
                                                    <a target="_blank" href="{{ $facebook }}"> <i
                                                            class="bi bi-facebook"></i></a>
                                                </div>
                                                <div class="d-flex justify-content-center align-items-center insta mx-1">
                                                    @php
                                                        $instagram = strpos($partner->instagram, 'http://') === 0 || strpos($partner->instagram, 'https://') === 0 ? $partner->instagram : 'http://' . $partner->instagram;
                                                    @endphp
                                                    <a target="_blank" href="{{ $instagram }}"> <i
                                                            class="bi bi-instagram"></i></a>
                                                </div>
                                                <div class="d-flex justify-content-center align-items-center linkedin mx-1">
                                                    @php
                                                        $linkedin = strpos($partner->linkedin, 'http://') === 0 || strpos($partner->linkedin, 'https://') === 0 ? $partner->linkedin : 'http://' . $partner->linkedin;
                                                    @endphp
                                                    <a target="_blank" href="{{ $linkedin }}"> <i
                                                            class="bi bi-linkedin"></i></a>
                                                </div>
                                                <div class="d-flex justify-content-center align-items-center msg mx-1">
                                                    <a target="_blank" href=""> <i
                                                            class="bi bi-envelope-fill"></i></a>
                                                </div>
                                            </div>
                                            <h1>{{ $partner->user->name }}</h1>
                                            <p class="mb-0">{{ $partner->user->designation }}</p>
                                            <p class="mb-0"><a href="">{{ $partner->user->phone }}</a></p>
                                            <p><a href="">{{ $partner->user->email }}</a></p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="dots-dropdown">
                                                    <button class="dots-btn">
                                                        <i class="bi bi-three-dots-vertical"></i>
                                                    </button>
                                                    <div class="dots-menu">
                                                        <a class="dropdown-item editPartner"
                                                            data-partner-id="{{ $partner->id }}" data-bs-toggle="modal"
                                                            data-bs-target="#editPartnerModal">Edit</a>
                                                        <form action="{{ route('staff.partners.destroy', $partner->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a class="dropdown-item"
                                                                onclick="this.closest('form').submit()">Delete</a>
                                                        </form>
                                                    </div>
                                                </div>
                                                <p class="mb-0 pb-0">{{ $partner->user->country }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
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

    <!-- Add Partner Modal -->
    <div class="modal fade" id="partnerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-medium">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Partner</h5>
                    <button type="button" class=" close-btn text-white" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fa-duotone fa-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('staff.partners.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control crm-input {{ $errors->createPartner->has('name') ? 'is-invalid' : '' }}"
                                            id="name" name="name"
                                            value="{{ $errors->hasBag('createPartner') ? old('name') : '' }}"
                                            placeholder="Mickel" required>
                                        <label class="crm-label form-label" for="name">Partner Name<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->createPartner->has('name'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->createPartner->first('name') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="email"
                                            class="form-control crm-input {{ $errors->createPartner->has('email') ? 'is-invalid' : '' }}"
                                            id="email" name="email" required
                                            value="{{ $errors->hasBag('createPartner') ? old('email') : '' }}"
                                            placeholder="ABC">
                                        <label class="crm-label form-label" for="email">Email Address<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->createPartner->has('email'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->createPartner->first('email') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control crm-input {{ $errors->createPartner->has('password') ? 'is-invalid' : '' }}"
                                            id="password" name="password" required
                                            value="{{ generateRandomPassword() }}" placeholder="ABC">
                                        <label class="crm-label form-label" for="email">Password<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->createPartner->has('password'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->createPartner->first('password') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control crm-input {{ $errors->createPartner->has('designation') ? 'is-invalid' : '' }}"
                                            id="designation" name="designation" required
                                            value="{{ $errors->hasBag('createPartner') ? old('designation') : '' }}"
                                            placeholder="ABC">
                                        <label class="crm-label form-label" for="email">Designation<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->createPartner->has('designation'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->createPartner->first('designation') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class=" {{ $errors->createPartner->has('country') ? 'is-invalid' : '' }}"
                                            id="country" name="country" required
                                            value="{{ $errors->hasBag('createPartner') ? old('country') : '' }}"
                                            placeholder="Pakistan">
                                        <input type="hidden" id="country_code"
                                            value="{{ $errors->hasBag('createPartner') ? old('country_code') : '' }}"
                                            name="country_code">
                                        <label class="crm-label form-label" for="country">Country<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->createPartner->has('country'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->createPartner->first('country') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control crm-input {{ $errors->createPartner->has('address') ? 'is-invalid' : '' }}"
                                            id="address" name="address" required
                                            value="{{ $errors->hasBag('createPartner') ? old('address') : '' }}"
                                            placeholder="ABC">
                                        <label class="crm-label form-label" for="address">Address<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->createPartner->has('address'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->createPartner->first('address') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control crm-input {{ $errors->createPartner->has('phone') ? 'is-invalid' : '' }}"
                                            id="p-number" name="phone" required
                                            value="{{ $errors->hasBag('createPartner') ? old('phone') : '' }}"
                                            placeholder="ABC">
                                        <label class="crm-label form-label" for="p-number">Phone Number<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->createPartner->has('phone'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->createPartner->first('phone') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control crm-input {{ $errors->createPartner->has('commission') ? 'is-invalid' : '' }}"
                                            id="commission" name="commission"
                                            value="{{ $errors->hasBag('createPartner') ? old('commission') : '' }}"
                                            placeholder="30" required>
                                        <label class="crm-label form-label" for="commission">Commission <span
                                                class="text-danger">*</span></label>
                                        @if ($errors->createPartner->has('commission'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->createPartner->first('commission') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control crm-input {{ $errors->createPartner->has('facebook') ? 'is-invalid' : '' }}"
                                            id="feedback" name="facebook"
                                            value="{{ $errors->hasBag('createPartner') ? old('facebook') : '' }}"
                                            placeholder="">
                                        <label class="crm-label form-label" for="feedback">Facebook Link <span
                                                class="f-12">(Optional)</span></label>
                                        @if ($errors->createPartner->has('facebook'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->createPartner->first('facebook') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control crm-input {{ $errors->createPartner->has('instagram') ? 'is-invalid' : '' }}"
                                            id="feedback" name="instagram"
                                            value="{{ $errors->hasBag('createPartner') ? old('instagram') : '' }}"
                                            placeholder="">
                                        <label class="crm-label form-label" for="feedback">Instagram Link <span
                                                class="f-12">(Optional)</span></label>
                                        @if ($errors->createPartner->has('instagram'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->createPartner->first('instagram') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control crm-input {{ $errors->createPartner->has('linkedin') ? 'is-invalid' : '' }}"
                                            id="feedback" name="linkedin"
                                            value="{{ $errors->hasBag('createPartner') ? old('linkedin') : '' }}"
                                            placeholder="">
                                        <label class="crm-label form-label" for="feedback">Linkedin Link <span
                                                class="f-12">(Optional)</span></label>
                                        @if ($errors->createPartner->has('linkedin'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->createPartner->first('linkedin') }}
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
                                            class="files ps-0 {{ $errors->createPartner->has('img') ? 'is-invalid' : '' }}">

                                    </label>
                                    @if ($errors->createPartner->has('img'))
                                        <small class="invalid-feedback " style="font-size: 11px">
                                            {{ $errors->createPartner->first('img') }}
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

    {{-- Edit Partner Modal --}}
    <div class="modal fade" id="editPartnerModal" data-partner-id="" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-medium">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Partner</h5>
                    <button type="button" class=" close-btn text-white" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fa-duotone fa-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('staff.partners.update', old('partner_id') ? old('partner_id') : '1') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control crm-input {{ $errors->updatePartner->has('name') ? 'is-invalid' : '' }}"
                                            id="edit_name" name="name"
                                            value="{{ $errors->hasBag('updatePartner') ? old('name') : '' }}"
                                            placeholder="Mickel" required>
                                        <label class="crm-label form-label" for="name">Partner Name<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->updatePartner->has('name'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->updatePartner->first('name') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="email"
                                            class="form-control crm-input {{ $errors->updatePartner->has('email') ? 'is-invalid' : '' }}"
                                            id="edit_email" name="email" required
                                            value="{{ $errors->hasBag('updatePartner') ? old('email') : '' }}"
                                            placeholder="ABC">
                                        <label class="crm-label form-label" for="email">Email Address<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->updatePartner->has('email'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->updatePartner->first('email') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control crm-input {{ $errors->updatePartner->has('designation') ? 'is-invalid' : '' }}"
                                            id="edit_designation" name="designation" required
                                            value="{{ $errors->hasBag('updatePartner') ? old('designation') : '' }}"
                                            placeholder="ABC">
                                        <label class="crm-label form-label" for="email">Designation<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->updatePartner->has('designation'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->updatePartner->first('designation') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class=" {{ $errors->updatePartner->has('country') ? 'is-invalid' : '' }}"
                                            id="country2" name="country" required
                                            value="{{ $errors->hasBag('updatePartner') ? old('country') : '' }}"
                                            placeholder="Pakistan">
                                        <input type="hidden" id="country2_code" value="{{ old('country_code') }}"
                                            name="country_code">
                                        <label class="crm-label form-label" for="country2">Country<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->updatePartner->has('country'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->updatePartner->first('country') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control crm-input {{ $errors->updatePartner->has('address') ? 'is-invalid' : '' }}"
                                            id="edit_address" name="address" required
                                            value="{{ $errors->hasBag('updatePartner') ? old('address') : '' }}"
                                            placeholder="ABC">
                                        <label class="crm-label form-label" for="address">Address<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->updatePartner->has('address'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->updatePartner->first('address') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control crm-input {{ $errors->updatePartner->has('phone') ? 'is-invalid' : '' }}"
                                            id="edit_p-number" name="phone" required
                                            value="{{ $errors->hasBag('updatePartner') ? old('phone') : '' }}"
                                            placeholder="ABC">
                                        <label class="crm-label form-label" for="p-number">Phone Number<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->updatePartner->has('phone'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->updatePartner->first('phone') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control crm-input {{ $errors->updatePartner->has('commission') ? 'is-invalid' : '' }}"
                                            id="edit_commission" name="commission"
                                            value="{{ $errors->hasBag('updatePartner') ? old('commission') : '' }}"
                                            placeholder="30" required>
                                        <label class="crm-label form-label" for="commission">Commission <span
                                                class="text-danger">*</span></label>
                                        @if ($errors->updatePartner->has('commission'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->updatePartner->first('commission') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control crm-input {{ $errors->updatePartner->has('facebook') ? 'is-invalid' : '' }}"
                                            id="edit_facebook" name="facebook"
                                            value="{{ $errors->hasBag('updatePartner') ? old('facebook') : '' }}"
                                            placeholder="">
                                        <label class="crm-label form-label" for="facebook">Facebook Link <span
                                                class="f-12">(Optional)</span></label>
                                        @if ($errors->updatePartner->has('facebook'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->updatePartner->first('facebook') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control crm-input {{ $errors->updatePartner->has('instagram') ? 'is-invalid' : '' }}"
                                            id="edit_instagram" name="instagram"
                                            value="{{ $errors->hasBag('updatePartner') ? old('instagram') : '' }}"
                                            placeholder="">
                                        <label class="crm-label form-label" for="instagram">Instagram Link <span
                                                class="f-12">(Optional)</span></label>
                                        @if ($errors->updatePartner->has('instagram'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->updatePartner->first('instagram') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control crm-input {{ $errors->updatePartner->has('linkedin') ? 'is-invalid' : '' }}"
                                            id="edit_linkedin" name="linkedin"
                                            value="{{ $errors->hasBag('updatePartner') ? old('linkedin') : '' }}"
                                            placeholder="">
                                        <label class="crm-label form-label" for="linkedin">Linkedin Link <span
                                                class="f-12">(Optional)</span></label>
                                        @if ($errors->updatePartner->has('linkedin'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->updatePartner->first('linkedin') }}
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
                                            class="files ps-0 {{ $errors->updatePartner->has('img') ? 'is-invalid' : '' }}">

                                    </label>
                                    @if ($errors->updatePartner->has('img'))
                                        <small class="invalid-feedback " style="font-size: 11px">
                                            {{ $errors->updatePartner->first('img') }}
                                        </small>
                                    @endif
                                </div>


                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-lg-end justify-content-center mt-3 mb-3">
                                        <button type="button" class="modal-btn-cancel me-3"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <input type="hidden" name="partner_id" id="partner_id"
                                            value="{{ old('partner_id') ? old('partner_id') : '1' }}">
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
    @if ($errors->createPartner->any())
        <script>
            $('#partnerModal-btn').click()
        </script>
    @endif

    @if ($errors->updatePartner->any())
        <script>
            $("#country2").countrySelect({
                defaultCountry: "us"
            });
            $("#country2").countrySelect("setCountry", "{{ $errors->hasBag('updatePartner') ? old('country') : '' }}");

            $('#editPartnerModal-btn').click()
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
        // Add a click event handler for each .dots-btn element
        // Add a click event handler for each .dots-btn element
        $(".dots-btn").on("click", function(event) {
            // event.stopPropagation(); // Prevent the click event from propagating to the document

            // Find the corresponding .dots-menu2 for the clicked .dots-btn
            var $menu = $(this).closest('.dots-dropdown').find('.dots-menu');

            // Toggle the class for the specific .dots-menu2 associated with this button
            $menu.toggleClass("dots-menu-show");

            // Remove the dots-menu-show class from all other .dots-menu2 elements
            $(".dots-menu").not($menu).removeClass("dots-menu-show");
        });

        // Add a document click event handler to close all .dots-menu2 elements
        $(document).on("click", function(event) {
            if (!$(event.target).closest(".dots-dropdown").length) {
                $(".dots-menu").removeClass("dots-menu-show");
            }
        });
        // Add a click event handler for inside .dots-menu2 elements to close them
        $(".dots-menu").on("click", function(event) {
            $(this).removeClass("dots-menu-show");
        });
        // Add a click event handler for each .dots-menu2 element
        $(".dots-menu").on("click", function(event) {
            // event.stopPropagation(); // Prevent the click event from propagating to the document
        });
    </script>

    {{-- Fetch partner on Edit click --}}
    <script>
        $('body').on('click', '.editPartner', function() {
            // Remove form validation errors
            $('.is-invalid').removeClass('is-invalid')
            $('.invalid-feedback').remove()

            let partnerID = $(this).data('partner-id');
            $('#editPartnerModal form').attr('action', "{{ route('staff.partners.update', 'partner_id') }}"
                .replace('partner_id', partnerID))
            $('#editPartnerModal #partner_id').val(partnerID)

            $.ajax({
                url: '{{ route('staff.partners.fetch_partner', 'partner_id') }}'
                    .replace('partner_id', partnerID),
                method: 'GET',
                success: function(response) {
                    if (response.status == 'success') {
                        $("#editPartnerModal #edit_name").val(response.partner.user.name)
                        $("#editPartnerModal #edit_email").val(response.partner.user.email)
                        $("#editPartnerModal #edit_designation").val(response.partner.user.designation)
                        $("#editPartnerModal #edit_address").val(response.partner.user.address)
                        $("#editPartnerModal #edit_p-number").val(response.partner.user.phone)
                        $("#editPartnerModal #edit_commission").val(response.partner.commission)
                        $("#editPartnerModal #edit_facebook").val(response.partner.facebook)
                        $("#editPartnerModal #edit_instagram").val(response.partner.instagram)
                        $("#editPartnerModal #edit_linkedin").val(response.partner.linkedin)

                        $("#country2").countrySelect({
                            defaultCountry: response.partner.user.country
                        });
                        $("#country2").countrySelect("setCountry", response.partner.user.country);
                    } else {}
                }
            })
        })
    </script>
@endsection
@endsection
