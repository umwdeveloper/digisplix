@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css" />
@endsection

@section('content')
    <main class="content ">
        <div class="container-fluid px-lg-0" style="position: relative;">
            <div class="row justify-content-center" style="position: relative;">
                <div class="col-xl-12 " style="position: relative;">
                    <div class="row " style="position: relative;">
                        <div class="col-xl-4 col-md-4 mb-3 order-md-2 order-1 " style="height: 500px;">
                            <div class="box ticket-info-div">
                                @php
                                    use App\Models\Support;
                                    $ticketStatusClasses = [
                                        Support::OPEN => 'ticket-open',
                                        Support::AWAITING_USER_RESPONSE => 'ticket-waiting',
                                        Support::USER_REPLIED => 'ticket-replied',
                                        Support::CLOSED => 'ticket-completed',
                                    ];

                                    $ticketPriorityClasses = ['priority-low', 'priority-medium', 'priority-high'];
                                    $ticketPriority = ['Low', 'Medium', 'High'];
                                @endphp
                                <div class="ticket-info ">
                                    <div class="ticket-info--header  ">
                                        <div class="box-icon ticket-info-icon" style="flex-shrink: 0;">
                                            <i class="fa-solid fa-ticket"></i>
                                        </div>
                                        <div class="text-center b w-100">
                                            Ticket Information
                                        </div>
                                    </div>
                                    <div class="ticket-info--body">
                                        <div class="mt-3 ">
                                            <h3 class="ticket-heading mb-0">SUBJECT</h3>
                                            <p class="ticket-text mb-0 pb-2">
                                                {{ $ticket->subject }}
                                            </p>
                                            <div class="{{ $ticketStatusClasses[$ticket->status] }}">
                                                {{ $status_labels[$ticket->status] }}</div>
                                        </div>
                                        <div class="mt-3 pt-2">
                                            <h3 class="ticket-heading mb-0">Email</h3>
                                            <p class="ticket-text mb-0 pb-2">
                                                {{ $ticket->user->email }}
                                            </p>
                                        </div>
                                        <div
                                            class="d-flex align-items-start justify-content-between flex-xl-row flex-column">
                                            <div class="mt-3">
                                                <h3 class="ticket-heading mb-0">Submitted</h3>
                                                <p class="ticket-text mb-0 pb-2">
                                                    {{ $ticket->created_at->format('M j, Y h:iA') }}
                                                </p>
                                            </div>
                                            <div class="mt-3">
                                                <h3 class="ticket-heading mb-0">Last Updated</h3>
                                                <p class="ticket-text mb-0 pb-2">
                                                    {{ \Carbon\Carbon::parse($ticket->updated_at)->diffForHumans() }}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center mt-3">
                                            <button class="ticket-fill me-1 reply-btn2">Reply</button>
                                            @if ($ticket->status !== Support::CLOSED)
                                                <form action="{{ route('staff.support.update_status', $ticket->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('patch')
                                                    <input type="hidden" value="{{ Support::CLOSED }}" name="status">
                                                    <button class="ticket-blank ms-1">Close</button>
                                                </form>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <h1 class="heading-ticket">
                                {{ $ticket->subject }}
                            </h1>
                        </div>
                        <div class="col-xl-8 col-md-8 mb-3 order-md-1 order-2">
                            <div class="box">
                                <div class="ticket-chat">
                                    <div class="title">
                                        <div class="title-icon">
                                            <div class="title-icon-dot"></div>
                                        </div>
                                        <p class="mb-0 pb-0">Ticket Submitted on
                                            {{ $ticket->created_at->format('M j, Y h:iA') }}</p>
                                    </div>

                                    <div class="ticket-user w-100 mb-4">
                                        <div class="ticket-user-icon">
                                            <i class="bi bi-person-circle"></i>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center w-100">
                                            <div class="d-flex align-items-center ticket-text">
                                                <div class="user-logo me-2">
                                                    <img src="{{ !empty($ticket->user->img) ? getURL($ticket->user->img) : asset('images/avatar.png') }}"
                                                        alt="" class="">
                                                </div>
                                                {{ $ticket->user->name }}
                                            </div>

                                            <div class="ticket-heading">
                                                {{ $ticket->created_at->format('d/m/Y h:iA') }}
                                            </div>
                                        </div>
                                        <div class="ticket-detail-text">
                                            <p class="my-1">
                                                {!! $ticket->description !!}
                                            </p>
                                            @if ($ticket->attachments->count() > 0)
                                                <p class="my-1">
                                                    Attachments:
                                                </p>

                                                @foreach ($ticket->attachments as $index => $attachment)
                                                    <div class="screenshot my-1">
                                                        <a href="{{ getURL($attachment->attachment) }}" target="_blank">
                                                            Attachment {{ $index + 1 }}
                                                            <i class="fa-regular fa-arrow-up-right-from-square"></i></a>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>

                                    @foreach ($ticket->replies as $reply)
                                        <div class="ticket-user w-100 mb-4">
                                            <div class="ticket-user-icon">
                                                <i class="bi bi-person-circle"></i>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center w-100">
                                                <div class="d-flex align-items-center ticket-text">
                                                    <div class="user-logo me-2">
                                                        @if ($reply->user->userable_type == App\Models\Staff::class)
                                                            <img src="{{ asset('images/d-png.png') }}" alt=""
                                                                class="">
                                                        @else
                                                            <img src="{{ !empty($reply->user->img) ? getURL($reply->user->img) : asset('images/avatar.png') }}"
                                                                alt="" class="">
                                                        @endif
                                                    </div>
                                                    {{ $reply->user->userable_type == App\Models\Staff::class ? 'Support | DigiSplix' : $reply->user->name }}
                                                </div>

                                                <div class="ticket-heading">
                                                    {{ $reply->created_at->format('d/m/Y h:iA') }}
                                                </div>
                                            </div>
                                            <div class="ticket-detail-text">
                                                <p class="my-1">
                                                    {!! $reply->reply !!}
                                                </p>

                                                @if ($reply->attachments->count() > 0)
                                                    <p class="my-1">
                                                        Attachments:
                                                    </p>

                                                    @foreach ($reply->attachments as $index => $attachment)
                                                        <div class="screenshot my-1">
                                                            <a href="{{ getURL($attachment->attachment) }}"
                                                                target="_blank">
                                                                Attachment {{ $index + 1 }}
                                                                <i class="fa-regular fa-arrow-up-right-from-square"></i></a>
                                                        </div>
                                                    @endforeach
                                                @endif

                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="reply-area" id="reply-area">
                                        <p class="f-14 w-600 text-dark-clr">Type Reply </p>
                                        <div class=" mt-3 text-left">
                                            <div id="toolbar-container"></div>
                                            <div id="editor">
                                                <p></p>
                                            </div>
                                            <!-- cdk Editor for form -->
                                        </div>
                                        <button class="upload-attchment attachment-btn mt-2">Click to Upload
                                            Attachment</button>
                                        <div class="upload-area mt-4">
                                            <p class="f-14 w-600 text-dark-clr">Upload Attachments <span
                                                    class="text-gray f-12">(Optional)</span></p>
                                            <div id="dropzone">
                                                <form method="post"
                                                    action="{{ route('staff.support.upload_attachment') }}"
                                                    class="dropzone needsclick" id="dropzonewidget"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="dz-message needsclick">
                                                        <span class="text text-dark-clr">

                                                            Drop files here or click to upload.
                                                        </span>
                                                        <span class="plus">+</span>
                                                    </div>
                                                    <input type="hidden" id="editorData">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end mt-3">
                                        <button id="replyBtn" class="ticket-fill me-1 flex-grow-0 px-4 reply-btn"
                                            style="width: fit-content !important;">Reply</button>
                                        <button id="submitBtn" style="display: none"
                                            class="ticket-fill me-1 flex-grow-0 px-4 reply-btn"
                                            style="width: fit-content !important;">Submit</button>
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

@section('script')
    <script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/decoupled-document/ckeditor.js"></script>
    <script>
        // for editor
        let editor2;
        DecoupledEditor
            .create(document.querySelector('#editor'), {
                toolbar: {
                    items: [
                        'heading',
                        '|',
                        'bold',
                        'italic',
                        '|',
                        'link',
                        'bulletedList',
                        'numberedList',
                        '|',
                        'undo',
                        'redo',
                        '|',
                        'alignment:left',
                        'alignment:center',
                        'alignment:right',
                        'alignment:justify',
                    ]
                },
            })
            .then(editor => {
                editor2 = editor;
                const toolbarContainer = document.querySelector('#toolbar-container');

                toolbarContainer.appendChild(editor.ui.view.toolbar.element);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        // Wait for the document to be fully loaded
        document.addEventListener("DOMContentLoaded", function() {
            // Get references to the elements
            var replyArea = document.querySelector(".reply-area");
            var replyButton = document.querySelector(".reply-btn");
            var replyButton2 = document.querySelector(".reply-btn2");
            var submitBtn = document.querySelector("#submitBtn");
            // Add a click event listener to the reply button
            replyButton.addEventListener("click", function(e) {
                e.stopPropagation();
                // Toggle the visibility of the reply area
                if (replyArea.style.display === "none" || replyArea.style.display === "") {
                    replyArea.style.display = "block";
                }
                replyButton.style.display = 'none'
                submitBtn.style.display = 'block'
            });
            replyButton2.addEventListener("click", function(e) {
                e.stopPropagation();
                // Toggle the visibility of the reply area
                if (replyArea.style.display === "none" || replyArea.style.display === "") {
                    replyArea.style.display = "block";
                    window.scrollTo({
                        top: replyArea.offsetTop,
                        behavior: "smooth"
                    });
                } else {
                    window.scrollTo({
                        top: replyArea.offsetTop,
                        behavior: "smooth"
                    });
                }
                replyButton.style.display = 'none'
                submitBtn.style.display = 'block'
            });

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
        var replyID;
        var myDropzone;
        var editorData;
        var allowedFileTypes = ["image/jpeg", "image/jpg", "image/png", "application/pdf", "text/plain"];
        Dropzone.options.dropzonewidget = {
            dictCancelUpload: '',
            autoProcessQueue: false,
            addRemoveLinks: true,
            maxFilesize: 2, // 2 MB
            acceptedFiles: ".jpeg,.jpg,.png,.pdf,.txt", // Allowed extensions
            init: function() {
                myDropzone = this;

                // Check for errors
                this.on("addedfile", function(file) {
                    if (file.size > myDropzone.options.maxFilesize * 1024 * 1024) {
                        alert("File size exceeds the limit");
                        myDropzone.removeFile(file);
                        return;
                    }

                    console.log(file.type);
                    if (!allowedFileTypes.includes(file.type)) {
                        alert("Invalid file type");
                        myDropzone.removeFile(file);
                        return;
                    }

                });

                this.on('sending', function(file, xhr, formData) {
                    formData.append('replyID', replyID)

                    // Append all form inputs to the formData Dropzone will POST
                    var data = $('#dropzonewidget').serializeArray();
                    $.each(data, function(key, el) {
                        formData.append(el.name, el.value);
                    });
                });

                this.on("queuecomplete", function(file) {
                    // saveEditorData()
                    location.reload()
                });
            },
            success: function(file, response) { // Dropzone upload response
                console.log(response);
            }
        };

        $("#submitBtn").click(function(e) {
            e.preventDefault();
            editorData = editor2.getData()

            if (editorData.trim() == "") {
                alert("Please write something in the editor!")
                return false;
            }

            $("#editorData").val(editorData)
            saveEditorData()
        });

        // Save editor data
        const saveEditorData = function() {
            var editorData = $("#editorData").val()
            $.ajax({
                url: '{{ route('staff.support.store_reply') }}',
                type: 'post',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'reply': editorData,
                    'support_id': '{{ $ticket->id }}',
                    'user_id': '{{ auth()->user()->id }}'
                },
                success: function(response) {
                    if (response.status == 'success') {
                        replyID = response.reply.id;

                        if ($('.upload-area').css('display') == 'block') {
                            myDropzone.processQueue();
                        } else {
                            location.reload()
                        }
                    }
                    // location.reload()
                }
            })
        }
    </script>
@endsection
@endsection
