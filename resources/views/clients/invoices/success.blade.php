@extends('layouts.client')

@section('content')
    <main class="content d-flex align-items-center " style="height: calc(100vh - 120px);">
        <div class="container-fluid px-lg-0">
            <div class="row justify-content-center">
                <div class="col-xl-8 mx-auto mb-3">
                    <div class="box box-p d-flex flex-column justify-content-center align-items-center ">
                        <img width="300px" src="{{ asset('images/successful-payment.svg') }}" alt="Successful payment">

                        <button onclick="location.href='{{ route('client.invoices.index') }}'" class="table-btn px-2"
                            type="button" id="payment-button"><i class="bi bi-arrow-left ms-1"></i> Back</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- </div> -->
    </main>

@section('script')
@endsection
@endsection
