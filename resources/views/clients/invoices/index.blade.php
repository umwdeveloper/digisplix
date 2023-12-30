@extends('layouts.client')

@section('content')
    <main class="content">
        <div class="container-fluid px-lg-0">
            <div class="row justify-content-center">
                <div class="col-xl-12">
                    <div class="col-lg-12 ">
                        <div class="box mb-3 box-p" style="min-height: 80vh;">
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <h1 class="f-20 w-500 mb-0 pb-0 text-dark-clr">Invoices</h1>

                                </div>


                                <table id="example" class="table data-table-style">
                                    <thead>
                                        <tr>
                                            <th class="no-sort"></th>
                                            <th class="">
                                                <div class="d-flex align-items-center">
                                                    Invoice ID
                                                </div>
                                            </th>
                                            <th>Created On</th>
                                            <th>Amount</th>
                                            <th>Due Date</th>
                                            <th>Status</th>
                                            <th>Category</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($invoices as $invoice)
                                            <tr class="">
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="table-arrow">
                                                            <!-- <i class="fa-duotone fa-circle-chevron-down"></i> -->
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        #{{ $invoice->invoice_id }}
                                                    </div>
                                                </td>
                                                <td>{{ $invoice->created_at->format('d M Y') }}</td>
                                                <td class="bussiness-name">
                                                    ${{ round($invoice->total_price) }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($invoice->due_date)->format('d/m/y') }}</td>

                                                <td>
                                                    <div class="invoice-{{ $invoice->status }}">
                                                        {{ $status_labels[$invoice->status] }}</div>
                                                    <!-- <div class="invoice-overdue">Overdue</div> -->
                                                    <!-- <div class="invoice-cancelled">Cancelled</div> -->
                                                </td>

                                                <td>{{ $invoice->category->name }}</td>

                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <a href="{{ route('client.invoices.show', $invoice->id) }}"
                                                            class="edit"><i class="fa-solid fa-eye me-2"></i>View</a>
                                                        {{-- <button class="edit ms-2 "><i
                                                                class="fa-solid fa-download me-2"></i>Download</button> --}}
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

@section('script')
@endsection
@endsection
