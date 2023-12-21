@extends('layouts.client')

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

                                        <span class="box-value">{{ $completed_projects }}</span>

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

                                        <span class="box-value">{{ $ongoing_projects }}</span>

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
                                        <span class="box-value">{{ $paid_projects }}</span>

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
                                        <span class="box-value">{{ $overdue_projects }}</span>

                                    </div>
                                    <div class="box-icon">
                                        <i class="fa-duotone fa-sack"></i>
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

                                    </div>
                                    <a href="{{ route('client.projects.show', $project->id) }}" class="project-card-data">
                                        <img src="{{ $project->img ? getURL($project->img) : asset('images/') }}"
                                            alt="">
                                        <div class="ms-2">
                                            <h1 class="mb-0 pb-0">{{ $project->name }}</h1>
                                            <h3 class="mb-0 pb-0">{{ $project->client->user->name }}</h3>
                                        </div>
                                    </a>
                                    <div class="project-card-details">
                                        <p class="mb-0 pb-0">
                                            {{ $project->description }}
                                        </p>
                                        <div class="d-flex justify-content-between align-items-end mt-4">
                                            <button disabled
                                                class="{{ $project->billing_status == 0 ? 'overdue' : 'paid' }}">{{ $billing_labels[$project->billing_status] }}</button>
                                            <div>
                                                <div class="completed">
                                                    <i class="fa-duotone fa-calendar-days me-1"></i>
                                                    <span class="mb-0 pb-0">{{ $project->deadline }}</span>
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

    @section('script')
        <script>
            $("#filter-select").on('change', function() {
                var url;
                if ($(this).val() === "all") {
                    url = "{{ route('client.projects.index') }}"
                } else {
                    url = "{{ route('client.projects.index') }}" +
                        "?filter=" + $(this).val()
                }
                window.location.href = url
            })
        </script>
    @endsection
@endsection
