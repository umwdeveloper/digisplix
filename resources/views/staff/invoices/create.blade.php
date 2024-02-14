@extends('layouts.app')

@section('content')
    <main class="content">
        <div class="container-fluid px-lg-0">
            <div class="row justify-content-center">
                <form action="{{ route('staff.invoices.store') }}" method="post" id="invoice-form">
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
                                                                        {{ $client->id == old('client_id') ? 'selected' : '' }}
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
                                                                    {{ $category->id == old('category_id') ? 'selected' : '' }}
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
                                                            <input {{ old('recurring') == '1' ? 'checked' : '' }}
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
                                                                        placeholder="Enter references No.">
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
                                                                        class="w-100" placeholder="Enter Months">
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
                                                $invoiceItems = old('descriptions', ['']); // Set the desired number of items
                                            @endphp

                                            @for ($i = 0; $i < count($invoiceItems); $i++)
                                                <div class="row item-add-box mt-4">
                                                    <div class="col-lg-12 ">
                                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                                            <h2 class="f-16 w-500 text-primary">Item
                                                                ({{ $i + 1 }}):
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
                                                            <input type="text" required name="descriptions[]"
                                                                class="w-100" value="{{ old('descriptions.' . $i) }}"
                                                                placeholder="">
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
                                                            <input type="text" required name="prices[]"
                                                                pattern="[0-9]+(\.[0-9]+)?"
                                                                oninput="validateNumbers(this)" class="w-100"
                                                                value="{{ old('prices.' . $i) }}" placeholder="">
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
                                                            <input type="text" required name="quantities[]"
                                                                pattern="[0-9]+(\.[0-9]+)?"
                                                                oninput="validateNumbers(this)" class="w-100"
                                                                value="{{ old('quantities.' . $i) }}" placeholder="">
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
                                                                placeholder="">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endfor
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
                                                        #{{ $invoice_number }}</div>
                                                    <input type="hidden" name="invoice_id"
                                                        value="{{ $invoice_number }}">
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div class="invoice-label">Due Date&nbsp;:&nbsp;</div>
                                                    <div class="invoice-value"><input type="date" id="due_date"
                                                            required name="due_date" value="{{ old('due_date') }}"
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
                                                style="width: 100%; outline: none;">DigiSplix, LLC&#13;&#10;5900 Balcones Dr #15419&#13;&#10;Austin, Texas 78731,&#13;&#10;United States</textarea>

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
                                                style="width: 100%; outline: none;">{{ optional($clients->first())->user->name ?? '' }}</textarea>



                                        </div>
                                    </div>
                                    <div class="col-lg-6 mt-4 ">
                                        <h1 class="invoice-heading text-primary mb-4">More Fields</h1>
                                        <div class="box-gray h-auto box-p text-center ">

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

                                                <input type="hidden" name="grand_total" id="grand-total"
                                                    value="0">

                                                <p class="f-20 w-500 text-primary mb-0 pb-0">$<span
                                                        class="grand-total">0</span></p>
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

    <!-- Preview Modal -->
    <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" style="height: 100%">

            <div class="modal-content" style="height: 100%">
                <button class="ticket-fill invoice-download"><i class="fa fa-download f-18 me-2"
                        aria-hidden="true"></i>Download</button>
                <div class="modal-body p-0">
                    <iframe width="100%" height="100%" id="preview-frame" src="" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"
        integrity="sha512-qZvrmS2ekKPF2mSznTQsxqPgnpkI4DNTlrdUmTzrDgektczlKNRRhy5X5AAOnx5S09ydFYWWNSfcEqDTTHgtNA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"
        integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.1/jspdf.plugin.autotable.min.js"
        integrity="sha512-8+n4PSpp8TLHbSf28qpjRfu51IuWuJZdemtTC1EKCHsZmWi2O821UEdt6S3l4+cHyUQhU8uiAAUeVI1MUiFATA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/canvg/1.1/canvg.js"
        integrity="sha512-Qw1+j4vl/AjCqxrx/omDzobdEepDHathD3Z0bwulQSrLlaTtTWhiH3sMSDU4oK2TP2EfyzHgg33gh2zxUAI3EQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('js/Poppins-Regular-normal.js') }}"></script>
    <script src="{{ asset('js/Poppins-Bold-normal.js') }}"></script>

    <script>
        const baseUrl = '{{ url('/') }}';
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
                newItemAddBox.querySelector('.item-add-box').classList.remove('item-template')

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
        var pdfData = {};

        $('#previewBtn').click(function() {
            $('#preview-frame').attr('src', '')
            let invoice_id = $('input[name="invoice_id"]').val()
            let invoice_from = $('textarea[name="invoice_from"]').val()

            // Extract "DigiSplix, LLC" and make it bold
            let companyName = invoice_from.split('5900')[0];
            let formatted_invoice_from = `<b>${companyName}</b>${invoice_from.substring(companyName.length)}`;

            let invoice_to = $('textarea[name="invoice_to"]').val()
            let termsNConditions = $('textarea[name="terms_n_conditions"]').val()
            let note = $('textarea[name="note"]').val()
            let total = $('input[name="grand_total"]').val()
            let due_date = $('#due_date').val()

            pdfData.invoice_id = invoice_id
            pdfData.invoice_from = invoice_from
            pdfData.invoice_to = invoice_to
            pdfData.termsNConditions = termsNConditions
            pdfData.note = note
            pdfData.total = total
            pdfData.due_date = due_date

            pdfData.items = []
            $('.item-add-box:not(.item-template)').each(function(index, element) {
                var description = $(element).find('input[name="descriptions[]"]').val();
                var price = $(element).find('input[name="prices[]"]').val();
                var quantity = $(element).find('input[name="quantities[]"]').val();

                var total = price * quantity;

                pdfData.items.push({
                    description,
                    price,
                    quantity,
                    total
                })
            });
        })
    </script>

    <script>
        $('#previewModal').on('shown.bs.modal', function() {
            generatePDF(pdfData)
        })

        $('.invoice-download').click(function() {
            downloadPDF(pdfData.invoice_id)
        })
    </script>
@endsection
@endsection
