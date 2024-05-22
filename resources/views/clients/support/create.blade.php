@extends('layouts.client')

@section('styles')
    <link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css" />
@endsection

@section('content')
    <main class="content ">
        <div class="container-fluid px-lg-0">
            <div class="row justify-content-center">
                <div class="col-xl-12 ">
                    <div class="row">

                        <div class="col-xl-4 col-md-6 mb-3">
                            <div class="box selected-ticket-type hover-ticket position-relative"
                                style="border: 2px solid #0963ce">
                                <input type="radio" name="ticket-type" id="" value="0" class="box-radio"
                                    checked>
                                <div class="d-flex align-items-center">
                                    <div class=" flex-grow-1  box-text d-flex align-items-center">
                                        <h1 class="w-600 f-16 mb-0 pb-0 box-heading">General </h1>
                                    </div>
                                    <div class="box-icon blue-icon">
                                        <i class="fa-solid fa-ticket"></i>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 mb-3">
                            <div class="box hover-ticket position-relative">
                                <input type="radio" name="ticket-type" id="" value="1" class="box-radio">
                                <div class="d-flex align-items-center">
                                    <div class=" flex-grow-1  box-text d-flex align-items-center">

                                        <h1 class="w-600 f-16 mb-0 pb-0 box-heading">Sales/Billings</h1>

                                    </div>
                                    <div class="box-icon yellow-icon">
                                        <i class="fa-regular fa-money-bill-transfer"></i>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 mb-3">
                            <div class="box hover-ticket position-relative">
                                <input type="radio" name="ticket-type" id="" value="2" class="box-radio">
                                <div class="d-flex align-items-center">
                                    <div class=" flex-grow-1  box-text d-flex align-items-center">
                                        <h1 class="w-600 f-16 mb-0 pb-0 box-heading">Technical</h1>
                                    </div>
                                    <div class="box-icon green-icon">
                                        <i class="fa-solid fa-laptop-mobile"></i>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 h-100">
                            <div class="box mb-3 box-p">
                                <div class="flex-grow-1">
                                    <div class=" mb-3">
                                        <h1 class="f-20 w-500 mb-0 pb-0 text-dark-clr "><span
                                                class="selected-heading">General</span> Request</h1>
                                        <p class="f-14 w-400 text mt-2" style="color: #b3b2b4;"></p>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control crm-input" id="subject"
                                                    placeholder="Mickel">
                                                <label class="crm-label form-label" for="subject">Subject<span
                                                        class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-floating">
                                                <select class="form-select crm-input" id="select-status"
                                                    aria-label="Floating label select example">
                                                    <option value="select">Select </option>
                                                    <option value="2">High
                                                    </option>
                                                    <option value="1">
                                                        Medium</option>
                                                    <option value="0">Low
                                                    </option>

                                                </select>
                                                <label class="crm-label form-label" for="select-status">Priority<span
                                                        class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mt-4 ">
                                            <label class="crm-label form-label px-lg-3 px-2"
                                                for="select-status">Description<span class="text-danger">*</span></label>
                                            <textarea name="" id="description" rows="3" class="px-lg-3 crm-input" style="width: 100%; outline: none;"></textarea>
                                        </div>
                                        <div class="col-lg-12">
                                            <button class="upload-attchment attachment-btn mt-2 d-block d-none">
                                                <i class="bi bi-plus-circle-fill"></i>
                                                Click to Upload
                                                Attachment</button>
                                            <div class="upload-area mt-4 " style="display: block">
                                                <p class="f-14 w-600 text-dark-clr ">Upload Attachments <span
                                                        class="text-gray f-12">(Optional)</span></p>
                                                <div id="dropzone">
                                                    <form method="post"
                                                        action="{{ route('client.support.upload_attachment') }}"
                                                        class="dropzone needsclick" id="dropzonewidget"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="dz-message needsclick">
                                                            <span class="text text-dark-clr">

                                                                Drop files here or click to upload.
                                                            </span>
                                                            <span class="plus">+</span>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="d-flex justify-content-end mt-4 mb-3">
                                                <button type="button" class="modal-btn-save"
                                                    id="submitBtn">Submit</button>
                                            </div>
                                        </div>
                                        <!-- <h1 class="f-20 w-500 mb-0 pb-0 text-dark-clr">This is Our General Technical Support queu/category</h1> -->
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </main>

    @php
        $priority_colors = ['#398bf7', '#f9a400', '#e72f55'];
    @endphp

@section('script')
    <script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
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
            const boxes = document.querySelectorAll(".hover-ticket");
            const radioInputs = document.querySelectorAll(".box-radio");
            const h2Element = document.querySelector(".selected-heading");

            boxes.forEach((box, index) => {
                if (index > 0) {
                    box.style.border = "none"
                }
                box.addEventListener("click", function() {
                    $(".hover-ticket").css("border", "none")
                    box.style.border = "2px solid #0963ce"
                    // Remove the class from all boxes
                    boxes.forEach(b => {
                        b.classList.remove("selected-ticket-type");
                    });

                    // Add the class to the clicked box
                    this.classList.add("selected-ticket-type");

                    // Check the corresponding radio input
                    radioInputs[index].checked = true;

                    // Get the text from the h1 element
                    const h1Text = this.querySelector(".box-text h1").textContent;

                    // Update the content of the h2 element
                    h2Element.textContent = h1Text;
                });
            });
        });
    </script>
    <script>
        // Wait for the document to be fully loaded
        document.addEventListener("DOMContentLoaded", function() {
            var attachmentBtn = document.querySelector(".attachment-btn");
            var attchmentArea = document.querySelector(".upload-area");

            attachmentBtn.addEventListener("click", function() {

                if (attchmentArea.style.display === "none" || attchmentArea.style.display === "") {
                    attchmentArea.style.display = "block";
                    this.style.display = " none"
                }
            })
        });
    </script>

    <script>
        var myDropzone;
        var ticketID;
        var allowedFileTypes = ["image/jpeg", "image/jpg", "image/png", "application/pdf", "text/plain"];
        Dropzone.options.dropzonewidget = {
            autoProcessQueue: false,
            addRemoveLinks: true,
            maxFilesize: 2, // 2 MB
            acceptedFiles: ".jpeg,.jpg,.png,.pdf,.txt", // Allowed extensions
            init: function() {
                myDropzone = this;
                var fileValidity = {};

                // Check for errors
                this.on("addedfile", function(file) {
                    fileValidity[file.name] = true;

                    if (file.size > myDropzone.options.maxFilesize * 1024 * 1024) {
                        alert("File size exceeds the limit");
                        myDropzone.removeFile(file);
                        fileValidity[file.name] = false;
                        return;
                    }

                    console.log(file.type);
                    if (!allowedFileTypes.includes(file.type)) {
                        alert("Invalid file type");
                        myDropzone.removeFile(file);
                        fileValidity[file.name] = false;
                        return;
                    }

                });

                this.on('sending', function(file, xhr, formData) {
                    formData.append('ticketID', ticketID)

                    // Append all form inputs to the formData Dropzone will POST
                    var data = $('#dropzonewidget').serializeArray();
                    $.each(data, function(key, el) {
                        formData.append(el.name, el.value);
                    });
                });

                this.on("queuecomplete", function(file) {
                    var allFilesValid = Object.values(fileValidity).every(function(valid) {
                        return valid;
                    });

                    if (allFilesValid) {
                        $(".loading").addClass("d-none")
                        window.location.href = '{{ route('client.support.index') }}';
                    }

                    fileValidity = {};
                });
            },
            success: function(file, response) { // Dropzone upload response
                console.log(response);
            }
        };

        $("#submitBtn").click(function(e) {
            e.preventDefault();
            saveData()
        });

        // Save editor data
        const saveData = function() {
            $(".loading").removeClass("d-none")
            var department = $('input[name="ticket-type"]:checked').val()
            var subject = $('#subject').val()
            var description = $('#description').val()
            var priority = $('#select-status').val()

            if (subject.trim() == "" || description.trim() == "") {
                alert("Please fill the required fields!");
                return;
            }

            if (priority == 'select') {
                alert("Please select priority!");
                return;
            }

            $.ajax({
                url: '{{ route('client.support.store') }}',
                type: 'post',
                data: {
                    '_token': '{{ csrf_token() }}',
                    subject,
                    description,
                    priority,
                    department
                },
                success: function(response) {
                    if (response.status == 'success') {
                        ticketID = response.ticket.id;

                        if (myDropzone.files.length > 0) {
                            console.log("Processing queue");
                            myDropzone.processQueue();
                        } else {
                            $(".loading").addClass("d-none")
                            window.location.href = '{{ route('client.support.index') }}';
                        }
                    }
                    // location.reload()
                }

            })
        }
    </script>
@endsection
@endsection
