@extends('layouts.app')

@section('content')
    <main class="content">
        <div class="container-fluid px-lg-0">
            <div class="row justify-content-center">
                <form action="{{ route('staff.invoices.update', $invoice->id) }}" method="post" id="invoice-form">
                    @method('put')
                    @csrf
                    <div class="col-xl-12">
                        <div class="row">
                            <div class="col-xl-12  mb-3">
                                <div class="box box-p">
                                    <div
                                        class="d-flex align-items-lg-center justify-content-between flex-md-row flex-column align-items-start">
                                        <div class="d-flex align-items-center">
                                            <a href="{{ route('staff.invoices.index') }}" class="text-gray text-dark-clr">
                                                <i class="fa-solid fa-circle-left me-2"></i> Back to Invoice List</a>
                                        </div>

                                        <div
                                            class="d-flex  flex-md-row flex-column align-items-md-center align-items-start w-sm-100">
                                            <button id="previewBtn" type="button" data-bs-toggle="modal"
                                                data-bs-target="#previewModal"
                                                class="d-flex align-items-center f-16 bg-transparent border-0 mt-md-0 mt-2 ps-0 text-dark-clr">
                                                <i class="fa-duotone fa-eye me-2"></i>Preview
                                            </button>
                                            <div class="d-flex  mt-md-0 mt-2 justify-content-center w-100">
                                                <button class="ticket-fill ms-3" id="draftBtn" name="status"
                                                    value="draft">Save
                                                    Draft</button>
                                                {{-- <button class="ticket-blank ms-2">Delete</button> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 ">
                            <div class="box mb-4 box-p" style="overflow: normal !important;">
                                <div class="row ">
                                    <div class="col-lg-12">
                                        <h1 class="invoice-heading text-primary mb-4">Invoice Details</h1>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="box-gray box-p">
                                            <div class="row">
                                                <div class="col-lg-4 ">
                                                    <div class="mb-lg-0 mb-4">
                                                        <div class="mb-3">
                                                            <label for="" class="invoice-label">Customer
                                                                Name</label>
                                                            <select name="client_id" id="client"
                                                                class="form-select form-select-sm mt-2">
                                                                @foreach ($clients as $client)
                                                                    <option
                                                                        {{ $client->id == $invoice->client->id ? 'selected' : '' }}
                                                                        value="{{ $client->id }}">
                                                                        {{ $client->user->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-lg-4 ">
                                                    <div class="mb-lg-0 mb-4">
                                                        <label for="" class="invoice-label">Category</label>
                                                        <select name="category_id" id="category"
                                                            class="form-select form-select-sm mt-2">
                                                            @foreach ($categories as $category)
                                                                <option
                                                                    {{ $category->id == $invoice->category_id ? 'selected' : '' }}
                                                                    value="{{ $category->id }}">{{ $category->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-lg-0 mb-4">
                                                        <label for="" class="invoice-label">Select</label>
                                                        <div class="form-check mt-2">
                                                            <input {{ $invoice->recurring == '1' ? 'checked' : '' }}
                                                                class="form-check-input" type="checkbox"
                                                                id="flexCheckChecked" value="1" name="recurring">
                                                            <label class="form-check-label" for="flexCheckChecked">
                                                                Recurring Invoice
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="recurring-details " style="display: block;">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="">
                                                            <div class="multipleSelection mt-4">
                                                                <div class="selectBox bg-white">
                                                                    <input type="date" name="start_from" class="w-100"
                                                                        placeholder="Enter references No."
                                                                        value="{{ $invoice->start_from }}">
                                                                </div>
                                                                @error('start_from')
                                                                    <small class="invalid-feedback " style="font-size: 11px">
                                                                        {{ $message }}
                                                                    </small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="">
                                                            <div class="multipleSelection mt-4">
                                                                <div class="selectBox bg-white">
                                                                    <input type="number" name="duration" min="1"
                                                                        class="w-100" placeholder="Enter Months"
                                                                        value="{{ $invoice->duration }}">
                                                                </div>
                                                                @error('duration')
                                                                    <small class="invalid-feedback " style="font-size: 11px">
                                                                        {{ $message }}
                                                                    </small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mt-4">
                                        <div class="d-flex justify-content-between align-items-center  mb-4">
                                            <div>
                                                <h1 class="invoice-heading text-primary mb-0 pb-0">Items Details</h1>
                                            </div>
                                            <div> <button type="button" class="ticket-fill add-item"
                                                    style="width: fit-content !important;">Add
                                                    Item</button></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="box-gray mb-4 pb-0 pt-0  item-add-box-div box-p">
                                            @php
                                                $total_price = 0;
                                            @endphp
                                            @foreach ($invoice->items as $i => $item)
                                                @php
                                                    $total_price += $item->price * $item->quantity;
                                                @endphp
                                                <div class="row item-add-box mt-4">
                                                    <div class="col-lg-12 ">
                                                        <div
                                                            class="d-flex align-items-center justify-content-between mb-3">
                                                            <h2 class="f-16 w-500 text-primary">Item
                                                                ({{ $i + 1 }})
                                                                :
                                                            </h2>
                                                            <div>
                                                                <i
                                                                    class="fa-solid fa-trash-xmark text-danger f-20 ms-2"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 mb-lg-0 mb-3">
                                                        <label for="" class="invoice-label">Item
                                                            Description</label>
                                                        <div class="selectBox bg-white">
                                                            <input type="text" required
                                                                name="descriptions[{{ $i }}]" class="w-100"
                                                                value="{{ $item->description }}" placeholder="">
                                                        </div>
                                                        @error('descriptions.' . $i)
                                                            <small class="invalid-feedback " style="font-size: 11px">
                                                                {{ $message }}
                                                            </small>
                                                        @enderror
                                                    </div>
                                                    <div class="col-lg-2 col-md-6 mb-lg-0 mb-3">
                                                        <label for="" class="invoice-label">Price</label>
                                                        <div class="selectBox bg-white">
                                                            <input type="text" required
                                                                name="prices[{{ $i }}]"
                                                                pattern="[0-9]+(\.[0-9]+)?"
                                                                oninput="validateNumbers(this)" class="w-100"
                                                                value="{{ $item->price }}" placeholder="">
                                                        </div>
                                                        @error('prices.' . $i)
                                                            <small class="invalid-feedback " style="font-size: 11px">
                                                                {{ $message }}
                                                            </small>
                                                        @enderror
                                                    </div>
                                                    <div class="col-lg-2 col-md-6 mb-lg-0 mb-3">
                                                        <label for="" class="invoice-label">Quantity</label>
                                                        <div class="selectBox bg-white">
                                                            <input type="text" required
                                                                name="quantities[{{ $i }}]"
                                                                pattern="[0-9]+(\.[0-9]+)?"
                                                                oninput="validateNumbers(this)" class="w-100"
                                                                value="{{ $item->quantity }}" placeholder="">
                                                        </div>
                                                        @error('quantities.' . $i)
                                                            <small class="invalid-feedback " style="font-size: 11px">
                                                                {{ $message }}
                                                            </small>
                                                        @enderror
                                                    </div>
                                                    <div class="col-lg-2 col-md-6 mb-lg-0 mb-3">
                                                        <label for="" class="invoice-label">Total</label>
                                                        <div class="selectBox bg-white">
                                                            <input type="text" required readonly class="w-100 total"
                                                                placeholder=""
                                                                value="{{ round($item->price * $item->quantity) }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>
                                    <div class="col-lg-4 mt-4">
                                        <div class="box-gray box-p">
                                            <h1 class="invoice-heading text-primary mb-4">Invoice Details</h1>
                                            <div>
                                                @error('invoice_id')
                                                    <small class="invalid-feedback " style="font-size: 11px">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                                <div class="d-flex align-items-center mb-2">
                                                    <div class="invoice-label">Invoice NO&nbsp;:&nbsp;</div>
                                                    <div class="invoice-value" style="outline: none !important;">
                                                        #{{ $invoice->invoice_id }}</div>
                                                    <input type="hidden" name="invoice_id"
                                                        value="{{ $invoice->invoice_id }}">
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div class="invoice-label">Due Date&nbsp;:&nbsp;</div>
                                                    <div class="invoice-value"><input type="date" required
                                                            name="due_date" value="{{ $invoice->due_date }}"
                                                            class="border-0 bg-transparent text-primary invoice-date"
                                                            style="outline: none;"></div>
                                                </div>
                                                @error('due_date')
                                                    <small class="invalid-feedback " style="font-size: 11px">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mt-4">
                                        <div class="box-gray box-p">
                                            <h1 class="invoice-heading text-primary mb-4">Invoice From
                                            </h1>
                                            @error('invoice_from')
                                                <small class="invalid-feedback " style="font-size: 11px">
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                            <textarea name="invoice_from" required id="invoice_from" rows="3" class="border-0 f-14 w-400 bg-transparent"
                                                style="width: 100%; outline: none;">{{ $invoice->invoice_from }}</textarea>

                                        </div>
                                    </div>
                                    <div class="col-lg-4 mt-4">
                                        <div class="box-gray box-p">
                                            <h1 class="invoice-heading text-primary mb-4">Invoice To</h1>
                                            @error('invoice_to')
                                                <small class="invalid-feedback " style="font-size: 11px">
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                            <textarea name="invoice_to" required id="invoice_to" rows="3" class="border-0 f-14 w-400 bg-transparent"
                                                style="width: 100%; outline: none;">{{ $invoice->invoice_to }}</textarea>



                                        </div>
                                    </div>
                                    <div class="col-lg-6 mt-4 ">
                                        <h1 class="invoice-heading text-primary mb-4">More Fields</h1>
                                        <div class="box-gray h-auto box-p text-center ">
                                            @if ($errors->any(['account_holder_name', 'bank_name', 'ifsc_code', 'account_number']))
                                                <small class="invalid-feedback " style="font-size: 11px">
                                                    Bank details are not correct
                                                </small>
                                            @endif
                                            <p class="text-danger f-14 d-none bank-error">Enter complete bank details</p>
                                            <button class="ticket-fill py-4 mb-3 w-100" type="button"
                                                data-bs-toggle="modal" data-bs-target="#bankModal"><i
                                                    class="fa-solid fa-circle-plus me-2"></i> Add
                                                Bank Details</button>

                                            <div class="accordion" id="accordionExample">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingOne">
                                                        <button class="accordion-button accordian-invoice-icon collapsed"
                                                            type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseOne" aria-expanded="true"
                                                            aria-controls="collapseOne">
                                                            <i class="fa-solid fa-circle-plus me-2"></i> Add Terms &
                                                            Conditions
                                                        </button>
                                                    </h2>
                                                    <div id="collapseOne" class="accordion-collapse collapse "
                                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <textarea name="terms_n_conditions" rows="5" class="border-0 " style="width: 100%; outline: none;"
                                                                placeholder="Add Details...">{{ $invoice->terms_n_conditions }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingTwo">
                                                        <button class="accordion-button accordian-invoice-icon collapsed"
                                                            type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseTwo" aria-expanded="false"
                                                            aria-controls="collapseTwo">
                                                            <i class="fa-solid fa-circle-plus me-2"></i>Add
                                                            Notes
                                                        </button>
                                                    </h2>
                                                    <div id="collapseTwo" class="accordion-collapse collapse"
                                                        aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <textarea name="note" rows="5" class="border-0 " style="width: 100%; outline: none;"
                                                                placeholder="Add Details...">{{ $invoice->note }}</textarea>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>


                                        </div>
                                    </div>
                                    <div class="col-lg-6 mt-4 ">
                                        <h1 class="invoice-heading text-primary mb-4">Summary</h1>
                                        <div class="box-gray h-auto box-p">
                                            <div class="summary-div d-flex justify-content-between">
                                                <p class="f-20 w-500 text-primary mb-0 pb-0">Total Amount
                                                </p>

                                                <input type="hidden" name="grand_total" id="grand-total"
                                                    value="0">

                                                <p class="f-20 w-500 text-primary mb-0 pb-0">$<span
                                                        class="grand-total">{{ $total_price }}</span></p>
                                            </div>
                                        </div>
                                        <button class="ticket-fill ms-auto mt-3" id="save-invoice">Save Invoice</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- </div> -->
    </main>

    <!-- Hidden template for cloning -->
    <div class="item-add-box-template " style="display: none;">
        <div class="row item-add-box mt-4 item-template">
            <div class="col-lg-12 ">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h2 class="f-16 w-500 text-primary">Item (1):</h2>
                    <div>
                        <i class="fa-solid fa-trash-xmark text-danger f-20 ms-2"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mb-lg-0 mb-3">
                <label for="" class="invoice-label">Item
                    Description</label>
                <div class="selectBox bg-white">
                    <input type="text" required name="descriptions[]" class="w-100" placeholder="">
                </div>
            </div>
            <div class="col-lg-2 col-md-6 mb-lg-0 mb-3">
                <label for="" class="invoice-label">Price</label>
                <div class="selectBox bg-white">
                    <input type="text" required name="prices[]" pattern="[0-9]+(\.[0-9]+)?"
                        oninput="validateNumbers(this)" class="w-100" placeholder="">
                </div>
            </div>
            <div class="col-lg-2 col-md-6 mb-lg-0 mb-3">
                <label for="" class="invoice-label">Quantity</label>
                <div class="selectBox bg-white">
                    <input type="text" required name="quantities[]" pattern="[0-9]+(\.[0-9]+)?"
                        oninput="validateNumbers(this)" class="w-100" placeholder="">
                </div>
            </div>
            <div class="col-lg-2 col-md-6 mb-lg-0 mb-3">
                <label for="" class="invoice-label">Total</label>
                <div class="selectBox bg-white">
                    <input type="text" required readonly class="w-100 total" placeholder="">
                </div>
            </div>

        </div>
    </div>

    <!-- Bank Modal -->
    <div class="modal fade" id="bankModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-medium">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Bank Details</h5>
                    <button type="button" class=" close-btn text-white" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fa-duotone fa-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" required value="{{ $invoice->account_holder_name }}"
                                            name="account_holder_name" class="form-control crm-input" id="name"
                                            placeholder="Mickel">
                                        <label class="crm-label form-label" for="name">Account Holder Name<span
                                                class="text-danger">*</span></label>
                                        @error('account_holder_name')
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" required value="{{ $invoice->bank_name }}"
                                            name="bank_name" class="form-control crm-input" id="bank-name"
                                            placeholder="Mickel">
                                        <label class="crm-label form-label" for="bank-name">Bank name<span
                                                class="text-danger">*</span></label>
                                        @error('bank_name')
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" required value="{{ $invoice->ifsc_code }}"
                                            name="ifsc_code" class="form-control crm-input" id="code"
                                            placeholder="ABC">
                                        <label class="crm-label form-label" for="code">IFSC Code<span
                                                class="text-danger">*</span></label>
                                        @error('ifsc_code')
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" required value="{{ $invoice->account_number }}"
                                            name="account_number" class="form-control crm-input" id="acc-num"
                                            placeholder="ABC">
                                        <label class="crm-label form-label" for="acc-num">Account Number<span
                                                class="text-danger">*</span></label>
                                        @error('account_number')
                                            <small class="invalid-feedback " style="font-size: 11px">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-lg-end justify-content-center mt-3 mb-3">
                                        <button type="button" class="modal-btn-cancel me-3"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="button" class="modal-btn-save save-bank"
                                            data-bs-dismiss="modal">Save
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

    <!-- Preview Modal -->
    <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">

            <div class="modal-content invoice-content">
                <button class="ticket-fill invoice-download"><i class="fa fa-download f-18 me-2"
                        aria-hidden="true"></i>Download</button>
                <div
                    class="modal-header d-flex flex-md-row flex-column align-items-md-center align-items-start border-bottom-0">
                    <img src="{{ asset('images/DigiSplix-Logo-for-Light-Mode.png') }}" alt=""
                        class="img-fluid modal-logo">
                    <div class="mt-md-0 mt-3 pe-2 text-gray">
                        <p class="mb-0 pb-0 f-16 w-500 d-flex justify-content-between">Invoice # : <span class="ms-3"
                                id="pv-invoice-id"></span></p>
                        <p class="mb-0 pb-0 f-16 w-500 d-flex justify-content-between">Date : <span
                                class="ms-3">{{ now()->format('d/m/Y') }}</span></p>
                    </div>
                </div>
                <div class="modal-body p-0">
                    <div class="col-lg-12 mb-4 mt-2">
                        <div class="invoice-heading-row">
                            <h1 class="invoice-heading mb-0 pb-0">INVOICE</h1>
                        </div>
                    </div>
                    <div class="px-4 mt-md-0 mt-3">
                        <div class="row align-items-center">
                            <div class="col-lg-6 mb-lg-0 mb-4 mx-auto">
                                <div class="border-right">
                                    <h1 class="invoice-heading text-dark-clr">Invoice From:</h1>
                                    <div class="  w-500 f-16 text-dark-clr" id="pv-invoice-from"></div>
                                    {{-- <p class="f-14 w-400  mb-0 pb-0 text-dark-clr">5900 Balcones Dr #15419
                                    </p>
                                    <p class="f-14 w-400  mb-0 pb-0 text-dark-clr">Austin, Texas 78731,
                                    </p>
                                    <p class="f-14 w-400  mb-0 pb-0 text-dark-clr">United States
                                    </p> --}}
                                </div>
                            </div>
                            <div class="col-lg-6 mb-lg-0 mb-4 mx-auto">
                                <div class="border-right">
                                    <h1 class="invoice-heading  text-dark-clr">Invoice To:</h1>
                                    <div class="  w-500 f-16 text-dark-clr" id="pv-invoice-to"></div>
                                    {{-- <p class="f-14 w-400  mb-0 pb-0 text-dark-clr">45 Balcones STE 200,
                                    </p>
                                    <p class="f-14 w-400  mb-0 pb-0 text-dark-clr">Los Anageles, Califronia</p>
                                    <p class="f-14 w-400  mb-0 pb-0 text-dark-clr">United States</p> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4">
                        <div class="row mt-4 ">
                            <div class="col-lg-12">
                                <div class=" dasboard-table h-auto"
                                    style="height: fit-content !important; border: 1px solid #ccc; border-bottom: none;">
                                    <table class="table data-table-style mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">SL NO.</th>
                                                <th scope="col">Item Description</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Qty.</th>
                                                <th scope="col">Total
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="pv-items">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4 ">
                        <div class="col-lg-6 ">
                            <div class="ps-4">
                                <h1 class="f-16 w-600 text-dark-clr">Thank you for your business</h1>

                                <div class="mt-3 mb-2 text-dark-clr">
                                    <h1 class="f-16 w-600">Payment Info:</h1>
                                    <p class="mb-0 pb-0 f-14 w-500">Account# : <span class="ms-3"
                                            id="pv-acc-num"></span></p>
                                    <p class="mb-0 pb-0 f-14 w-500">A/C Name : <span class="ms-3"
                                            id="pv-acc-name"></span></p>
                                    <p class="mb-0 pb-0 f-14 w-500">Bank Name : <span class="ms-3"
                                            id="pv-bank-name"></span></p>
                                    <p class="mb-0 pb-0 f-14 w-500">IFSC Code : <span class="ms-3"
                                            id="pv-ifsc-code"></span></p>
                                </div>
                                <div class=" mt-3 text-dark-clr" id="pv-terms-conditions">
                                    <h1 class="f-16 w-600">Terms & Conditions:</h1>
                                    <p class="mb-0 pb-0 f-14 w-500"></p>
                                </div>
                                <div class=" mt-3 text-dark-clr" id="pv-note">
                                    <h1 class="f-16 w-600">Note:</h1>
                                    <p class="mb-0 pb-0 f-14 w-500"></p>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-5 ms-auto ">
                            <div class="box-gray h-auto box-p bg-white border-0 p-0 text-dark-clr"
                                style="background-color: transparent !important;">
                                <div class="summary-box pe-4 ps-3" style="background-color: transparent;">
                                    <div class="summary-div d-flex justify-content-between mb-1">
                                        <p class="f-14 w-400 text-gray mb-0 pb-0">Sub Total:</p>
                                        <p class="f-14 w-400 text-gray mb-0 pb-0 pv-total"></p>
                                    </div>
                                    {{-- <div class="summary-div d-flex justify-content-between mt-1">
                                        <p class="f-14 w-400 text-gray mb-0 pb-0">Discount:</p>
                                        <p class="f-14 w-400 text-gray mb-0 pb-0">$22</p>
                                    </div> --}}

                                </div>

                                <div class="summary-div-total d-flex justify-content-between  pe-4 mt-3 ps-3">
                                    <p class="f-16 w-500   mb-0 pb-0">Total Amount
                                    </p>
                                    <p class="f-16 w-400   mb-0 pb-0 pv-total"></p>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-12 mt-3 ">
                            <div class="invoice-footer px-4">
                                <p class="mb-0 pb-0 f-14 w-500 text-gray"><span><i
                                            class="bi bi-envelope-fill text-primary me-1"></i></span> info@digisplix.com
                                </p>
                                <p class="mb-0 pb-0 f-14 w-500 text-gray "><span class="w-600"><i
                                            class="bi bi-browser-chrome text-primary me-1"></i></span>
                                    www.digisplix.com</p>
                                <p class="mb-0 pb-0 f-14 w-500 text-gray"><span><i
                                            class="bi bi-telephone-fill text-primary me-1"></i></span> +17373388038</p>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const downloadButton = document.querySelector(".invoice-download");
            downloadButton.addEventListener("click", function() {
                window.jsPDF = window.jspdf.jsPDF;
                const pdf = new jsPDF();
                const modalContent = document.querySelector(".invoice-content");
                console.log("clicked")
                pdf.html(modalContent, {
                    callback: function(pdf) {
                        pdf.save("invoice.pdf");
                    },
                });
            });
        });
    </script>
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
        $(document).ready(function() {
            // Get all selectBox and checkBoxes elements
            const $selectBoxes = $(".selectBox");
            const $checkBoxesList = $(".checkBoxes");

            // Add click event listener to each selectBox
            $selectBoxes.on("click", function() {
                // Toggle the display of the corresponding checkBoxes element
                const index = $selectBoxes.index(this);
                $checkBoxesList.eq(index).toggle();
            });

            // Close the dropdown when clicking outside of any selectBox
            $(document).on("click", function(event) {
                $selectBoxes.each(function(index) {
                    if (!$selectBoxes.eq(index).has(event.target).length) {
                        $checkBoxesList.eq(index).hide();
                    }
                });
            });

            // Prevent the dropdown from closing when clicking inside it
            $checkBoxesList.on("click", function(event) {
                event.stopPropagation();
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            const addItemButton = $(".add-item");
            const itemAddBoxDiv = $(".item-add-box-div");
            const itemAddBoxTemplate = $(".item-add-box-template");

            // Counter to keep track of the number of items added
            let itemCount = $(".item-add-box-div .item-add-box").length;

            addItemButton.on("click", function() {
                // Clone the item-add-box template
                const newItemAddBox = itemAddBoxTemplate.clone().appendTo(itemAddBoxDiv);
                newItemAddBox.show(); // Show the cloned item
                newItemAddBox.find('.item-add-box').removeClass('item-template');

                // Update the title for the new item
                const itemTitle = newItemAddBox.find(".f-16.w-500.text-primary");
                itemTitle.text(`Item (${++itemCount}):`);

                updateNames();

                // Add event listener to the trash icon for removal
                // const trashIcon = newItemAddBox.find(".fa-trash-xmark");
                // trashIcon.on("click", function() {
                //     // Remove the parent .item-add-box when the trash icon is clicked
                //     newItemAddBox.remove();
                //     itemCount--;

                //     // Update input names after removal
                //     updateNames();
                // });
            });

            // Add event listener to the item-add-box-div for trash icon click (event delegation)
            itemAddBoxDiv.on("click", ".fa-trash-xmark", function() {
                // Find the closest .item-add-box and remove it
                const itemAddBox = $(this).closest(".item-add-box");
                if (itemAddBox) {
                    itemAddBox.remove();
                    itemCount--;

                    // Update input names after removal
                    updateNames();
                }
            });

            // Function to update input names based on their index
            function updateNames() {
                $(".item-add-box").each(function(index) {
                    $(this).find("input[name^='descriptions']").attr("name", `descriptions[${index}]`);
                    $(this).find("input[name^='prices']").attr("name", `prices[${index}]`);
                    $(this).find("input[name^='quantities']").attr("name", `quantities[${index}]`);
                    $(this).find(".f-16.w-500.text-primary").text(`Item (${index+1}):`);;
                });
            }

            // Function to reindex input fields when needed
            function reindexInputFields() {
                itemCount = $(".item-add-box-div .item-add-box").length;
                updateNames();
            }
        });
    </script>

    <!-- recurring checked -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const checkbox = document.getElementById("flexCheckChecked");
            const recurringDetails = document.querySelector(".recurring-details");

            // Function to toggle the display style of recurringDetails
            function toggleRecurringDetails() {
                recurringDetails.style.display = checkbox.checked ? "block" : "none";
            }

            // Initial toggle based on the checkbox's initial state
            toggleRecurringDetails();

            // Add event listener to the checkbox for changes
            checkbox.addEventListener("change", toggleRecurringDetails);
        });
    </script>

    <script>
        $('#client').on('change', function() {
            $('#invoice_to').val($(this).find(':selected').text().trim())
        })
    </script>

    <script>
        function validateNumbers(input) {
            // Remove non-numeric characters, allowing for a single dot
            input.value = input.value.replace(/[^\d.]/g, '');

            // Ensure there is no more than one dot in the input
            input.value = input.value.replace(/\.+/g, '.');

            calculateTotal(input);
        }
    </script>

    {{-- Calculate total prices --}}
    <script>
        function calculateTotal(input) {
            var price = parseFloat($(input).closest('.row').find('input[name^="prices"]').val()) || 0;
            var quantity = parseFloat($(input).closest('.row').find('input[name^="quantities"]').val()) || 0;
            var total = price * quantity;

            console.log(price);
            console.log(quantity);

            $(input).closest('.row').find('.total').val(total);
            calculateGrandTotal();
        }

        function calculateGrandTotal() {
            var grandTotal = 0;

            $('.total').each(function() {
                grandTotal += parseFloat($(this).val()) || 0;
            });

            $('#grand-total').val(grandTotal)
            $('.grand-total').text(grandTotal)
        }
    </script>

    {{-- Save bank details --}}
    <script>
        $('#invoice-form').on('submit', function(e) {
            let accountHolderName = $('#name').val()
            let bankName = $('#bank-name').val()
            let ifscCode = $('#code').val()
            let accountNumber = $('#acc-num').val()

            $('.bank-error').addClass('d-none')

            if (
                accountHolderName.trim().length === 0 ||
                bankName.trim().length === 0 ||
                ifscCode.trim().length === 0 ||
                accountNumber.trim().length === 0
            ) {
                $('.bank-error').removeClass('d-none')
                return false;
            }

            $(this).append(`<input type="hidden" name="account_holder_name" value="${accountHolderName}">`)
            $(this).append(`<input type="hidden" name="bank_name" value="${bankName}">`)
            $(this).append(`<input type="hidden" name="ifsc_code" value="${ifscCode}">`)
            $(this).append(`<input type="hidden" name="account_number" value="${accountNumber}">`)

            $(this).unbind('submit').submit();
        })
    </script>

    {{-- Preview Invoice --}}
    <script id="pv-items-template" type="text/template">
    <tr class="">
            <td>{sr_num}</td>
            <td scope="row" style="white-space: normal;">
                {description}
            </td>
            <td>${price}</td>
            <td class="text-center">
                {qty}
            </td>
            <td>${total}</td>

        </tr>
    </script>

    <script>
        $('#previewBtn').click(function() {
            let invoice_id = $('input[name="invoice_id"]').val()
            let invoice_from = $('textarea[name="invoice_from"]').val()
            let invoice_to = $('textarea[name="invoice_to"]').val()
            let acc_num = $('input[name="account_number"]').val()
            let acc_name = $('input[name="account_holder_name"]').val()
            let bank_name = $('input[name="bank_name"]').val()
            let ifsc_code = $('input[name="ifsc_code"]').val()
            let termsNConditions = $('textarea[name="terms_n_conditions"]').val()
            let note = $('textarea[name="note"]').val()
            let total = $('input[name="grand_total"]').val()

            $('#pv-invoice-id').text(invoice_id)
            $('#pv-invoice-from').text(invoice_from)
            $('#pv-invoice-to').text(invoice_to)
            $('#pv-acc-num').text(acc_num)
            $('#pv-acc-name').text(acc_name)
            $('#pv-bank-name').text(bank_name)
            $('#pv-ifsc-code').text(ifsc_code)

            if (termsNConditions.trim().length > 0) {
                $('#pv-terms-conditions').css('display', 'block')
                $('#pv-terms-conditions p').text(termsNConditions)
            } else {
                $('#pv-terms-conditions').css('display', 'none')
            }

            if (note.trim().length > 0) {
                $('#pv-note').css('display', 'block')
                $('#pv-note p').text(note)
            } else {
                $('#pv-note').css('display', 'none')
            }

            $('.pv-total').text('$' + total)

            // Items
            $('.item-add-box:not(.item-template)').each(function(index, element) {
                var description = $(element).find('input[name="descriptions[]"]').val();
                var price = $(element).find('input[name="prices[]"]').val();
                var quantity = $(element).find('input[name="quantities[]"]').val();

                var total = price * quantity;

                var itemTemplate = $('#pv-items-template').html()
                var item = itemTemplate.replace('{sr_num}', index + 1)
                    .replace('{description}', description)
                    .replace('{price}', price)
                    .replace('{qty}', quantity)
                    .replace('{total}', total)

                $('#pv-items').append(item)
            });
        })
    </script>

    {{-- <script>
        let draftButtonClicked = false;

        $('#draftBtn').on('click', function() {
            draftButtonClicked = true;

            $('#save-invoice').click()
        })

        $('#save-invoice').on('click', function() {
            if (draftButtonClicked) {
                $('#invoice-form').append('<input type="hidden" value="draft" name="status">');
            }

            draftButtonClicked = false;
        });
    </script> --}}
@endsection
@endsection
