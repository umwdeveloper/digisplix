@extends('layouts.app')

@section('content')
    <main class="content ">
        <div class="container-fluid px-lg-0">
            <div class="row justify-content-center">

                <div class="col-lg-12 h-100">
                    <div class="box mb-3 box-p">
                        <div class="flex-grow-1">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h1 class="f-20 w-500 mb-0 pb-0 text-dark-clr">Settings</h1>
                            </div>


                            <div class="tab">
                                <button class="tablink tablink-profile" data-tab="Tab1" id="defaultOpen">Reset
                                    Password</button>
                                <button class="tablink tablink-profile" data-tab="Tab2">Two Factor Authentication</button>
                            </div>

                            <div id="Tab1" class="tabcontent-lead" style="min-height: 50vh;">
                                <form action="{{ route('staff.reset_password') }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="">
                                        <div class="row">

                                            <div class="col-lg-12">
                                                <div class="form-floating mb-3">
                                                    <input type="password" required
                                                        class="form-control crm-input {{ $errors->has('old_password') ? 'is-invalid' : '' }}"
                                                        id="old-pass" name="old_password" placeholder="Mickel">
                                                    <label class="crm-label form-label" for="old-pass">Old
                                                        Password<span class="text-danger"></span></label>

                                                    @if ($errors->has('old_password'))
                                                        <small class="invalid-feedback " style="font-size: 11px">
                                                            {{ $errors->first('old_password') }}
                                                        </small>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-floating mb-3">
                                                    <input type="password" required
                                                        class="form-control crm-input {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                                        id="new-password" name="password" placeholder="ABC">
                                                    <label class="crm-label form-label" for="new-password">New
                                                        Password<span class="text-danger"></span></label>
                                                    @if ($errors->has('password'))
                                                        <small class="invalid-feedback " style="font-size: 11px">
                                                            {{ $errors->first('password') }}
                                                        </small>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-floating mb-3">
                                                    <input type="password" required class="form-control crm-input"
                                                        id="confirm-password" placeholder="Mickel"
                                                        name="password_confirmation">
                                                    <label class="crm-label form-label" for="confirm-password">Confirm
                                                        Password<span class="text-danger"></span></label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="d-flex justify-content-lg-end justify-content-center mt-3 mb-3">
                                                    <!-- <button type="button" class="modal-btn-cancel me-3"
                                                                                                                                                                                data-bs-dismiss="modal">Cancel</button> -->
                                                    <button type="submit" class="modal-btn-save ">Save </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div id="Tab2" class="tabcontent-lead" style="min-height: 50vh;">

                                <div class="">
                                    <div class="row">
                                        <div class="col-lg-5 mx-auto">
                                            <div class="verification-div mx-auto">
                                                <div class="verification-div--header">
                                                    <h1>Two Factor Authentication</h1>
                                                </div>
                                                <div class="verification-div-body">
                                                    <form action="" id="" class="multistep-form">


                                                        <div class="tab-step">
                                                            <p class="mb-0 pb-0">When 2FA is enabled you will get the
                                                                confirmation code on the following email address
                                                            </p>
                                                            <div class="col-lg-12 mt-3">
                                                                <div class="form-floating mb-3">
                                                                    <input type="text" readonly
                                                                        value="{{ auth()->user()->email }}"
                                                                        class="form-control crm-input" id="old-pass"
                                                                        placeholder="Mickel">
                                                                    <label class="crm-label form-label"
                                                                        for="old-pass">Verification
                                                                        Email<span class="text-danger"></span></label>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="tab-step">
                                                            <p class="mb-0 pb-0">Enter Code send to your email
                                                            </p>
                                                            <div class="d-flex justify-content-center mt-4">
                                                                <input type="text" maxlength="1" class="code-input">
                                                                <input type="text" maxlength="1" class="code-input">
                                                                <input type="text" maxlength="1" class="code-input">
                                                                <input type="text" maxlength="1" class="code-input">
                                                            </div>
                                                            <div class="d-flex justify-content-center">
                                                                <button
                                                                    class="bg-transparent border-0 mt-4 pt-2 f-14 text-primary text-center">Resend</button>
                                                            </div>
                                                        </div>
                                                        <div class="tab-step">
                                                            <div
                                                                class="d-flex justify-content-center align-items-center flex-column congratulations">

                                                                <img src="{{ asset('images/happy.svg') }}" alt="">
                                                                <h2>Congratulations!</h2>
                                                                <p class="mb-0 pb-0">
                                                                    Your Email has been Verified.
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="d-flex justify-content-lg-end justify-content-center mt-4">

                                                            <button type="button" class="modal-btn-save nextBtn"
                                                                id="" onclick="nextPrev(1)">continue</button>

                                                        </div>
                                                    </form>
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
        </div>
        <div class="row mb-3">
            <div class="col-lg-12">
                <div class="box">
                    <p class="f-14 w-500 mb-0 pb-0 text-center text-gray text-dark-clr" id="copyright-year"></p>
                </div>
            </div>
        </div>
    </main>

@section('script')
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
        const inputs = document.querySelectorAll(".code-input");
        const codeBlock = document.getElementById("code-block");
        const code = document.getElementById("code");
        const form = document.querySelector("form");

        inputs.forEach((input, key) => {
            if (key !== 0) {
                input.addEventListener("click", function() {
                    inputs[0].focus();
                });
            }
            input.addEventListener("keyup", function() {
                if (input.value) {
                    if (key === 3) {
                        // Last one tadaa
                        const userCode = [...inputs].map((input) => input.value).join("");
                        codeBlock.classList.remove("hidden");
                        code.innerText = userCode;
                    } else {
                        inputs[key + 1].focus();
                    }
                }
            });
        });

        const reset = () => {
            form.reset();
            codeBlock.classList.add("hidden");
            code.innerText = "";
        };
    </script>

    <script>
        $(document).ready(function() {
            $(".multistep-form").each(function() {
                var currentTab = 0;
                var form = $(this);
                var tabSteps = form.find(".tab-step");
                var nextBtn = form.find(".nextBtn");

                showTab(currentTab);

                function showTab(n) {
                    tabSteps.hide();
                    tabSteps.eq(n).show();

                    if (n == tabSteps.length - 1) {
                        nextBtn.hide();
                        nextBtn.text("Submit");
                    } else {
                        nextBtn.show();
                        nextBtn.text("Next");
                    }
                }

                nextBtn.click(function() {
                    if (currentTab === 0) {
                        enable2FA()
                    }
                    tabSteps.eq(currentTab).hide();
                    currentTab = currentTab + 1;
                    if (currentTab >= tabSteps.length) {
                        form.submit();
                        return false;
                    }
                    showTab(currentTab);
                });

                function enable2FA() {
                    $.ajax({
                        url: '{{ route('staff.enable2FA') }}',
                        success: function() {
                            alert('2fa enabled')
                        }
                    })
                }
            });
        });
    </script>
@endsection
@endsection
