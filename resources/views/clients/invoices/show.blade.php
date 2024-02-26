@extends('layouts.client')

@section('content')
    <main class="content">
        <div class="container-fluid px-lg-0">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-10 mx-auto  mb-3">
                    <div class="box box-p">
                        <div
                            class="d-flex align-items-lg-center justify-content-between flex-md-row flex-column align-items-start">
                            <div class="d-flex align-items-center">
                                <a href="{{ route('client.invoices.index') }}" class="text-gray"> <i
                                        class="fa-solid fa-circle-left me-2"></i> Back to
                                    Dashboard</a>
                            </div>

                            <div class="ms-auto d-flex pay-btns">
                                <!-- download -->
                                <div class="header-option align-self-center me-0 hide-sm me-3 ms-2">
                                    <i class="fa-duotone fa-download header-icon invoice-download-btn"
                                        style="color: #0963ce; cursor: pointer" data-id="{{ $invoice->id }}"></i>
                                </div>
                                <!-- pay -->
                                @if ($invoice->status == App\Models\Invoice::PAID)
                                    <div class="d-flex justify-content-center align-items-center">
                                        <button class="table-btn btn-success  px-2" type="button"
                                            style="background-color: #198754 !important">Paid <i
                                                class="bi bi-check-circle ms-1"></i></button>
                                    </div>
                                @elseif ($invoice->bank_subscription_active == '1')
                                    <div class="d-flex justify-content-center align-items-center">
                                        <button class="table-btn btn-success  px-2" type="button"
                                            style="background-color: #198754 !important">Active <i
                                                class="bi bi-check-circle ms-1"></i></button>
                                    </div>
                                @else
                                    @if ($invoice->status !== App\Models\Invoice::CANCELLED)
                                        <div class="d-flex justify-content-center me-3 align-items-center pay-now">
                                            <button class="table-btn px-2" type="button" id="payment-button"
                                                data-bs-toggle="modal" data-bs-target="#paymentModal">Pay Now <i
                                                    class="bi bi-coin ms-1"></i></button>
                                        </div>
                                        <div class="d-flex justify-content-center align-items-center pay-via-bank">
                                            <button class="table-btn px-2" type="button"
                                                onclick="window.location.href = '{{ route('client.invoices.bank', $invoice->id) }}'">Pay
                                                via Bank <i class="bi bi-bank ms-1"></i></button>
                                        </div>
                                    @endif
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-10 mx-auto mb-3" style="height: 100vh">
                    <div class="text-center" id="spinner">
                        <img width="20px" src="{{ asset('images/spinner.gif') }}">
                    </div>
                    <iframe width="100%" height="100%" id="preview-frame" src="" frameborder="0"></iframe>
                </div>
            </div>
        </div>
        <!-- </div> -->
    </main>

    <!-- Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Pay Invoice</h5>
                    <button type="button" class=" close-btn text-white" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fa-duotone fa-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="text-center" id="spinner">
                            <img width="20px" src="{{ asset('images/spinner.gif') }}">
                        </div>
                        <div id="checkout"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="modal-btn-cancel me-2" style="padding: 7px 20px"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="bankModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <strong>Note: </strong>
                        <p class="f-14 note">If your current balance is high enough then the amount will be deducted from
                            your
                            balance
                            otherwise you will get the bank details. If you
                            want to proceed please click Continue</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="modal-btn-cancel me-2" style="padding: 7px 20px"
                        data-bs-dismiss="modal">Close</button>
                    <button class="modal-btn-save" id="pay-bank" type="button">Continue</button>
                </div>
            </div>
        </div>
    </div>

@section('script')
    <script src="https://js.stripe.com/v3/"></script>

    <script>
        $(document).ready(function() {
            const stripe = Stripe('{{ config('custom.stripe_key') }}');
            // let amount = $('#amount').val()
            // let invoice_id = $('#invoice_id').val()
            // let invoice_number = $('#invoice_number').val()

            let amount = '{{ $invoice->total_price }}';
            let invoice_id = '{{ $invoice->id }}';
            let invoice_number = '{{ $invoice->invoice_id }}';

            async function initialize() {

                const response = await fetch('{{ route('payment.create') }}', {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}', // Include CSRF token if required
                    },
                    body: JSON.stringify({
                        amount,
                        invoice_id,
                        invoice_number
                    }),
                });

                const session = await response.json();

                console.log(session);

                const clientSecret = session.session.client_secret

                const checkout = await stripe.initEmbeddedCheckout({
                    clientSecret,
                });

                $('#spinner').addClass('d-none')

                // Mount Checkout
                checkout.mount('#checkout');
            }

            initialize();
        });
    </script>

    <script>
        $('#pay-bank').click(function() {
            let amount = '{{ $invoice->total_price }}';
            let client_id = '{{ $invoice->client->id }}';
            let invoice_id = '{{ $invoice->id }}';
            let invoice_number = '{{ $invoice->invoice_id }}';
            let recurring = '{{ $invoice->recurring }}';

            let due_date = '';

            if (recurring == 1) {
                due_date = '{{ $invoice->due_date }}';
            }

            $('.loading').removeClass('d-none')
            $('#bankModal').modal('hide')

            let url = '';

            if (recurring == 1) {
                url = "{{ route('payment.create_subscription') }}"
            } else {
                url = "{{ route('payment.create_payment_intent') }}"
            }

            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    amount,
                    client_id,
                    invoice_id,
                    invoice_number,
                    due_date,
                },
                success: function(response) {
                    console.log(response);

                    $('.loading').addClass('d-none')

                    if (response.generalError) {
                        $('#bankModal .note').text(response.generalError)
                        $('#bankModal #pay-bank').remove()
                        $('#bankModal').modal('show')
                    } else if (response.error) {
                        $('#bankModal .note').text(response.error)
                        $('#bankModal #pay-bank').remove()
                        $('#bankModal').modal('show')
                    } else if (response.paymentDetails.status == 'active') {
                        $('#bankModal .note').text(
                            "This subscription is active now and the bank details will be sent to you through email on due date."
                        )
                        $('#bankModal #pay-bank').remove()
                        $('#bankModal').modal('show')

                        $('.pay-now').remove()
                        $('.pay-via-bank').remove()
                        $('.pay-btns').append(`<div class="d-flex justify-content-center align-items-center">
                                        <button class="table-btn btn-success  px-2" type="button"
                                            style="background-color: #198754 !important">Active <i
                                                class="bi bi-check-circle ms-1"></i></button>
                                    </div>`)
                    } else if (response.paymentDetails.status == 'requires_action') {
                        var details = response.paymentDetails.next_action
                            .display_bank_transfer_instructions
                        var bank = {
                            'amount_remaining': details.amount_remaining,
                            'bank_name': details.financial_addresses[0].aba.bank_name,
                            'account_number': details.financial_addresses[0].aba.account_number,
                            'routing_number': details.financial_addresses[0].aba.routing_number,
                            'swift_code': details.financial_addresses[1].swift.swift_code,
                            'reference': details.reference,
                        }
                        var url = '{{ route('client.invoices.bank', 'invoice_id') }}' +
                            '?bankDetails=' +
                            encodeURIComponent(JSON.stringify(bank));
                        url = url.replace("invoice_id", invoice_id)
                        location.href = url
                    } else if (response.paymentDetails.status == "succeeded") {
                        location.href = '{{ route('payment.success') }}'
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error: ', status, error);
                }
            })
        })
    </script>

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
        var pdfData = {};
        $(document).ready(() => {
            let invoice_id = '{{ $invoice->id }}';

            $.ajax({
                url: '{{ route('client.invoices.fetch_invoice', 'invoice_id') }}'.replace(
                    'invoice_id',
                    invoice_id),
                type: 'PATCH',
                data: {
                    '_token': '{{ csrf_token() }}',
                },
                success: function(response) {
                    pdfData = {};
                    if (response.status == 'success') {
                        console.log(response.invoice);
                        var invoice = response.invoice;
                        var invoice_id = invoice.invoice_id
                        var invoice_from = invoice.invoice_from
                        var invoice_to = invoice.invoice_to
                        var termsNConditions = invoice.terms_n_conditions;
                        var note = invoice.note
                        let total = invoice.items_sum_price

                        // const date = new Date();
                        // const year = date.getFullYear();
                        // const month = date.getMonth() + 1; // Months are 0-indexed
                        // const day = date.getDate().toString().padStart(2, '0');
                        // const monthName = date.toLocaleString('default', {
                        //     month: 'short'
                        // }).toUpperCase(); // Get short month name in uppercase

                        // const formattedDate = `${day} ${monthName} ${year}`;

                        pdfData.invoice_id = invoice_id
                        pdfData.invoice_from = invoice_from
                        pdfData.invoice_to = invoice_to
                        pdfData.termsNConditions = termsNConditions
                        pdfData.note = note
                        pdfData.total = total
                        pdfData.created_at = invoice.created_at
                        pdfData.due_date = invoice.due_date

                        pdfData.items = []

                        // Items
                        $(invoice.items).each(function(index, item) {
                            var description = item.description;
                            var price = item.price;
                            var quantity = item.quantity;

                            var total = price * quantity;

                            pdfData.items.push({
                                description,
                                price,
                                quantity,
                                total
                            })
                        });

                        generatePDF(pdfData)
                        $('#spinner').remove()
                    } else {
                        alert(response.message)
                    }
                }
            })
        })
        $('body').on('click', '.invoice-download-btn', function(e) {
            downloadPDF(pdfData.invoice_id)
        })
    </script>
@endsection
@endsection
