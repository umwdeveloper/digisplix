@extends('layouts.client')

@section('content')
    <main class="content ">
        <div class="container-fluid px-lg-0">
            <div class="col-lg-12">
                <div class="box ">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mt-2 d-flex align-items-center justify-content-between mb-3 border-bottom pb-3">
                                <h1 class="f-20 w-500 mb-0 pb-0 text-dark-clr">Business Growth Plans - Pricing</h1>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center pt-3 pb-2">

                        @php
                            $colors = ['basic', 'eco', 'pro', 'business'];
                            $prices = ['2499', '4999', '7499', '9499'];
                        @endphp
                        @foreach ($plans as $key => $plan)
                            <div class="col-xl-3 col-lg-6 mb-4 pb-2 col-md-6 col-12">
                                <div class="pricing-card {{ $colors[$key] }}">
                                    @if ($key == 2)
                                        <div class="popular">BEST SELLING</div>
                                    @endif
                                    <div class="pricing-header">
                                        <span class="plan-title">{{ strtoupper($plan->name) }}</span>
                                        <a href="#" class="text-white buy-now-btn" data-plan="platinum">
                                            <div class="price-circle">
                                                <span class="price-title">
                                                    <small>$</small><span>{{ $prices[$key] }}</span>
                                                </span>
                                                <span class="info">/ Month</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="d-flex justify-content-center text-center">
                                        <div class="badge-box">
                                            <a href="#" class="text-white buy-now-btn" data-plan="platinum">
                                                <span>Save 84%</span>
                                            </a>
                                        </div>
                                    </div>
                                    <ul>
                                        @foreach ($plan->features as $feature)
                                            <li class="d-flex  align-items-start"><i class="fa-solid fa-check"></i>
                                                <p class="pb-0 mb-0">
                                                    {{ $feature->description }}
                                                </p>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="d-flex justify-content-center">
                                        <div class="buy-button-box">
                                            <a href="#" class="buy-now buy-now-btn" data-plan="platinum">BUY NOW</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>


                </div>
            </div>
        </div>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Pay Now</h5>
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
            let plan = '';

            async function initialize() {

                const response = await fetch('{{ route('payment.subscribe') }}', {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}', // Include CSRF token if required
                    },
                    body: JSON.stringify({
                        plan,
                    }),
                });

                const session = await response.json();

                const clientSecret = session.session.client_secret

                const checkout = await stripe.initEmbeddedCheckout({
                    clientSecret,
                });

                $('#spinner').addClass('d-none')

                // Mount Checkout
                checkout.mount('#checkout');
            }

            $('.buy-now-btn').click(function(e) {
                e.preventDefault()

                $('#paymentModal').modal('show')

                plan = $(this).data('plan')
                initialize();
            })

            $('#paymentModal').on('hidden.bs.modal', function() {
                location.reload()
            })
        });
    </script>
@endsection
@endsection
