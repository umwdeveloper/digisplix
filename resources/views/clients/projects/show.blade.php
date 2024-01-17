@extends('layouts.client')

@section('content')
    <main class="content ">
        <div class="container-fluid px-lg-0">
            <div class="row justify-content-center">
                <div class="col-xl-12 ">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="box-white">
                                <div class="tabcontentProjects d-block">
                                    <div class="row ">
                                        <div class="col-lg-12">
                                            <div
                                                class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-3 mt-lg-0 mt-2">
                                                <h1 class="f-20 w-500 mb-0 pb-0 text-dark-clr">Project&nbsp;Update</h1>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <div class="form-floating ">
                                                <input type="text" class="form-control crm-input" id="name"
                                                    placeholder="Mickel" value="{{ $project->client->user->name }}"
                                                    readonly>
                                                <label class="crm-label form-label" for="name">Client Name<span
                                                        class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <div class="form-floating ">
                                                <input type="text" class="form-control crm-input" id="name" readonly
                                                    placeholder="Mickel" value="{{ $project->client->business_name }}">
                                                <label class="crm-label form-label" for="name">Business Name<span
                                                        class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <div class="form-floating ">
                                                <input type="text" class="form-control crm-input" id="name" readonly
                                                    placeholder="Mickel" value="{{ $project->name }}">
                                                <label class="crm-label form-label" for="name">Project Name<span
                                                        class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <div class="form-floating ">
                                                <input type="text" class="form-control crm-input" id="start_date"
                                                    readonly placeholder="Mickel"
                                                    value="{{ \Carbon\Carbon::parse($project->created_at)->format('d M Y') }}">
                                                <label class="crm-label form-label" for="name">Start Date<span
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
                                                    $progressWidth = $phasesCount > 0 ? round($phasesProgress / $phasesCount) : 0;
                                                @endphp
                                                <div class="progress-stripped progress-striped">
                                                    <div class="progress-bar progress-bar-animated"
                                                        style="width: {{ $project->progress }}%">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-md-6 order-xl-3 order-2 mb-3">
                                            <div
                                                class="box-gray d-flex flex-column justify-content-center align-items-center">
                                                <div class="caption mb-3">Project Delivery Date</div>
                                                <div class="d-flex align-items-center">
                                                    <img src="assets/images/31279_launch_rocket_spaceship_icon.png"
                                                        alt="" class="img-fluid launch-img me-3">
                                                    <div>
                                                        <h3 class="f-30 w-500 text-primary mb-0 pb-0">
                                                            @php
                                                                // use Carbon\Carbon;
                                                                $daysPassed = \Carbon\Carbon::parse($project->deadline)
                                                                    ->endOfDay()
                                                                    ->diffInDays(now()->startOfDay());
                                                            @endphp
                                                            {{ $daysPassed }}
                                                        </h3>
                                                        <span class="f-14 text-gray text-dark-clr">
                                                            {{ $daysPassed > 1 || $daysPassed == 0 ? 'days' : 'day' }}
                                                            left</span>
                                                    </div>
                                                </div>
                                                <p class="mb-0 pb-0 f-14 text-gray w-400 mt-3 text-dark-clr">
                                                    {{ \Carbon\Carbon::parse($project->deadline)->format('d M Y') }}
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
