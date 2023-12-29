@extends('layouts.client')

@section('content')
    <main class="content">
        <div class="container-fluid px-lg-0">
            <div class="row flex-column  justify-content-center">
                <div class="col-lg-7 mx-auto  mb-3">
                    <div class="box box-p">
                        <div
                            class="d-flex align-items-lg-center justify-content-between flex-md-row flex-column align-items-start">
                            <div class="d-flex align-items-center">
                                <a href="billing.html" class="text-gray"> <i class="fa-solid fa-circle-left me-2"></i> Back to
                                    Dashboard</a>
                            </div>

                            <div class="ms-auto d-flex align-items-center text-gray">
                                Remaining Amount: <h5 class="text-primary ms-2 p-0 m-0">
                                    $50
                                </h5>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-7 mx-auto ">
                    <div class="box mb-3 box-p">
                        <div class="row">
                            <div class="col-12">
                                <p class="mb-0 pb-0 f-18 w-500 bank-detail-heading">Bank Information</p>

                                <p class="f-14 w-400 mb-0 pb-0 mt-2 text-gray">
                                    Transfer funds using the following bank information:
                                </p>

                                <div class="bank-details mt-2">
                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <div>
                                            <p class="mb-0 pb-0 f-16 w-500 text-gray">Bank Name</p>
                                        </div>
                                        <div>
                                            <p class="mb-0 pb-0 f-16 w-600 text-gray">Bank Name</p>
                                        </div>
                                        <div>
                                            <p class="mb-0 pb-0 f-18"><i class="bi bi-clipboard text-primary"></i></p>
                                        </div>
                                    </div>



                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <div>
                                            <p class="mb-0 pb-0 f-16 w-500 text-gray">Bank Name</p>
                                        </div>
                                        <div>
                                            <p class="mb-0 pb-0 f-16 w-600 text-gray">Bank Name</p>
                                        </div>
                                        <div>
                                            <p class="mb-0 pb-0 f-18"><i class="bi bi-clipboard text-primary"></i></p>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <div>
                                            <p class="mb-0 pb-0 f-16 w-500 text-gray">Bank Name</p>
                                        </div>
                                        <div>
                                            <p class="mb-0 pb-0 f-16 w-600 text-gray">Bank Name</p>
                                        </div>
                                        <div>
                                            <p class="mb-0 pb-0 f-18"><i class="bi bi-clipboard text-primary"></i></p>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <div>
                                            <p class="mb-0 pb-0 f-16 w-500 text-gray">Bank Name</p>
                                        </div>
                                        <div>
                                            <p class="mb-0 pb-0 f-16 w-600 text-gray">Bank Name</p>
                                        </div>
                                        <div>
                                            <p class="mb-0 pb-0 f-18"><i class="bi bi-clipboard text-primary"></i></p>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <div>
                                            <p class="mb-0 pb-0 f-16 w-500 text-gray">Bank Name</p>
                                        </div>
                                        <div>
                                            <p class="mb-0 pb-0 f-16 w-600 text-gray">Bank Name</p>
                                        </div>
                                        <div>
                                            <p class="mb-0 pb-0 f-18"><i class="bi bi-clipboard text-primary"></i></p>
                                        </div>
                                    </div>

                                </div>
                                <p class="f-14 w-400 mb-0 pb-0 mt-2 text-gray">
                                    If you can, please include the reference mentioned above when you send your bank
                                    transfer.
                                </p>
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
