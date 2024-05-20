@extends('layouts.app')

@section('content')
    <main class="content ">
        <div class="container-fluid px-lg-0">
            <div class="row justify-content-center">
                <div class="col-xl-12 ">
                    <div class="box mb-3  dasboard-table ">
                        <div class="flex-grow-1">
                            <h1 class="f-20 w-500 mb-3 text-dark-clr">Business Growth Plans</h1>
                            <div class="table-responsive-div">
                                <table id="upcoming-table" class="table data-table-style  ">
                                    <thead>
                                        <tr>

                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Action</th>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($plans as $key => $plan)
                                            <tr class="">
                                                <td scope="row">
                                                    <p class="mb-0 pb-0 ms-2">{{ ++$key }}</p>
                                                </td>
                                                <td>{{ ucfirst($plan->name) }}</td>
                                                <td>
                                                    <button class="table-btn discount"
                                                        data-plan-id="{{ $plan->id }}">Discount</button>
                                                    <button type="button" class="table-btn"
                                                        onclick="location.href='{{ route('staff.plans.features', $plan->id) }}'">Features</button>
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
        </div>
    </main>

    <div class="modal fade" id="editFeatureModal" data-phase-id="" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-medium">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Discount</h5>
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
                                        <input type="number" id="discount" name="discount" class="form-control crm-input"
                                            placeholder="80" required>
                                        <label class="crm-label form-label" for="task">Discount<span
                                                class="text-danger">*</span></label>
                                    </div>
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

    {{-- Fetch discount on Edit click --}}
    <script>
        $('body').on('click', '.discount', function() {

            $('.loading').removeClass('d-none')

            let planID = $(this).data('plan-id');
            $('#editFeatureModal form').attr('action', "{{ route('staff.plans.update_discount', 'plan_id') }}"
                .replace('plan_id', planID))
            $.ajax({
                url: '{{ route('staff.plans.fetch_plan', 'plan_id') }}'
                    .replace('plan_id', planID),
                method: 'GET',
                success: function(response) {
                    $('.loading').addClass('d-none')
                    $("#editFeatureModal #discount").val(response.plan.discount)
                    // $('#editLeadModal-btn').click()
                    $('#editFeatureModal').modal('show')
                }
            })
        })
    </script>
@endsection
@endsection
