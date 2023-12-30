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
                                <a href="billing.html" class="text-gray"> <i style="cursor: pointer"
                                        class="fa-solid fa-circle-left me-2"></i> Back to
                                    Dashboard</a>
                            </div>

                            <div class="ms-auto d-flex align-items-center text-gray">
                                Remaining Amount: <h5 class="text-primary ms-2 p-0 m-0">
                                    ${{ round($bank->amount_remaining / 100) }}
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
                                            <p class="mb-0 pb-0 f-16 w-600 text-gray to-copy">
                                                {{ $bank->bank_name }}
                                            </p>
                                        </div>
                                        <div>
                                            <p class="mb-0 pb-0 f-18"><i data-toggle="tooltip" data-placement="top"
                                                    title="Copy to Clipboard" style="cursor: pointer"
                                                    class="bi bi-clipboard text-primary"></i></p>
                                        </div>
                                    </div>



                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <div>
                                            <p class="mb-0 pb-0 f-16 w-500 text-gray">Account Number</p>
                                        </div>
                                        <div>
                                            <p class="mb-0 pb-0 f-16 w-600 text-gray to-copy">
                                                {{ $bank->account_number }}</p>
                                        </div>
                                        <div>
                                            <p class="mb-0 pb-0 f-18"><i data-toggle="tooltip" data-placement="top"
                                                    title="Copy to Clipboard" style="cursor: pointer"
                                                    class="bi bi-clipboard text-primary"></i></p>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <div>
                                            <p class="mb-0 pb-0 f-16 w-500 text-gray">Routing Number</p>
                                        </div>
                                        <div>
                                            <p class="mb-0 pb-0 f-16 w-600 text-gray to-copy">
                                                {{ $bank->routing_number }}</p>
                                        </div>
                                        <div>
                                            <p class="mb-0 pb-0 f-18"><i data-toggle="tooltip" data-placement="top"
                                                    title="Copy to Clipboard" style="cursor: pointer"
                                                    class="bi bi-clipboard text-primary"></i></p>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <div>
                                            <p class="mb-0 pb-0 f-16 w-500 text-gray">SWIFT Code</p>
                                        </div>
                                        <div>
                                            <p class="mb-0 pb-0 f-16 w-600 text-gray to-copy">
                                                {{ $bank->swift_code }}</p>
                                        </div>
                                        <div>
                                            <p class="mb-0 pb-0 f-18"><i data-toggle="tooltip" data-placement="top"
                                                    title="Copy to Clipboard" style="cursor: pointer"
                                                    class="bi bi-clipboard text-primary"></i></p>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <div>
                                            <p class="mb-0 pb-0 f-16 w-500 text-gray">Reference</p>
                                        </div>
                                        <div>
                                            <p class="mb-0 pb-0 f-16 w-600 text-gray to-copy">{{ $bank->reference }}</p>
                                        </div>
                                        <div>
                                            <p class="mb-0 pb-0 f-18"><i data-toggle="tooltip" data-placement="top"
                                                    title="Copy to Clipboard" style="cursor: pointer"
                                                    class="bi bi-clipboard text-primary"></i></p>
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

@section('script')
    <script>
        $(document).ready(function() {
            $(function() {
                $('[data-toggle="tooltip"]').tooltip()
            })

            $('.bi-clipboard').on('click', function() {
                var targetSelector = $(this).closest('.d-flex').find('.to-copy');
                var text = $(targetSelector).text();

                copyToClipboard(text, $(this))
            });

            function copyToClipboard(text, el) {
                var copyTest = document.queryCommandSupported('copy');
                var elOriginalText = el.attr('data-bs-original-title');

                if (copyTest === true) {
                    var copyTextArea = document.createElement("textarea");
                    copyTextArea.value = text;
                    document.body.appendChild(copyTextArea);
                    copyTextArea.select();
                    try {
                        var successful = document.execCommand('copy');
                        var msg = successful ? 'Copied!' : 'Whoops, not copied!';
                        el.attr('data-bs-original-title', msg).tooltip('show');
                    } catch (err) {
                        console.log('Oops, unable to copy');
                    }
                    document.body.removeChild(copyTextArea);
                    el.attr('data-bs-original-title', elOriginalText);
                } else {
                    // Fallback if browser doesn't support .execCommand('copy')
                    window.prompt("Copy to clipboard: Ctrl+C or Command+C, Enter", text);
                }
            }
        });
    </script>
@endsection
@endsection
