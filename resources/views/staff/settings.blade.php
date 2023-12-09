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
                                            @if (auth()->user()->two_fa)
                                                <div class="verification-div mx-auto">
                                                    <div class="verification-div--header">
                                                        <h1>Two Factor Authentication</h1>
                                                    </div>
                                                    <div class="verification-div-body">
                                                        <form action="{{ route('staff.disable2FA') }}" method="POST"
                                                            class="">
                                                            @csrf

                                                            <div class="">
                                                                <p class="mb-0 pb-0">2FA is enabled and the confirmation
                                                                    codes are sent to the following email address
                                                                </p>
                                                                <div class="col-lg-12 mt-3">
                                                                    <div class="form-floating mb-3">
                                                                        <input type="text" readonly
                                                                            value="{{ auth()->user()->email }}"
                                                                            class="form-control crm-input" id="email"
                                                                            placeholder="Mickel">
                                                                        <label class="crm-label form-label"
                                                                            for="email">Verification
                                                                            Email<span class="text-danger"></span></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="d-flex justify-content-lg-end justify-content-center mt-4">

                                                                <button type="submit"
                                                                    class="modal-btn-save">Disable</button>

                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="verification-div mx-auto">
                                                    <div class="verification-div--header">
                                                        <h1>Two Factor Authentication</h1>
                                                    </div>
                                                    <div class="verification-div-body">
                                                        <form action="" class="multistep-form">


                                                            <div class="tab-step">
                                                                <p class="mb-0 pb-0">When 2FA is enabled you will get the
                                                                    confirmation code on the following email address
                                                                </p>
                                                                <div class="col-lg-12 mt-3">
                                                                    <div class="form-floating mb-3">
                                                                        <input type="text" readonly
                                                                            value="{{ auth()->user()->email }}"
                                                                            class="form-control crm-input" id="email"
                                                                            placeholder="Mickel">
                                                                        <label class="crm-label form-label"
                                                                            for="email">Verification
                                                                            Email<span class="text-danger"></span></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="tab-step confirmation-tab">
                                                                <p class="mb-0 pb-0">Enter code sent to your email
                                                                </p>
                                                                <div class="d-flex justify-content-center mt-4">
                                                                    <input type="text" id="digit1" maxlength="1"
                                                                        class="code-input"
                                                                        oninput="validateNumericInput(this)">
                                                                    <input type="text" id="digit2" maxlength="1"
                                                                        class="code-input"
                                                                        oninput="validateNumericInput(this)">
                                                                    <input type="text" id="digit3" maxlength="1"
                                                                        class="code-input"
                                                                        oninput="validateNumericInput(this)">
                                                                    <input type="text" id="digit4" maxlength="1"
                                                                        class="code-input"
                                                                        oninput="validateNumericInput(this)">
                                                                </div>
                                                                <div class="text-center ">
                                                                    <small id="timer" class="text-danger ">Wait <span
                                                                            id="time">00:59</span> seconds to resend
                                                                        the code</small>
                                                                </div>
                                                                <div class="d-flex justify-content-center">
                                                                    <style>
                                                                        .disabled {
                                                                            cursor: not-allowed;
                                                                        }
                                                                    </style>
                                                                    <button type="button" disabled id="resend-btn"
                                                                        class="bg-transparent border-0 mt-4 pt-2 f-14 text-primary text-center disabled ">Resend</button>
                                                                </div>
                                                            </div>
                                                            <div class="tab-step">
                                                                <div
                                                                    class="d-flex justify-content-center align-items-center flex-column congratulations">

                                                                    <img src="{{ asset('images/happy.svg') }}"
                                                                        alt="">
                                                                    <h2>Congratulations!</h2>
                                                                    <p class="mb-0 pb-0">
                                                                        Two Factor Authentication is now enabled
                                                                    </p>
                                                                </div>
                                                            </div>

                                                            <div id="wait-msg" class="text-center d-none">
                                                                <small class="text-danger ">Please wait while we send
                                                                    the confirmation code...</small>
                                                            </div>
                                                            <div
                                                                class="d-flex justify-content-lg-end justify-content-center mt-4">

                                                                <button type="button"
                                                                    class="modal-btn-save nextBtn">Continue</button>

                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            @endif

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
        function validateNumericInput(input) {
            // Remove non-numeric characters using a regular expression
            input.value = input.value.replace(/[^0-9]/g, '');
        }
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

        inputs.forEach((input, key) => {
            input.addEventListener("keydown", function(event) {
                if (event.key === "Backspace") {
                    // Handle backspace key
                    if (input.value === "") {
                        // Input is empty, focus on the previous input
                        if (key > 0) {
                            inputs[key - 1].focus();
                        }
                    } else {
                        // Remove the last digit
                        input.value = input.value.slice(0, -1);
                    }
                }
            });

            input.addEventListener("keyup", function() {
                if (input.value) {
                    if (key === inputs.length - 1) {
                        // Last one tadaa
                        const userCode = [...inputs].map((input) => input.value).join("");
                        // codeBlock.classList.remove("hidden");
                        // code.innerText = userCode;
                    } else {
                        inputs[key + 1].focus();
                    }
                }
            });
        });
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
                        sendCode('next')
                    } else if (currentTab === 1) {
                        confirmCode()
                    }
                    // proceedToNextTab()
                });

                $('#resend-btn').on('click', function() {
                    sendCode('resend')
                })

                function proceedToNextTab() {
                    tabSteps.eq(currentTab).hide();
                    currentTab = currentTab + 1;
                    if (currentTab >= tabSteps.length) {
                        form.submit();
                        return false;
                    }
                    showTab(currentTab);
                }

                // Set the initial time
                var timeInSeconds = 0;

                function showTimer() {
                    timeInSeconds = 59

                    // Display the initial time
                    updateTimeDisplay();

                    // Update the time every second
                    var timerInterval = setInterval(function() {
                        timeInSeconds--;

                        // Check if the timer has reached 0
                        if (timeInSeconds <= 0) {
                            clearInterval(timerInterval); // Stop the timer
                            $('#timer').addClass(
                                'd-none'); // Update the message
                            $('#resend-btn').attr('disabled', false)
                            $('#resend-btn').removeClass('disabled')

                        } else {
                            updateTimeDisplay(); // Update the displayed time
                        }
                    }, 1000);
                }

                // Function to update the displayed time
                function updateTimeDisplay() {
                    var minutes = Math.floor(timeInSeconds / 60);
                    var seconds = timeInSeconds % 60;

                    // Add leading zeros if needed
                    var formattedTime = ('0' + minutes).slice(-2) + ':' + ('0' +
                        seconds).slice(-2);

                    // Update the span content
                    $('#time').text(formattedTime);
                }

                function sendCode(type) {
                    $('#wait-msg').removeClass('d-none')
                    $('#wait-msg small').text('Please wait while we send the confirmation code...')
                    $.ajax({
                        url: '{{ route('staff.sendCode') }}',
                        success: function() {
                            $('#wait-msg').addClass('d-none')
                            if (type === 'next') {
                                proceedToNextTab()
                                showTimer()
                            } else {
                                $('#wait-msg small').removeClass('text-danger')
                                $('#wait-msg small').addClass('text-success')
                                $('#wait-msg small').text('Code has been resent')
                                $('#wait-msg').removeClass('d-none')

                                setTimeout(function() {
                                    $('#wait-msg').addClass('d-none');
                                    $('#wait-msg small').removeClass('text-success')
                                    $('#wait-msg small').addClass('text-danger')
                                }, 5000);

                                $('#timer').removeClass('d-none'); // Update the message
                                $('#resend-btn').attr('disabled', true)
                                $('#resend-btn').addClass('disabled')
                                showTimer()
                            }
                        }
                    })
                }

                function confirmCode() {
                    var code = "";
                    var empty = false;
                    $('.confirmation-tab input').each(function() {
                        if ($(this).val() === "") {
                            $(this).addClass('is-invalid')
                            empty = true;
                            $('#wait-msg').removeClass('d-none')
                            $('#wait-msg small').text("Please insert the full code!")
                        } else {
                            $(this).removeClass('is-invalid')
                            code += $(this).val();
                        }
                    })

                    if (!empty) {
                        $('#wait-msg').removeClass('d-none')
                        $('#wait-msg small').text('Please wait while we confirm the code...')
                        $.ajax({
                            url: '{{ route('staff.confirmCode') }}',
                            type: 'POST',
                            data: {
                                '_token': '{{ csrf_token() }}',
                                code
                            },
                            success: function(response) {
                                $('#wait-msg').addClass('d-none')
                                if (response.error) {
                                    $('#wait-msg').removeClass('d-none')
                                    $('#wait-msg small').text(response.error)
                                } else {
                                    proceedToNextTab()
                                }
                            }
                        })
                    }
                }
            });
        });
    </script>
@endsection
@endsection
