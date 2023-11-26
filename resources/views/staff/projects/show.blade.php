@extends('layouts.app')

@section('content')
    <main class="content ">
        <div class="container-fluid px-lg-0">
            <div class="row justify-content-center">
                <div class="col-xl-12 ">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="box-white">
                                <div class="tabProjects">
                                    <button class="tablinksProjects" id="defaultOpen"
                                        onclick="openCity(event, 'ProjectOverview')"><span>Project</span>
                                        Overview</button>
                                    <button class="tablinksProjects"
                                        onclick="openCity(event, 'ProjectDetails')"><span>Project</span>
                                        Details</button>
                                    <button class="tablinksProjects" onclick="openCity(event, 'Chat')">Chat</button>
                                </div>

                                <div id="ProjectOverview" class="tabcontentProjects">
                                    <div class="row ">
                                        <div class="col-lg-4 mb-3">
                                            <div class="form-floating ">
                                                <input type="text" class="form-control crm-input" id="name"
                                                    placeholder="Mickel" value="{{ $project->client->user->name }}"
                                                    readonly>
                                                <label class="crm-label form-label" for="name">Client Name<span
                                                        class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <div class="form-floating ">
                                                <input type="text" class="form-control crm-input" id="name" readonly
                                                    placeholder="Mickel" value="{{ $project->client->business_name }}">
                                                <label class="crm-label form-label" for="name">Business Name<span
                                                        class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <div class="form-floating ">
                                                <input type="text" class="form-control crm-input" id="name" readonly
                                                    placeholder="Mickel" value="{{ $project->name }}">
                                                <label class="crm-label form-label" for="name">Project Name<span
                                                        class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-xl-3 col-lg-6 col-md-6 order-xl-1 order-1 mb-3">
                                            <div
                                                class="box-gray d-flex flex-column justify-content-center align-items-center">
                                                <div class="caption mb-3">Overall Progress</div>
                                                <div class="progresshalf">
                                                    <div class="barOverflow">
                                                        <div class="bar"></div>
                                                    </div>
                                                    <span>{{ $project->progress }}</span>%
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-12  order-xl-2 order-3 mb-3">
                                            <div class="box-gray">
                                                <div class="d-flex align-items-center justify-content-between mb-2">
                                                    @php
                                                        $phasesCount = 0;
                                                        $phasesProgress = 0;
                                                    @endphp
                                                    @foreach ($project->phases as $phase)
                                                        @php
                                                            $phasesCount++;
                                                            $phasesProgress += $phase->progress;
                                                        @endphp
                                                        @if ($phase->status == 1)
                                                            <div class="step-count">
                                                                <div class="caption-step">{{ $phase->name }}</div>
                                                                <i
                                                                    class="fa-duotone fa-octagon-check my-3 complete-step"></i>
                                                                <div class="caption-step complete-step">Completed</div>
                                                            </div>
                                                        @elseif ($phase->progress == 0)
                                                            <div class="step-count">
                                                                <div class="caption-step">{{ $phase->name }}</div>
                                                                <i class="fa-duotone fa-clock-three my-3"></i>
                                                                <div class="caption-step">Waiting</div>
                                                            </div>
                                                        @else
                                                            <div class="step-count">
                                                                <div class="caption-step">{{ $phase->name }}</div>

                                                                <div class="progress-step-div">
                                                                    <div class="progress-bar-container">
                                                                        <div class="progress-bar html my-2">
                                                                            <progress id="html" min="0"
                                                                                max="100"
                                                                                value="{{ $phase->progress }}"></progress>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="caption-step in-progress-step">In Progress</div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                                @php
                                                    $progressWidth = round($phasesProgress / $phasesCount);
                                                @endphp
                                                <div class="progress-stripped progress-striped">
                                                    <div class="progress-bar" width="{{ $progressWidth }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-md-6 order-xl-3 order-2 mb-3">
                                            <div
                                                class="box-gray d-flex flex-column justify-content-center align-items-center">
                                                <div class="caption mb-3">Project Launch Date</div>
                                                <div class="d-flex align-items-center">
                                                    <img src="assets/images/31279_launch_rocket_spaceship_icon.png"
                                                        alt="" class="img-fluid launch-img me-3">
                                                    <div>
                                                        <h3 class="f-30 w-500 text-primary mb-0 pb-0">
                                                            @php
                                                                // use Carbon\Carbon;
                                                                $daysPassed = $project->created_at->startOfDay()->diffInDays(now()->startOfDay());
                                                            @endphp
                                                            {{ $daysPassed }}
                                                        </h3>
                                                        <span class="f-14 text-gray text-dark-clr">
                                                            {{ $daysPassed > 1 || $daysPassed == 0 ? 'days' : 'day' }}</span>
                                                    </div>
                                                </div>
                                                <p class="mb-0 pb-0 f-14 text-gray w-400 mt-3 text-dark-clr">
                                                    {{ $project->created_at->format('d F, Y') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center accordion" id="accordionExample">
                                        @foreach ($project->phases as $phase)
                                            <div class="col-xl-6 col-lg-6 mb-3 col-md-6">
                                                <div>
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingOne">
                                                            <button class="accordion-button" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                                aria-expanded="true" aria-controls="collapseOne">
                                                                <div
                                                                    class="task-card--header text-md-center text-start justify-content-md-center justify-content-start">
                                                                    {{ $phase->name }}
                                                                </div>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseOne" class="accordion-collapse collapse show"
                                                            aria-labelledby="headingOne"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body task-card--body">
                                                                @foreach ($phase->tasks as $index => $task)
                                                                    <div
                                                                        class="d-flex justify-content-between align-items-start">
                                                                        <div class="d-flex">
                                                                            <span
                                                                                class="me-2">{{ $index + 1 }}.</span>
                                                                            <p class="mb-2 pb-0">{{ $task->task }}</p>
                                                                        </div>
                                                                        <i
                                                                            class="bi bi-check-circle{{ $task->status == 1 ? '-fill' : '' }} ms-2 {{ $task->status == 1 ? 'complete-step' : '' }}"></i>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div id="ProjectDetails" class="tabcontentProjects">
                                    <div class="row ">
                                        <div class="col-lg-4 mb-3">
                                            <div class="form-floating ">
                                                <input type="text" class="form-control crm-input" id="P-name"
                                                    placeholder="Mickel" value="{{ $project->name }}">
                                                <label class="crm-label form-label" for="P-name">Project Name<span
                                                        class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <div class="form-floating ">
                                                <input type="date" class="form-control crm-input" id="deadline"
                                                    placeholder="Mickel" value="{{ $project->deadline }}">
                                                <label class="crm-label form-label" for="deadline">Deadline<span
                                                        class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <div class="form-floating ">
                                                <input type="text" class="form-control crm-input"
                                                    id="overall-progress" placeholder="Mickel"
                                                    value="{{ $project->progress }}">
                                                <label class="crm-label form-label" for="overall-progress">Overall
                                                    progress<span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <input type="hidden" id="client_id" value="{{ $project->client->id }}">
                                        <input type="hidden" id="description" value="{{ $project->description }}">
                                    </div>

                                    <div class="row justify-content-center icon-container">
                                        @foreach ($project->phases as $phase)
                                            <div class="col-xl-6 col-lg-6 mb-3 col-sm-6">
                                                <div class="task-card">
                                                    <div class="task-card--header">
                                                        <p class="mb-0 pb-0 edit-able"
                                                            data-phase-id="{{ $phase->id }}" contenteditable="false">
                                                            {{ $phase->name }}
                                                        </p>
                                                        <div class="edit">
                                                            <i class="bi bi-pencil-fill"></i>
                                                        </div>
                                                    </div>
                                                    <div class="task-card--body tasks-container"
                                                        data-phase-id="{{ $phase->id }}">
                                                        @foreach ($phase->tasks as $index => $task)
                                                            <div data-task-id="{{ $task->id }}"
                                                                class="d-flex justify-content-between align-items-start task-div">
                                                                <div class="d-flex">
                                                                    <span class="me-2">{{ $index + 1 }}.</span>
                                                                    <p class="mb-2 pb-0 edit-able-task"
                                                                        contenteditable="false">
                                                                        {{ $task->task }}</p>
                                                                </div>
                                                                <div class="d-flex">
                                                                    <i
                                                                        class="task-status bi bi-check-circle{{ $task->status == 1 ? '-fill' : '' }} ms-2 {{ $task->status == 1 ? 'complete-step' : '' }}"></i>
                                                                    <div class="edit-task ms-2">
                                                                        <i class="bi bi-pencil-fill"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="task-card--footer">
                                                        <button class="table-btn w-100 mt-3 addPhase-btn" type="button"
                                                            data-phase-id="{{ $phase->id }}" data-bs-toggle="modal"
                                                            data-bs-target="#taskModal">Add New
                                                            Task</button>

                                                        <div class="mb-3 d-flex align-items-center mt-3">
                                                            <input type="text" class="score"
                                                                value="{{ $phase->progress }}%">
                                                            <button
                                                                class="table-btn-blank{{ $phase->status == 1 ? '-completed' : '' }} w-100  ms-3 phase-complete">{{ $phase->status == 1 ? 'Completed' : 'Mark As Completed' }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        {{-- <button class="table-btn">Edit</button> --}}
                                        <button class="table-btn ms-2" id="save-data-btn">Save</button>
                                    </div>
                                </div>

                                <div id="Chat" class="tabcontentProjects">

                                    <div class="chat__screen box p-0">

                                        <!-- chat body -->
                                        <div class="chat__screen-chats chat__screen-body chats-msgs d-block">
                                            <div class="chat__screen-chats--header mb-0">
                                                <div class="d-flex justify-content-between w-100 align-items-center">
                                                    <div class="d-flex align-items-center open-chat-header">
                                                        <div class="go-back">
                                                            <i class="bi bi-arrow-left-short text-primary f-36 me-1"></i>
                                                        </div>
                                                        <div class="open-chat-header-img ">
                                                            <img src="assets/images/vatar.png" alt="">
                                                        </div>
                                                        <div class="open-chat-header-text ms-2 ps-1">
                                                            <div class=" ">
                                                                <h2 class="mb-0 pb-0 mt-2">Jhon Doe</h2>
                                                                <span class="f-12 text-success mb-0 pb-0">Active</span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <i class="fa-solid fa-circle-check f-30 text-success"></i>
                                                        <i class="fa-solid fa-file-lines text-gray f-26 ms-3 text-dark-clr"
                                                            id="documents-btn"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="chat__screen-chats-wrapper " style="overflow-y: hidden;">
                                                <div class="chat__screen-chats-wrapper--body chat__screen-body-msgs">
                                                    <div class="chat-date mt-2">
                                                        Wednesday, February 5th
                                                    </div>
                                                    <!-- msg recived -->
                                                    <div class="recieved-msg">
                                                        <div class="recieved-msg-data">
                                                            <img src="assets/images/vatar.png" alt=""
                                                                class="recieved-msg-data-img">
                                                            <h2 class="mb-0 pb-0 ms-2">Jhon Doe</h2>
                                                            <span class="ms-2">3:21 PM</span>
                                                        </div>
                                                        <div class="recieved-msg-text">
                                                            <p class="mb-0 pb-0">
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing
                                                                elit, sed do
                                                                eiusmod
                                                                tempor incididunt ut labore et dolore magna aliqua.
                                                                Ut enim ad minim
                                                                veniam,
                                                                quis.
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <!-- msg sent -->
                                                    <div class="sent-msg">
                                                        <div class="sent-msg-data">
                                                            <img src="assets/images/vatar.png" alt=""
                                                                class="sent-msg-data-img">
                                                            <h2 class="mb-0 pb-0 ms-2">AB Divilar</h2>
                                                            <span class="ms-2">3:21 PM</span>
                                                        </div>
                                                        <div class="sent-msg-text">
                                                            <p class="mb-0 pb-0">
                                                                Hello!<br>
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing
                                                                elit, sed do
                                                                eiusmod
                                                                tempor incididunt ut labore et dolore magna aliqua.
                                                                Ut enim ad minim
                                                                veniam,
                                                                quis.
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <!-- msg recived -->
                                                    <div class="recieved-msg">
                                                        <div class="recieved-msg-data">
                                                            <img src="assets/images/vatar.png" alt=""
                                                                class="recieved-msg-data-img">
                                                            <h2 class="mb-0 pb-0 ms-2">Jhon Doe</h2>
                                                            <span class="ms-2">3:21 PM</span>
                                                        </div>
                                                        <div class="recieved-msg-text">
                                                            <p class="mb-0 pb-0">
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing
                                                                elit.
                                                            </p>
                                                        </div>
                                                        <div class="recieved-msg-text">
                                                            <p class="mb-0 pb-0">
                                                                Lorem ipsum dolor sit.
                                                            </p>
                                                        </div>
                                                        <div class="recieved-msg-text">
                                                            <p class="mb-0 pb-0">
                                                                Lorem ipsum dolor sit amet consectetur adipisicing
                                                                elit. Dolorem
                                                                itaque
                                                                voluptatem incidunt similique tempore sit commodi
                                                                nemo? Eaque, non
                                                                nulla!
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <!-- msg recived -->
                                                    <div class="recieved-msg">
                                                        <div class="recieved-msg-data">
                                                            <img src="assets/images/vatar.png" alt=""
                                                                class="recieved-msg-data-img">
                                                            <h2 class="mb-0 pb-0 ms-2">Jhon Doe</h2>
                                                            <span class="ms-2">3:21 PM</span>
                                                        </div>

                                                        <div class="recieved-msg-text">
                                                            <img src="assets/images/6.jpg" alt="">
                                                        </div>
                                                    </div>
                                                    <!-- date -->
                                                    <div class="chat-date mt-4">
                                                        Wednesday, February 5th
                                                    </div>
                                                    <!-- msg sent -->
                                                    <div class="sent-msg">
                                                        <div class="sent-msg-data">
                                                            <img src="assets/images/vatar.png" alt=""
                                                                class="sent-msg-data-img">
                                                            <h2 class="mb-0 pb-0 ms-2">AB Divilar</h2>
                                                            <span class="ms-2">3:21 PM</span>
                                                        </div>
                                                        <div class="sent-msg-text">
                                                            <p class="mb-0 pb-0">
                                                            <div class="recieved-msg-text">
                                                                <img src="assets/images/2.jpg" alt="">
                                                            </div>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <!-- msg recived -->
                                                    <div class="recieved-msg">
                                                        <div class="recieved-msg-data">
                                                            <img src="assets/images/vatar.png" alt=""
                                                                class="recieved-msg-data-img">
                                                            <h2 class="mb-0 pb-0 ms-2">Jhon Doe</h2>
                                                            <span class="ms-2">3:21 PM</span>
                                                        </div>
                                                        <div class="recieved-msg-text">
                                                            <p class="mb-0 pb-0">
                                                                OK
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <!-- msg sent -->
                                                    <div class="sent-msg">
                                                        <div class="sent-msg-data">
                                                            <img src="assets/images/vatar.png" alt=""
                                                                class="sent-msg-data-img">
                                                            <h2 class="mb-0 pb-0 ms-2">AB Divilar</h2>
                                                            <span class="ms-2">3:21 PM</span>
                                                        </div>
                                                        <div class="sent-msg-text">
                                                            <div class="recieved-msg-text">
                                                                <video controls>
                                                                    <source src="assets/images/big_buck_bunny_720p_1mb.mp4"
                                                                        type="video/mp4">
                                                                    Your browser does not support the video tag.
                                                                </video>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- msg recived -->
                                                    <div class="recieved-msg">
                                                        <div class="recieved-msg-data">
                                                            <img src="assets/images/vatar.png" alt=""
                                                                class="recieved-msg-data-img">
                                                            <h2 class="mb-0 pb-0 ms-2">Jhon Doe</h2>
                                                            <span class="ms-2">3:21 PM</span>
                                                        </div>
                                                        <div class="recieved-msg-text">
                                                            <video controls>
                                                                <source
                                                                    src="assets/images/Download the Best Free Nature Videos_7.mp4"
                                                                    type="video/mp4">
                                                                Your browser does not support the video tag.
                                                            </video>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="msg-type-area ">
                                                    <div class="previews">
                                                        <div id="filePreview" class="preview">
                                                            <!-- <span class="close-icon" id="fileCloseIcon">&times;</span> -->
                                                        </div>
                                                        <div id="mediaPreview" class="preview">
                                                            <!-- <span class="close-icon" id="mediaCloseIcon">&times;</span> -->
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="msg-type-area--input d-flex align-items-center justify-content-between">
                                                        <input type="text" placeholder="Type your message"
                                                            id="emojionearea1">
                                                        <div class="d-flex align-items-center chat-btns">
                                                            <div class="option-btns ">
                                                                <button class="text-gray" id="fileButton">
                                                                    <i class="fa-solid fa-file"></i>
                                                                    <input type="file" id="fileInput" multiple
                                                                        accept=".txt, .pdf, .doc, .docx, .ppt, .pptx, .xls, .xlsx"
                                                                        style="display: none;">

                                                                    Documents
                                                                </button>
                                                                <button class="text-gray" id="mediaButton">
                                                                    <i class="fa-solid fa-image"></i>
                                                                    Photos&nbsp;&&nbsp;Videos
                                                                    <!-- hidden -->
                                                                    <input type="file" multiple id="mediaInput"
                                                                        accept="image/*, video/*" style="display: none;">


                                                                </button>
                                                            </div>
                                                            <button class="show-options ">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    title="upload Image and video"
                                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                    width="25" height="30" viewBox="0 0 30 30">
                                                                    <defs>
                                                                        <clipPath id="clip-path">
                                                                            <rect id="Rectangle_1108"
                                                                                data-name="Rectangle 1108" width="25"
                                                                                height="30"
                                                                                transform="translate(1464 1125)"
                                                                                opacity="0" />
                                                                        </clipPath>
                                                                    </defs>
                                                                    <g id="Mask_Group_1" data-name="Mask Group 1"
                                                                        transform="translate(-1464 -1125)"
                                                                        clip-path="url(#clip-path)">
                                                                        <path id="Path_646" data-name="Path 646"
                                                                            d="M369.672,6154.737a6.064,6.064,0,0,1-4.377-1.853,6.438,6.438,0,0,1,0-8.925l6.377-6.548a.88.88,0,0,1,1.261,1.228l-6.377,6.548a4.667,4.667,0,0,0,0,6.469,4.337,4.337,0,0,0,6.233,0l10.116-10.392a3,3,0,0,0,0-4.16,2.77,2.77,0,0,0-3.984,0L370,6146.336a1.354,1.354,0,0,0,0,1.854,1.208,1.208,0,0,0,1.737,0l7.011-7.267a.88.88,0,1,1,1.266,1.222l-7.014,7.27a2.967,2.967,0,0,1-4.261,0,3.109,3.109,0,0,1,0-4.306l8.921-9.231a4.508,4.508,0,0,1,3.255-1.38h0a4.5,4.5,0,0,1,3.253,1.378,4.772,4.772,0,0,1,0,6.615l-10.116,10.391A6.064,6.064,0,0,1,369.672,6154.737Z"
                                                                            transform="translate(-3130.714 -2940.092) rotate(-45)" />
                                                                    </g>
                                                                </svg>
                                                            </button>
                                                            <button class="ms-md-3 ms-2 send send-msg">
                                                                <p class="mb-0 pb-0 me-2">Send</p>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" class="" viewBox="0 0 16 16">
                                                                    <g id="Iconly_Bold_Send" data-name="Iconly/Bold/Send"
                                                                        transform="translate(-2 -2)">
                                                                        <g id="Send" transform="translate(2 2)">
                                                                            <path id="Path_1531" data-name="Path 1531"
                                                                                d="M15.548.466A1.547,1.547,0,0,0,14,.063L1.126,3.808A1.535,1.535,0,0,0,.02,5.024a1.8,1.8,0,0,0,.8,1.682L4.848,9.181a1.043,1.043,0,0,0,1.288-.155l4.611-4.639a.587.587,0,0,1,.848,0,.61.61,0,0,1,0,.854L6.976,9.881a1.059,1.059,0,0,0-.154,1.295l2.46,4.067A1.528,1.528,0,0,0,10.61,16a1.659,1.659,0,0,0,.2-.008,1.559,1.559,0,0,0,1.3-1.111L15.932,2.02A1.571,1.571,0,0,0,15.548.466"
                                                                                transform="translate(0 0)"
                                                                                fill="#fff" />
                                                                        </g>
                                                                    </g>
                                                                </svg>
                                                            </button>
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

            </div>
            <div class="row mb-3 mt-3">
                <div class="col-lg-12">
                    <div class="box">
                        <p class="f-14 w-500 mb-0 pb-0 text-center text-gray text-dark-clr" id="copyright-year"></p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="taskModal" data-phase-id="" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-medium">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Task</h5>
                    <button type="button" class=" close-btn text-white" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fa-duotone fa-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">

                            <div class="col-lg-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control crm-input" class="task" id="task"
                                        placeholder="ABC">
                                    <label class="crm-label form-label" for="task">Add task<span
                                            class="text-danger">*</span></label>
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <div class="d-flex justify-content-lg-end justify-content-center mt-3 mb-3">
                                    <button type="button" class="modal-btn-cancel me-3"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="button" id="save-task-btn" class="modal-btn-save ">Save </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('script')
    <script>
        function openCity(evt, cityName) {
            var i, tabcontentProject, tablinksProjects;
            tabcontentProject = document.getElementsByClassName("tabcontentProjects");
            for (i = 0; i < tabcontentProject.length; i++) {
                tabcontentProject[i].style.display = "none";
            }
            tablinksProjects = document.getElementsByClassName("tablinksProjects");
            for (i = 0; i < tablinksProjects.length; i++) {
                tablinksProjects[i].className = tablinksProjects[i].className.replace(" activeProjects", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " activeProjects";
        }
        document.getElementById("defaultOpen").click();
    </script>

    <script>
        $(".progresshalf").each(function() {

            var $bar = $(this).find(".bar");
            var $val = $(this).find("span");
            var perc = parseInt($val.text(), 10);

            $({
                p: 0
            }).animate({
                p: perc
            }, {
                duration: 3000,
                easing: "swing",
                step: function(p) {
                    $bar.css({
                        transform: "rotate(" + (45 + (p * 1.8)) +
                            "deg)", // 100%=180° so: ° = % * 1.8
                        // 45 is to add the needed rotation to have the green borders at the bottom
                    });
                    $val.text(p | 0);
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.task-card--header').each(function() {
                var taskCardHeader = $(this);
                var editButton = taskCardHeader.find('.edit');
                var editAbleElement = taskCardHeader.find('.edit-able');

                editButton.click(function(e) {
                    e.stopPropagation();
                    if (editAbleElement.attr('contenteditable') === 'false') {
                        editAbleElement.attr('contenteditable', 'true').focus();
                    } else {
                        editAbleElement.attr('contenteditable', 'false');
                    }
                });

                $(document).click(function(e) {
                    if (!editAbleElement.is(e.target) && editAbleElement.has(e.target).length ===
                        0) {
                        editAbleElement.attr('contenteditable', 'false');
                    }
                });
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $('body').on('click', '.edit-task', function(e) {
                var taskDiv = $(this).closest('.task-div');
                var editAbleTaskElement = taskDiv.find('.edit-able-task');
                var isEditable = editAbleTaskElement.attr('contenteditable') === 'true';
                e.stopPropagation();
                // Disable editing for all .edit-able-task elements within the same .task-div
                taskDiv.find('.edit-able-task').attr('contenteditable', 'false');

                if (!isEditable) {
                    editAbleTaskElement.attr('contenteditable', 'true').focus();
                }
            });

            $(document).click(function(e) {
                e.stopPropagation();
                var editAbleTaskElements = $('.edit-able-task');
                editAbleTaskElements.each(function() {
                    if (!$(this).is(e.target) && !$.contains($(this)[0], e.target)) {
                        $(this).attr('contenteditable', 'false');
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.table-btn-blank, .table-btn-blank-completed').click(function() {
                // $(this).toggleClass('table-btn-blank-completed');
                if ($(this).hasClass('table-btn-blank-completed')) {
                    $(this).removeClass('table-btn-blank-completed')
                    $(this).addClass('table-btn-blank')
                    $(this).text('Mark As Completed');
                } else {
                    $(this).addClass('table-btn-blank-completed')
                    $(this).removeClass('table-btn-blank')
                    $(this).text('Completed');
                }
            });
        });
    </script>
    <script>
        $(".show-options").on("click", function(event) {
            event.stopPropagation(); // Prevent the click event from propagating to the document
            $(".option-btns").toggleClass("option-btns-show");
        });

        $(document).on("click", function(event) {
            if (!$(".option-btns").is(event.target) && $(".option-btns").has(event.target).length === 0) {
                $(".option-btns").removeClass("option-btns-show");
            }
        });

        $(".option-btns").on("click", function(event) {
            event.stopPropagation(); // Prevent the click event from propagating to the document
            $(".option-btns").removeClass("option-btns-show");
        });
    </script>
    <script src="https://rawgit.com/mervick/emojionearea/master/dist/emojionearea.js"></script>
    <!-- emoji -->
    <script>
        $(document).ready(function() {
            $("#emojionearea1").emojioneArea({
                pickerPosition: "top",
                tonesStyle: "bullet"
            });
        })
    </script>
    <script>
        // Add a click event listener to the common parent element
        $('body').on('click', '.icon-container', function(event) {
            // Get the clicked element
            const targetIcon = $(event.target);

            // Check if the clicked element has the class 'bi-check-circle-fill'
            if (targetIcon.hasClass('bi-check-circle-fill')) {
                // Toggle the classes on the clicked element
                targetIcon.removeClass('bi-check-circle-fill complete-step');
                targetIcon.addClass('bi-check-circle');
            } else if (targetIcon.hasClass('bi-check-circle')) {
                // Toggle the classes on the clicked element
                targetIcon.removeClass('bi-check-circle');
                targetIcon.addClass('bi-check-circle-fill complete-step');
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            // Define the screen width breakpoint where you want to disable the accordion
            var breakpoint = 768; // For example, disable the accordion on screens wider than 992px

            // Function to disable accordion behavior on large screens
            function disableAccordionOnLargeScreens() {
                if ($(window).width() > breakpoint) {
                    // Remove data-bs-toggle and data-bs-target attributes from accordion buttons
                    $('.accordion .accordion-button')
                        .removeAttr('data-bs-toggle')
                        .removeAttr('data-bs-target');
                    $('.accordion .accordion-button').attr('aria-expanded', 'true');
                    $('.accordion .accordion-collapse').addClass('show');
                }
                // else {
                //     // Restore data-bs-toggle and data-bs-target attributes if the screen width is within the breakpoint
                //     $('.accordion .accordion-button')
                //         .attr('data-bs-toggle', 'collapse')
                //         .attr('data-bs-target', '.accordion-collapse');
                //     $('.accordion .accordion-button:first').attr('aria-expanded', 'true');
                //     $('.accordion .accordion-collapse:first').addClass('show');
                // }
            }

            // Call the function on page load and resize events
            disableAccordionOnLargeScreens();
            $(window).resize(disableAccordionOnLargeScreens);
        });
    </script>

    {{-- Add new task --}}
    <script type="text/template" id="taskTemplate">
        <div
            class="d-flex justify-content-between align-items-start task-div">
            <div class="d-flex">
                <span class="me-2">{task_count}.</span>
                <p class="mb-2 pb-0 edit-able-task"
                    contenteditable="false">
                    {task}</p>
            </div>
            <div class="d-flex">
                <i
                    class="bi bi-check-circle ms-2 task-status"></i>
                <div class="edit-task ms-2">
                    <i class="bi bi-pencil-fill"></i>
                </div>
            </div>
        </div>
    </script>

    <script>
        $(".addPhase-btn").click(function() {
            var phaseID = $(this).data("phase-id")
            $("#taskModal").attr("data-phase-id", phaseID)
        })

        $("body").on('click', '#save-task-btn', function() {
            var phaseID = $("#taskModal").attr("data-phase-id")
            var task = $("#task").val()
            var tasksCount = $(`.tasks-container[data-phase-id=${phaseID}] .task-div`).length

            if (task.length > 0) {
                var taskTemplate = $("#taskTemplate").html()
                taskTemplate = taskTemplate.replace("{task_count}", tasksCount + 1)
                taskTemplate = taskTemplate.replace("{task}", task)
                $(`.tasks-container[data-phase-id=${phaseID}]`).append(taskTemplate)
                $("#task").val("")
                $("#taskModal").modal("hide")
            }
        })
    </script>

    {{-- Update phases and tasks --}}
    <script>
        $("body").on('blur', '.edit-able', function() {
            var phaseID = $(this).data('phase-id')
            var phaseName = $(this).text().trim();
            if (phaseName.length > 0) {
                $.ajax({
                    url: '{{ route('staff.phases.update', 'phase_id') }}'.replace('phase_id', phaseID),
                    type: 'PATCH',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'name': phaseName
                    },
                    success: function(response) {
                        console.log(response);
                    }
                })
            }
        })
    </script>

    <script>
        $("body").on('click', '#save-data-btn', function() {
            // Update project data
            var projectID = '{{ $project->id }}';
            var projectName = $("#ProjectDetails #P-name").val();
            var projectClientID = $("#ProjectDetails #client_id").val();
            var projectDescription = $("#ProjectDetails #description").val();
            var projectDeadline = $("#ProjectDetails #deadline").val();
            var projectProgress = $("#ProjectDetails #overall-progress").val();

            if (projectName.length < 3) {
                alert("Project name should have minimum 3 characters!")
                return;
            }

            if (projectProgress < 0 || projectProgress > 100) {
                alert("Progress should be between 0 and 100!")
                return;
            }

            $.ajax({
                url: '{{ route('staff.projects.update', 'project_id') }}'.replace('project_id',
                    projectID),
                type: 'PUT',
                data: {
                    '_token': '{{ csrf_token() }}',
                    '_target': 'ajax',
                    'name': projectName,
                    'client_id': projectClientID,
                    'description': projectDescription,
                    'deadline': projectDeadline,
                    'progress': projectProgress,
                },
                success: function(response) {
                    console.log(response);
                }
            })

            // Update phases and tasks
            var projectDetailsContainer = $("#ProjectDetails");
            projectDetailsContainer.find('.task-card').each(function() {
                var phaseID = $(this).find('.edit-able').data("phase-id");
                var phaseName = $(this).find('.edit-able').text().trim();
                var phaseStatus = $(this).find('.phase-complete')
                    .hasClass('table-btn-blank-completed') ? 1 : 0;
                var phaseProgress = $(this).find('.score').val().replace("%", "");
                var tasks = $(this).find('.tasks-container .task-div');
                var tasksData = [];

                tasks.each(function() {
                    var taskID = $(this).data("task-id") ? $(this).data("task-id") : 0;
                    var task = $(this).find(".edit-able-task").text().trim();
                    var taskStatus = $(this).find(".task-status").hasClass("complete-step") ? 1 : 0;

                    tasksData.push({
                        id: taskID,
                        task: task,
                        status: taskStatus
                    })
                })

                $.ajax({
                    url: '{{ route('staff.phases.update', 'phase_id') }}'.replace('phase_id',
                        phaseID),
                    type: 'PATCH',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'name': phaseName,
                        'status': phaseStatus,
                        'progress': phaseProgress,
                    },
                    success: function(response) {}
                })

                $.ajax({
                    url: '{{ route('staff.tasks.updateAll') }}',
                    type: 'PUT',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'phase_id': phaseID,
                        'tasks': tasksData
                    },
                    success: function(response) {

                    }
                })
            })
            location.reload()
        })
    </script>
@endsection
@endsection
