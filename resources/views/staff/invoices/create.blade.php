@extends('layouts.app')

@section('content')
    <main class="content">
        <div class="container-fluid px-lg-0">
            <div class="row justify-content-center">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-xl-12  mb-3">
                            <div class="box box-p">
                                <div
                                    class="d-flex align-items-lg-center justify-content-between flex-md-row flex-column align-items-start">
                                    <div class="d-flex align-items-center">
                                        <a href="invoice-list.html" class="text-gray text-dark-clr"> <i
                                                class="fa-solid fa-circle-left me-2"></i> Back to Invoice List</a>
                                    </div>

                                    <div
                                        class="d-flex  flex-md-row flex-column align-items-md-center align-items-start w-sm-100">
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#previewModal"
                                            class="d-flex align-items-center f-16 bg-transparent border-0 mt-md-0 mt-2 ps-0 text-dark-clr">
                                            <i class="fa-duotone fa-eye me-2"></i>Preview
                                        </button>
                                        <div class="d-flex  mt-md-0 mt-2 justify-content-center w-100">
                                            <button class="ticket-fill ms-3">Save Draft</button>
                                            <button class="ticket-blank ms-2">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('staff.invoices.store') }}" method="post" id="invoice-form">
                        @csrf
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
                                                        <label for="" class="invoice-label">Customer Name</label>
                                                        <select name="client" id="client" class="form-select form-select-sm mt-2"
                                                        >
                                                            @foreach ($clients as $client)
                                                                <option value="{{ $client->id }}">
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
                                                        <select name="category" id="category" class="form-select form-select-sm mt-2">
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}">{{ $category->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-lg-0 mb-4">
                                                        <label for="" class="invoice-label">Select</label>
                                                        <div class="form-check mt-2">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="flexCheckChecked" name="recurring">
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
                                                                    <input type="month" name="start_from" class="w-100"
                                                                        placeholder="Enter references No.">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="">
                                                            <div class="multipleSelection mt-4">
                                                                <div class="selectBox bg-white">
                                                                    <input type="number" name="duration" min="1"
                                                                        class="w-100" placeholder="Enter Months">
                                                                </div>
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
                                                $invoiceItems = old('descriptions', ['']); // Set the desired number of items
                                            @endphp

                                            @for ($i = 0; $i < count($invoiceItems); $i++)
                                                <div class="row item-add-box mt-4">
                                                    <div class="col-lg-12 ">
                                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                                            <h2 class="f-16 w-500 text-primary">Item ({{ $i + 1 }}):
                                                            </h2>
                                                            <div>
                                                                <i
                                                                    class="fa-solid fa-trash-xmark text-danger f-20 ms-2"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 mb-lg-0 mb-3">
                                                        <label for="" class="invoice-label">Item Description</label>
                                                        <div class="selectBox bg-white">
                                                            <input type="text" required name="descriptions[]"
                                                                class="w-100" value="{{ old('descriptions.' . $i) }}"
                                                                placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-6 mb-lg-0 mb-3">
                                                        <label for="" class="invoice-label">Price</label>
                                                        <div class="selectBox bg-white">
                                                            <input type="text" required name="prices[]"
                                                                pattern="[0-9]+" oninput="validateNumbers(this)"
                                                                class="w-100" value="{{ old('prices.' . $i) }}"
                                                                placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-6 mb-lg-0 mb-3">
                                                        <label for="" class="invoice-label">Quantity</label>
                                                        <div class="selectBox bg-white">
                                                            <input type="text" required name="quantities[]"
                                                                pattern="[0-9]+" oninput="validateNumbers(this)"
                                                                class="w-100" value="{{ old('quantities.' . $i) }}"
                                                                placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-6 mb-lg-0 mb-3">
                                                        <label for="" class="invoice-label">Total</label>
                                                        <div class="selectBox bg-white">
                                                            <input type="text" required readonly class="w-100 total"
                                                                placeholder="">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endfor
                                            <!-- Hidden template for cloning -->
                                            {{-- <div class="item-add-box-template " style="display: none;">
                                                <div class="row item-add-box mt-4">
                                                    <div class="col-lg-12 ">
                                                        <div
                                                            class="d-flex align-items-center justify-content-between mb-3">
                                                            <h2 class="f-16 w-500 text-primary">Item (1):</h2>
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
                                                            <input type="text" required name="descriptions[]"
                                                                class="w-100" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-6 mb-lg-0 mb-3">
                                                        <label for="" class="invoice-label">Price</label>
                                                        <div class="selectBox bg-white">
                                                            <input type="text" required name="prices[]"
                                                                pattern="[0-9]+" oninput="validateNumbers(this)"
                                                                class="w-100" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-6 mb-lg-0 mb-3">
                                                        <label for="" class="invoice-label">Quantity</label>
                                                        <div class="selectBox bg-white">
                                                            <input type="text" required name="quantities[]"
                                                                pattern="[0-9]+" oninput="validateNumbers(this)"
                                                                class="w-100" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-6 mb-lg-0 mb-3">
                                                        <label for="" class="invoice-label">Total</label>
                                                        <div class="selectBox bg-white">
                                                            <input type="text" required readonly class="w-100 total"
                                                                placeholder="">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div> --}}
                                        </div>

                                    </div>
                                    <div class="col-lg-4 mt-4">
                                        <div class="box-gray box-p">
                                            <h1 class="invoice-heading text-primary mb-4">Invoice Details</h1>
                                            <div>

                                                <div class="d-flex align-items-center mb-2">
                                                    <div class="invoice-label">Invoice NO&nbsp;:&nbsp;</div>
                                                    <div class="invoice-value" style="outline: none !important;">
                                                        #{{ $invoice_number }}</div>
                                                    <input type="hidden" name="invoice_id"
                                                        value="{{ $invoice_number }}">
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div class="invoice-label">Due Date&nbsp;:&nbsp;</div>
                                                    <div class="invoice-value"><input type="date" required
                                                            name="due_date" value=""
                                                            class="border-0 bg-transparent text-primary invoice-date"
                                                            style="outline: none;"></div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mt-4">
                                        <div class="box-gray box-p">
                                            <h1 class="invoice-heading text-primary mb-4">Invoice From
                                            </h1>
                                            <textarea name="invoice_from" required id="invoice_from" rows="3" class="border-0 f-14 w-400 bg-transparent"
                                                style="width: 100%; outline: none;">{{ $admin->name }}</textarea>

                                        </div>
                                    </div>
                                    <div class="col-lg-4 mt-4">
                                        <div class="box-gray box-p">
                                            <h1 class="invoice-heading text-primary mb-4">Invoice To</h1>
                                            <textarea name="invoice_to" required id="invoice_to" rows="3" class="border-0 f-14 w-400 bg-transparent"
                                                style="width: 100%; outline: none;">{{ $clients->first()->user->name }}</textarea>



                                        </div>
                                    </div>
                                    <div class="col-lg-6 mt-4 ">
                                        <h1 class="invoice-heading text-primary mb-4">More Fields</h1>
                                        <div class="box-gray h-auto box-p text-center ">
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
                                                                placeholder="Add Details..."></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingTwo">
                                                        <button class="accordion-button accordian-invoice-icon collapsed"
                                                            type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseTwo" aria-expanded="false"
                                                            aria-controls="collapseTwo">
                                                            <i class="fa-solid fa-circle-plus me-2"></i>Add Notes
                                                        </button>
                                                    </h2>
                                                    <div id="collapseTwo" class="accordion-collapse collapse"
                                                        aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <textarea name="note" rows="5" class="border-0 " style="width: 100%; outline: none;"
                                                                placeholder="Add Details..."></textarea>

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

                                                <input type="hidden" id="grand-total" value="0">

                                                <p class="f-20 w-500 text-primary mb-0 pb-0">$<span
                                                        class="grand-total"></span></p>
                                            </div>
                                        </div>
                                        <button class="ticket-fill ms-auto mt-3" id="save-invoice">Save Invoice</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>

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
        <!-- </div> -->
    </main>

    <!-- Hidden template for cloning -->
    <div class="item-add-box-template " style="display: none;">
        <div class="row item-add-box mt-4">
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
                    <input type="text" required name="prices[]" pattern="[0-9]+" oninput="validateNumbers(this)"
                        class="w-100" placeholder="">
                </div>
            </div>
            <div class="col-lg-2 col-md-6 mb-lg-0 mb-3">
                <label for="" class="invoice-label">Quantity</label>
                <div class="selectBox bg-white">
                    <input type="text" required name="quantities[]" pattern="[0-9]+" oninput="validateNumbers(this)"
                        class="w-100" placeholder="">
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
                                        <input type="text" required name="account_holder_name"
                                            class="form-control crm-input" id="name" placeholder="Mickel">
                                        <label class="crm-label form-label" for="name">Account Holder Name<span
                                                class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" required name="bank_name" class="form-control crm-input"
                                            id="bank-name" placeholder="Mickel">
                                        <label class="crm-label form-label" for="bank-name">Bank name<span
                                                class="text-danger">*</span></label>
                                    </div>
                                </div>


                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" required name="ifsc_code" class="form-control crm-input"
                                            id="code" placeholder="ABC">
                                        <label class="crm-label form-label" for="code">IFSC Code<span
                                                class="text-danger">*</span></label>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" required name="account_number"
                                            class="form-control crm-input" id="acc-num" placeholder="ABC">
                                        <label class="crm-label form-label" for="acc-num">Account Number<span
                                                class="text-danger">*</span></label>
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
                    <img src="assets/images/DigiSplix-Logo-for-Light-Mode.png" alt=""
                        class="img-fluid modal-logo">
                    <div class="mt-md-0 mt-3 pe-2 text-gray">
                        <p class="mb-0 pb-0 f-16 w-500 d-flex justify-content-between">Invoice # : <span
                                class="ms-3">In8782</span></p>
                        <p class="mb-0 pb-0 f-16 w-500 d-flex justify-content-between">Date : <span
                                class="ms-3">07/08/2023</span></p>
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
                                    <div class="  w-500 f-16 text-dark-clr">DigiSplix, LLC </div>
                                    <p class="f-14 w-400  mb-0 pb-0 text-dark-clr">5900 Balcones Dr #15419
                                    </p>
                                    <p class="f-14 w-400  mb-0 pb-0 text-dark-clr">Austin, Texas 78731,
                                    </p>
                                    <p class="f-14 w-400  mb-0 pb-0 text-dark-clr">United States
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-lg-0 mb-4 mx-auto">
                                <div class="border-right">
                                    <h1 class="invoice-heading  text-dark-clr">Customer:</h1>
                                    <div class="  w-500 f-16 text-dark-clr">Mike Roofers</div>
                                    <p class="f-14 w-400  mb-0 pb-0 text-dark-clr">45 Balcones STE 200,
                                    </p>
                                    <p class="f-14 w-400  mb-0 pb-0 text-dark-clr">Los Anageles, Califronia</p>
                                    <p class="f-14 w-400  mb-0 pb-0 text-dark-clr">United States</p>
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
                                        <tbody>
                                            <tr class="">
                                                <td>1.</td>
                                                <td scope="row" style="white-space: normal;">
                                                    ipsum dolor sit, consectetur elit.
                                                </td>
                                                <td>$50,00</td>
                                                <td class="text-center">
                                                    1
                                                </td>
                                                <td>%50,00</td>

                                            </tr>
                                            <tr class="">
                                                <td>2.</td>
                                                <td scope="row" style="white-space: normal;">
                                                    ipsum dolor sit, consectetur elit.
                                                </td>
                                                <td>$50,00</td>
                                                <td class="text-center">
                                                    1
                                                </td>
                                                <td>%50,00</td>

                                            </tr>
                                            <tr class="">
                                                <td>3.</td>
                                                <td scope="row" style="white-space: normal;">
                                                    ipsum dolor sit, consectetur elit.
                                                </td>
                                                <td>$50,00</td>
                                                <td class="text-center">
                                                    1
                                                </td>
                                                <td>%50,00</td>

                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4 ">
                        <div class="col-lg-6 ">
                            <div class="ps-4">
                                <h1 class="f-16 w-600 text-dark-clr">Thank you for your bussiness</h1>

                                <div class="mt-3 mb-2 text-dark-clr">
                                    <h1 class="f-16 w-600">Payment Info:</h1>
                                    <p class="mb-0 pb-0 f-14 w-500">Account# : <span class="ms-3">In8782</span></p>
                                    <p class="mb-0 pb-0 f-14 w-500">A/C Name : <span class="ms-3">Lorem ipsum dolor
                                            sit.</span></p>
                                    <p class="mb-0 pb-0 f-14 w-500">Bank Details : <span
                                            class="ms-3">XXX552425172672F34</span></p>
                                </div>
                                <div class=" mt-3 text-dark-clr">
                                    <h1 class="f-16 w-600">Terms & Conditions:</h1>
                                    <p class="mb-0 pb-0 f-14 w-500">Lorem ipsum dolor sit amet consectetur adipisicing
                                        elit. </p>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-5 ms-auto ">
                            <div class="box-gray h-auto box-p bg-white border-0 p-0 text-dark-clr"
                                style="background-color: transparent !important;">
                                <div class="summary-box pe-4 ps-3" style="background-color: transparent;">
                                    <div class="summary-div d-flex justify-content-between mb-1">
                                        <p class="f-14 w-400 text-gray mb-0 pb-0">Sub Total:</p>
                                        <p class="f-14 w-400 text-gray mb-0 pb-0">$220.00</p>
                                    </div>
                                    <div class="summary-div d-flex justify-content-between mt-1">
                                        <p class="f-14 w-400 text-gray mb-0 pb-0">Discount:</p>
                                        <p class="f-14 w-400 text-gray mb-0 pb-0">$22</p>
                                    </div>

                                </div>

                                <div class="summary-div-total d-flex justify-content-between  pe-4 mt-3 ps-3">
                                    <p class="f-16 w-500   mb-0 pb-0">Total Amount
                                    </p>
                                    <p class="f-16 w-400   mb-0 pb-0">534$</p>
                                </div>

                                <div class="d-flex align-items-center justify-content-center flex-column w-100 px-4 pt-3 ">
                                    <img src="assets/images/signature.png" alt="" class="img-fluid">
                                    <div class="sign-text w-100">
                                        <p class="text-center">Autorized Sign</p>
                                    </div>
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
        document.addEventListener("DOMContentLoaded", function() {
            const addItemButton = document.querySelector(".add-item");
            const itemAddBoxDiv = document.querySelector(".item-add-box-div");
            const itemAddBoxTemplate = document.querySelector(".item-add-box-template");

            // Counter to keep track of the number of items added
            let itemCount = 1;

            addItemButton.addEventListener("click", function() {
                // Clone the item-add-box template
                const newItemAddBox = itemAddBoxTemplate.cloneNode(true);
                newItemAddBox.style.display = "block"; // Show the cloned item

                // Update the title for the new item
                const itemTitle = newItemAddBox.querySelector(".f-16.w-500.text-primary");
                itemTitle.textContent = `Item (${++itemCount}):`;

                // Add the cloned item-add-box to the item-add-box-div
                itemAddBoxDiv.appendChild(newItemAddBox);

                // Add event listener to the trash icon for removal
                const trashIcon = newItemAddBox.querySelector(".fa-trash-xmark");
                trashIcon.addEventListener("click", function() {
                    // Remove the parent .item-add-box when the trash icon is clicked
                    itemAddBoxDiv.removeChild(newItemAddBox);
                });
            });

            // Add event listener to the item-add-box-div for trash icon click (event delegation)
            itemAddBoxDiv.addEventListener("click", function(event) {
                if (event.target.classList.contains("fa-trash-xmark")) {
                    // Find the closest .item-add-box and remove it
                    const itemAddBox = event.target.closest(".item-add-box");
                    if (itemAddBox) {
                        itemAddBoxDiv.removeChild(itemAddBox);
                    }
                }
            });
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
            $('#invoice_to').val($(this).find(':selected').text())
        })
    </script>

    <script>
        function validateNumbers(input) {
            // Remove non-numeric characters
            input.value = input.value.replace(/\D/g, '');

            calculateTotal(input);
        }
    </script>

    {{-- Calculate total prices --}}
    <script>
        function calculateTotal(input) {
            var price = parseFloat($(input).closest('.row').find('input[name="prices[]"]').val()) || 0;
            var quantity = parseFloat($(input).closest('.row').find('input[name="quantities[]"]').val()) || 0;
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

            $(this).append(`<input type="text" name="account_holder_name" value="${accountHolderName}">`)
            $(this).append(`<input type="text" name="bank_name" value="${bankName}">`)
            $(this).append(`<input type="text" name="ifsc_code" value="${ifscCode}">`)
            $(this).append(`<input type="text" name="account_number" value="${accountNumber}">`)

            $(this).submit()
        })
    </script>
@endsection
@endsection
