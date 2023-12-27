@extends('layouts.client')

@section('content')
    <main class="content">
        <div class="container-fluid px-lg-0">
            <div class="row justify-content-center">
                <div class="col-xl-8 mx-auto  mb-3">
                    <div class="box box-p">
                        <div
                            class="d-flex align-items-lg-center justify-content-between flex-md-row flex-column align-items-start">
                            <div class="d-flex align-items-center">
                                <a href="billing.html" class="text-gray"> <i class="fa-solid fa-circle-left me-2"></i> Back to
                                    Dashboard</a>
                            </div>

                            <div class="ms-auto d-flex">
                                <!-- download -->
                                <div class="header-option align-self-center me-0 hide-sm me-4 ms-2">
                                    <i class="fa-duotone fa-download header-icon"
                                        style="color: #0963ce; cursor: pointer"></i>
                                </div>
                                <!-- pay -->
                                @if ($invoice->status == 'paid')
                                    <div class="d-flex justify-content-center align-items-center">
                                        <button class="table-btn btn-success  px-2" type="button"
                                            style="background-color: #198754 !important">Paid <i
                                                class="bi bi-check-circle ms-1"></i></button>
                                    </div>
                                @else
                                    <div class="d-flex justify-content-center align-items-center">
                                        <button class="table-btn px-2" type="button" id="payment-button"
                                            data-bs-toggle="modal" data-bs-target="#paymentModal">Pay Now <i
                                                class="bi bi-check-circle ms-1"></i></button>
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-8 mx-auto ">
                    <div class="box mb-3 box-p" style="min-height: 80vh;">
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
                                        <div class="  w-500 f-16 text-dark-clr">{{ $invoice->invoice_from }}</div>
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
                                        <h1 class="invoice-heading  text-dark-clr">Customer:</h1>
                                        <div class="  w-500 f-16 text-dark-clr">{{ $invoice->invoice_to }}</div>
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
                                        style="height: fit-content !important; border: 1px solid #ece9e9; border-bottom: none; overflow-x: auto">
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
                                                @foreach ($invoice->items as $key => $item)
                                                    <tr class="">
                                                        <td>{{ ++$key }}.</td>
                                                        <td scope="row" style="white-space: normal;">
                                                            {{ $item->description }}
                                                        </td>
                                                        <td>${{ $item->price }}</td>
                                                        <td class="text-center">
                                                            {{ $item->quantity }}
                                                        </td>
                                                        <td>${{ round($item->price * $item->quantity) }}</td>

                                                    </tr>
                                                @endforeach
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
                                        <p class="mb-0 pb-0 f-14 w-500">Account# : <span
                                                class="ms-3">{{ $invoice->account_number }}</span>
                                        </p>
                                        <p class="mb-0 pb-0 f-14 w-500">A/C Name : <span
                                                class="ms-3">{{ $invoice->account_holder_name }}</span></p>
                                        <p class="mb-0 pb-0 f-14 w-500">Bank Name : <span
                                                class="ms-3">{{ $invoice->bank_name }}</span></p>
                                        <p class="mb-0 pb-0 f-14 w-500">IFSC Code : <span
                                                class="ms-3">{{ $invoice->ifsc_code }}</span></p>
                                    </div>
                                    @if (!empty($invoice->terms_n_conditions))
                                        <div class=" mt-3 text-dark-clr">
                                            <h1 class="f-16 w-600">Terms & Conditions:</h1>
                                            <p class="mb-0 pb-0 f-14 w-500">{{ $invoice->terms_n_conditions }}</p>
                                        </div>
                                    @endif
                                    @if (!empty($invoice->note))
                                        <div class=" mt-3 text-dark-clr">
                                            <h1 class="f-16 w-600">Notes:</h1>
                                            <p class="mb-0 pb-0 f-14 w-500">{{ $invoice->note }}</p>
                                        </div>
                                    @endif

                                </div>
                            </div>
                            <div class="col-lg-5 ms-auto ">
                                <div class="box-gray h-auto box-p bg-white border-0 p-0 text-dark-clr"
                                    style="background-color: transparent !important;">
                                    <div class="summary-box pe-4 ps-3" style="background-color: transparent;">
                                        <div class="summary-div d-flex justify-content-between mb-1">
                                            <p class="f-14 w-400 text-gray mb-0 pb-0">Sub Total:</p>
                                            <p class="f-14 w-400 text-gray mb-0 pb-0">
                                                ${{ round($invoice->total_price) }}</p>
                                        </div>
                                        <div class="summary-div d-flex justify-content-between mt-1">
                                            {{-- <p class="f-14 w-400 text-gray mb-0 pb-0">Discount:</p> --}}
                                            {{-- <p class="f-14 w-400 text-gray mb-0 pb-0">$22</p> --}}
                                        </div>

                                    </div>

                                    <div class="summary-div-total d-flex justify-content-between  pe-4 mt-3 ps-3">
                                        <p class="f-16 w-500   mb-0 pb-0">Total Amount
                                        </p>
                                        <p class="f-16 w-400   mb-0 pb-0">${{ round($invoice->total_price) }}</p>
                                        <input type="hidden" id="amount" value="{{ $invoice->total_price }}">
                                        <input type="hidden" id="invoice_id" value="{{ $invoice->id }}">
                                        <input type="hidden" id="invoice_number" value="{{ $invoice->invoice_id }}">
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-12 mt-3 ">
                                <div class="invoice-footer px-4">
                                    <p class="mb-0 pb-0 f-14 w-500 text-gray"><span><i
                                                class="bi bi-envelope-fill text-primary me-1"></i></span>
                                        info@digisplix.com
                                    </p>
                                    <p class="mb-0 pb-0 f-14 w-500 text-gray "><span class="w-600"><i
                                                class="bi bi-browser-chrome text-primary me-1"></i></span>
                                        www.digisplix.com</p>
                                    <p class="mb-0 pb-0 f-14 w-500 text-gray"><span><i
                                                class="bi bi-telephone-fill text-primary me-1"></i></span>
                                        +17373388038</p>


                                </div>
                            </div>
                        </div>
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
        <!-- </div> -->
    </main>

    <!-- Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Pay Invoice</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@section('script')
    <script src="https://js.stripe.com/v3/"></script>

    <script>
        $(document).ready(function() {
            const stripe = Stripe('{{ config('custom.stripe_key') }}');
            let amount = $('#amount').val()
            let invoice_id = $('#invoice_id').val()
            let invoice_number = $('#invoice_number').val()

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
@endsection
@endsection
