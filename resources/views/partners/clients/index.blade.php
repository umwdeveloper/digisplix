@extends('layouts.partner')

@section('content')
    <main class="content ">
        <div class="container-fluid px-lg-0">
            <div class="row justify-content-center">
                <div class="col-xl-12 ">
                    <div class="row">
                        <div class="col-xl-4 col-md-6 mb-3">
                            <div class="box">
                                <h1 class="box-heading">Total Clients</h1>
                                <div class="d-flex align-items-center">
                                    <div class=" flex-grow-1  box-text d-flex align-items-center">

                                        <span class="box-value">{{ number_format($clients->count(), 0, ',') }}</span>

                                    </div>
                                    <div class="box-icon">
                                        <i class="fa-duotone fa-users-line"></i>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 mb-3">
                            <div class="box">
                                <h1 class="box-heading">Active Clients</h1>
                                <div class="d-flex align-items-center">
                                    <div class=" flex-grow-1  box-text d-flex align-items-center">

                                        <span
                                            class="box-value active_clients">{{ number_format($active_clients->count(), 0, ',') }}</span>

                                    </div>
                                    <div class="box-icon">
                                        <i class="fa-duotone fa-chart-line"></i>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 mb-3">
                            <div class="box">
                                <h1 class="box-heading">Inactive Clients</h1>
                                <div class="d-flex align-items-center">
                                    <div class=" flex-grow-1  box-text d-flex align-items-center">
                                        <span
                                            class="box-value inactive_clients">{{ number_format($inactive_clients->count(), 0, ',') }}</span>

                                    </div>
                                    <div class="box-icon">
                                        <i class="fa-duotone fa-person-arrow-down-to-line"></i>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 h-100">
                            <div class="box mb-3 box-p">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-3">
                                        <h1 class="f-20 w-500 mb-0 pb-0 text-dark-clr">Clients</h1>
                                        <button class="table-btn d-none" type="button" class="btn btn-primary"
                                            id="editClientModal-btn" data-bs-toggle="modal"
                                            data-bs-target="#editClientModal">Edit Client</button>
                                    </div>
                                    <table id="example-inprogress" class="table data-table-style client-table">
                                        <thead>
                                            <tr>
                                                <th class="no-sort"></th>
                                                <th>Client Name</th>
                                                <th>Status</th>
                                                <th>Designation</th>
                                                <th>Business Name</th>
                                                <th>Email</th>
                                                <th>Partner</th>
                                                <th>Country</th>
                                                <th>Phone Number</th>
                                                <th>URL</th>
                                                <th>Address</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($clients as $client)
                                                <tr class="">
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="table-arrow">
                                                                <!-- <i class="fa-duotone fa-circle-chevron-down"></i> -->
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>{{ $client->user->name }}</td>
                                                    <td class="">
                                                        <div
                                                            class="{{ $client->active == 1 ? 'active-now' : 'in-active' }} text-center p-1 rounded-2">
                                                            {{ $client->active == 1 ? 'Active' : 'Inactive' }}</div>
                                                    </td>
                                                    <td class="">
                                                        {{ $client->user->designation }}
                                                    </td>
                                                    <td class="bussiness-name">{{ $client->business_name }}</td>
                                                    <td>{{ $client->user->email }}</td>
                                                    <td>{{ $client->partner->user->name }}</td>

                                                    <td>
                                                        {{ $client->user->country }}
                                                    </td>

                                                    <td>
                                                        {{ $client->user->phone }}
                                                    </td>
                                                    <td>
                                                        @if (!empty($client->url))
                                                            <a href="{{ $client->url }}">{{ $client->url }}</a>
                                                        @else
                                                            None
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ $client->user->address ?? 'None' }}
                                                    </td>
                                                    <td>
                                                        <div class="table-actions d-flex align-items-center">
                                                            <button class="edit"
                                                                data-client-id="{{ $client->id }}">Edit</button>
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

            </div>
        </div>
    </main>

    <!-- Edit Client Modal -->
    <div class="modal fade" id="editClientModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-medium">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Client</h5>
                    <button type="button" class=" close-btn text-white" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fa-duotone fa-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('partner.leads.update', old('client_id') ? old('client_id') : '1') }}"
                        method="POST" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control crm-input {{ $errors->updateClient->has('name') ? 'is-invalid' : '' }}"
                                            id="name" name="name" required
                                            value="{{ $errors->hasBag('updateClient') ? old('name') : '' }}"
                                            placeholder="Mickel">
                                        <label class="crm-label form-label" for="name">Client Name<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->updateClient->has('name'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->updateClient->first('name') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control crm-input {{ $errors->updateClient->has('business_name') ? 'is-invalid' : '' }}"
                                            id="business-name" name="business_name" required
                                            value="{{ $errors->hasBag('updateClient') ? old('business_name') : '' }}"
                                            placeholder="Mickel">
                                        <label class="crm-label form-label" for="business-name">Business Name<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->updateClient->has('business_name'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->updateClient->first('business_name') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control crm-input {{ $errors->updateClient->has('business_phone') ? 'is-invalid' : '' }}"
                                            id="business-phone" name="business_phone"
                                            value="{{ $errors->hasBag('updateClient') ? old('business_phone') : '' }}"
                                            placeholder="Mickel">
                                        <label class="crm-label form-label" for="business-phone">Business
                                            Phone</label>
                                        @if ($errors->updateClient->has('business_phone'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->updateClient->first('business_phone') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="email"
                                            class="form-control crm-input {{ $errors->updateClient->has('email') ? 'is-invalid' : '' }}"
                                            id="email" name="email" required
                                            value="{{ $errors->hasBag('updateClient') ? old('email') : '' }}"
                                            placeholder="ABC">
                                        <label class="crm-label form-label" for="email">Email Address<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->updateClient->has('email'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->updateClient->first('email') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control crm-input {{ $errors->updateClient->has('designation') ? 'is-invalid' : '' }}"
                                            id="designation" name="designation" required
                                            value="{{ $errors->hasBag('updateClient') ? old('designation') : '' }}"
                                            placeholder="ABC">
                                        <label class="crm-label form-label" for="email">Designation<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->updateClient->has('designation'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->updateClient->first('designation') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <input type="hidden" name="active" id="active" value="">
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control crm-input {{ $errors->updateClient->has('url') ? 'is-invalid' : '' }}"
                                            id="url" name="url"
                                            value="{{ $errors->hasBag('updateClient') ? old('url') : '' }}"
                                            placeholder="ABC">
                                        <label class="crm-label form-label" for="url">URL</label>
                                        @if ($errors->updateClient->has('url'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->updateClient->first('url') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <input type="hidden" name="partner_id" value="{{ auth()->user()->partner()->id }}">
                                <div class="col-lg-6">
                                    <div class=" mb-3">
                                        <label class="country-label form-label mb-2" for="country">Country<span
                                                class="text-danger">*</span></label><br>
                                        <input type="text"
                                            class=" {{ $errors->updateClient->has('country') ? 'is-invalid' : '' }}"
                                            id="country2" name="country" required
                                            value="{{ $errors->hasBag('updateClient') ? old('country') : '' }}"
                                            placeholder="Pakistan">
                                        <input type="hidden" id="country2_code" name="country_code">
                                        <!-- <label class="crm-label form-label" for="country2">Country<span
                                                                                                                                                    class="text-danger">*</span></label> -->
                                        @if ($errors->updateClient->has('country'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->updateClient->first('country') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control crm-input {{ $errors->updateClient->has('phone') ? 'is-invalid' : '' }}"
                                            id="p-number" name="phone" required
                                            value="{{ $errors->hasBag('updateClient') ? old('phone') : '' }}"
                                            placeholder="ABC">
                                        <label class="crm-label form-label" for="p-number">Phone Number<span
                                                class="text-danger">*</span></label>
                                        @if ($errors->updateClient->has('phone'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->updateClient->first('phone') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-floating mb-3">
                                        <input type="text"
                                            class="form-control crm-input {{ $errors->updateClient->has('address') ? 'is-invalid' : '' }}"
                                            id="address" name="address"
                                            value="{{ $errors->hasBag('updateClient') ? old('address') : '' }}"
                                            placeholder="ABC">
                                        <label class="crm-label form-label" for="address">Address</label>
                                        @if ($errors->updateClient->has('address'))
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $errors->updateClient->first('address') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-lg-end justify-content-center mt-3 mb-3">
                                        <button type="button" class="modal-btn-cancel me-3"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <input type="hidden" name="client_id" id="client_id"
                                            value="{{ old('client_id') ? old('client_id') : '1' }}">
                                        <button type="submit" name="submit" class="modal-btn-save ">Update
                                        </button>
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
    <script>
        window.onload = function() {
            @if ($errors->updateClient->any())
                $("#country2").countrySelect({
                    defaultCountry: "us"
                });
                $("#country2").countrySelect("setCountry",
                    "{{ $errors->hasBag('updateClient') ? old('country') : '' }}");
                $('#editClientModal-btn').click()
            @endif
        }
    </script>

    <script>
        $(document).ready(function() {
            // Iterate through each select element with class .select-active
            $(".select-active").each(function() {
                const selectStatus = $(this);

                function applyStyleToSelectedOption() {
                    // Get the selected option
                    const selectedOption = selectStatus.find("option:selected");

                    // Get the styles from the selected option
                    const backgroundColor = selectedOption.css("background-color");
                    const color = selectedOption.css("color");

                    // Apply the styles to the select element
                    selectStatus.css("background-color", backgroundColor);
                    selectStatus.css("color", color);

                    // Apply the styles to the selected option
                    selectedOption.css("background-color", backgroundColor);
                    selectedOption.css("color", color);
                }

                // Apply the style to the selected option immediately
                applyStyleToSelectedOption();

                // Listen for the change event on this specific select element
                selectStatus.on("change", applyStyleToSelectedOption);
            });
        });


        // select for modal
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

    {{-- Change active or inactive --}}
    <script>
        $('body').on('change', '.select-active', function() {
            let status = $(this).val();
            let clientID = $(this).data('client-id');

            $.ajax({
                url: '{{ route('partner.clients.update_client_status', 'client_id') }}'.replace(
                    'client_id',
                    clientID),
                type: 'PATCH',
                data: {
                    '_token': '{{ csrf_token() }}',
                    status
                },
                success: function(response) {
                    if (response.status == 'success') {
                        if (status == 0) {
                            $('.inactive_clients').text(parseInt($('.inactive_clients').text()) + 1)
                            $('.active_clients').text(parseInt($('.active_clients').text()) - 1)
                        } else {
                            $('.active_clients').text(parseInt($('.active_clients').text()) + 1)
                            $('.inactive_clients').text(parseInt($('.inactive_clients').text()) - 1)
                        }
                    } else {
                        alert(response.message)
                    }
                }
            })
        })
    </script>

    {{-- Fetch client on Edit click --}}
    <script>
        $('body').on('click', '.edit', function() {
            $('.loading').removeClass('d-none')
            // Remove validation errors
            $('.is-invalid').removeClass('is-invalid')
            $('.invalid-feedback').remove()

            let clientID = $(this).data('client-id');
            $('#editClientModal form').attr('action', "{{ route('partner.clients.update', 'client_id') }}"
                .replace('client_id', clientID))
            $('#editClientModal #client_id').val(clientID)
            $.ajax({
                url: '{{ route('partner.clients.fetch_client', 'client_id') }}'
                    .replace('client_id', clientID),
                method: 'GET',
                success: function(response) {
                    $('.loading').addClass('d-none')
                    if (response.status == 'success') {
                        $("#editClientModal #name").val(response.client.user.name)
                        $("#editClientModal #business-name").val(response.client.business_name)
                        $("#editClientModal #business-phone").val(response.client.business_phone)
                        $("#editClientModal #email").val(response.client.user.email)
                        $("#editClientModal #designation").val(response.client.user.designation)
                        $("#editClientModal #active").val(response.client.active)
                        $("#editClientModal #url").val(response.client.url)
                        $("#editClientModal #partner_id").val(response.client.partner.id)
                        $("#editClientModal #address").val(response.client.user.address)
                        $("#editClientModal #p-number").val(response.client.user.phone)

                        $("#country2").countrySelect({
                            defaultCountry: response.client.user.country
                        });
                        $("#country2").countrySelect("setCountry", response.client.user.country);
                        $('#editClientModal-btn').click()
                    } else {}
                }
            })
        })
    </script>
@endsection
@endsection
