@extends('layouts.app')

@section('content')
    <main class="content ">
        <div class="container-fluid px-lg-0">
            <div class="row justify-content-center">
                <div class="col-xl-12 ">
                    <div class="box mb-3 ">
                        <div class="d-flex justify-content-between mb-2">
                            <h1 class="f-20 w-500 mb-3 text-dark-clr">{{ ucfirst($plan->name) }} Plan Features</h1>
                            <button class="table-btn" data-bs-toggle="modal" data-bs-target="#featureModal">Add New</button>
                        </div>
                        <div class="table-responsive-div">
                            <table id="upcoming-table" class="table data-table-style  ">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($features as $key => $feature)
                                        <tr class="">
                                            <td scope="row">
                                                <p class="mb-0 pb-0 ms-2">{{ ++$key }}</p>
                                            </td>
                                            <td>{{ $feature->description }}</td>
                                            <td>
                                                <div class="table-actions d-flex align-items-center">
                                                    <button class="edit"
                                                        data-feature-id="{{ $feature->id }}">Edit</button>
                                                    <form action="{{ route('staff.features.destroy', $feature->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="delete">Delete</button>
                                                    </form>
                                                </div>


                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="featureModal" data-phase-id="" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-medium">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Feature</h5>
                    <button type="button" class=" close-btn text-white" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fa-duotone fa-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">

                            <form action="{{ route('staff.features.store') }}" method="POST">
                                @csrf
                                <div class="col-lg-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="description" class="form-control crm-input"
                                            placeholder="ABC" required>
                                        <label class="crm-label form-label" for="task">Add feature<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <input type="hidden" name="plan_id" required value="{{ $plan->id }}">
                                </div>


                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-lg-end justify-content-center mt-3 mb-3">
                                        <button type="button" class="modal-btn-cancel me-3"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button class="modal-btn-save ">Save </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editFeatureModal" data-phase-id="" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-medium">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Feature</h5>
                    <button type="button" class=" close-btn text-white" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fa-duotone fa-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">

                            <form method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="col-lg-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" id="description" name="description"
                                            class="form-control crm-input" placeholder="ABC" required>
                                        <label class="crm-label form-label" for="task">Feature<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <input type="hidden" name="plan_id" required value="{{ $plan->id }}">
                                </div>


                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-lg-end justify-content-center mt-3 mb-3">
                                        <button type="button" class="modal-btn-cancel me-3"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button class="modal-btn-save ">Save </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

    {{-- Fetch feature on Edit click --}}
    <script>
        $('body').on('click', '.edit', function() {

            $('.loading').removeClass('d-none')

            let featureID = $(this).data('feature-id');
            $('#editFeatureModal form').attr('action', "{{ route('staff.features.update', 'feature_id') }}"
                .replace('feature_id', featureID))
            $('#editFeatureModal #feature_id').val(featureID)
            $.ajax({
                url: '{{ route('staff.features.fetch_feature', 'feature_id') }}'
                    .replace('feature_id', featureID),
                method: 'GET',
                success: function(response) {
                    $('.loading').addClass('d-none')
                    $("#editFeatureModal #description").val(response.feature.description)
                    // $('#editLeadModal-btn').click()
                    $('#editFeatureModal').modal('show')
                }
            })
        })
    </script>
@endsection
@endsection
