@extends('layouts.app')

@section('content')

    <main class="content ">
        <div class="container-fluid px-lg-0">
            <div class="row justify-content-center mb-3">
                <div class="col-xl-12 ">
                    <div class="row">
                        <div class="col-xl-12  mb-3">
                            <div class="box box-p">
                                <div
                                    class="d-flex align-items-lg-center justify-content-between flex-md-row flex-column align-items-start">
                                    <div>
                                        <h2 class="f-16 w-500 text-primary mb-0 pb-0">
                                            Email History
                                        </h2>
                                    </div>

                                    <div class="d-flex align-items-center mt-md-0 mt-3">
                                        <a href="{{ route('staff.clients.index') }}" class="text-gray text-dark-clr"> <i
                                                class="fa-solid fa-circle-left me-2"></i> Back to Clients</a>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="box-white px-3 py-4 ">
                                <div class="">
                                    <table id="example" class="table data-table-style  email-table">
                                        <thead>
                                            <tr>

                                                <th scope="col" class="target-cell-head">#</th>
                                                <th scope="col">Subject</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($emails as $count => $email)
                                                <tr class="border-bottom ">


                                                    <td scope="row" class="target-cell">
                                                        <p class="mb-0 pb-0 ms-2" style="line-height: 40px;">
                                                            {{ ++$count }}</p>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="d-flex align-items-lg-center align-items-start  email-ellipsis  ">
                                                            <i class="fa-duotone fa-square-envelope me-2  d-lg-block d-none "
                                                                style="font-size: 26px; color:#0963ce;"> </i>
                                                            <p class="description-cell mb-0 pb-0">
                                                                {{ $email->subject }}
                                                            </p>
                                                        </div>
                                                    </td>

                                                    <td class="localTime">
                                                        {{ \Carbon\Carbon::parse($email->created_at)->format('d M Y') }}
                                                    </td>

                                                    <td class="">
                                                        <button class="table-btn view-email" data-id="{{ $email->id }}"
                                                            type="button">View
                                                            Email</button>
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

            </div>
            {{-- <div class="row mb-3 mt-3">
                <div class="col-lg-12">
                    <div class="box">
                        <p class="f-14 w-500 mb-0 pb-0 text-center text-gray text-dark-clr" id="copyright-year"></p>
                    </div>
                </div>
            </div> --}}
        </div>
    </main>

    <!-- email-history -->
    <div class="email-history">
        <div class="d-flex align-items-start justify-content-between border-bottom pb-3">
            <div>
                <h1 class="f-20 w-500 mb-3 text-dark-clr mb-0 pb-0" id="subject"></h1>
                <p class="mb-0 pb-0 text-gray" id="date"></p>
            </div>
            <div><i class="fa-duotone fa-circle-xmark f-30 ms-4 text-primary close-email"></i></div>
        </div>

        <div class="email-title mb-3">
            <h1 class="f-26 w-600 mb-4 text-white  " id="greeting"></h1>
        </div>
        <div class="box-white px-3 py-4 mb-3">
            <div class="mt-3" id="message">
            </div>
        </div>
    </div>

@section('script')
    <script>
        $(document).on("click", ".view-email", function() {
            $('.loading').removeClass('d-none')
            // alert("small-screen")

            var url = '{{ route('staff.view', 'email_id') }}'.replace('email_id', $(this).data('id'))

            $("#subject").text("")
            $("#date").text("")
            $("#greeting").text("")
            $("#message").text("")

            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    console.log(response);
                    var email = response.email;

                    $("#subject").text(email.subject)

                    var date = new Date(email.created_at)
                    const yyyy = date.getFullYear();
                    let dd = date.getDate();

                    if (dd < 10) dd = '0' + dd;

                    const formattedDate = dd + ' ' + new Date(email.created_at).toLocaleString(
                        'en-US', {
                            month: 'short'
                        }) + ' ' + yyyy;

                    $("#date").text(formattedDate)

                    var lines = JSON.parse(email.message)
                    console.log(lines);
                    // $("#greeting").text(lines.shift())

                    for (const key in lines) {
                        if (key === "0") {
                            $("#greeting").text(lines[key]);
                        } else if (key === "actionUrl" && lines[key] !== null) {
                            $("#message").append(
                                `<button onclick="window.location.href='${lines[key]}'" class='btn btn-secondary'>${lines['actionText']}</button><br><br>`
                            );
                        } else if (key !== "actionText" && lines[key] !== null) {
                            $("#message").append(`${lines[key]}<br><br>`);
                        }
                    }


                    // lines.forEach((line) => {
                    //     $("#message").append(line).append("<br><br>")
                    // })

                    $("#message").append("Regards,<br>DigiSplix")

                    $('.loading').addClass('d-none')
                    $(".email-history").css('left', '0px');
                    $(".overlay").css('display', 'block');
                }
            })
        })
        $(".close-email").on("click", function() {
            $(".email-history").css('left', '-700px');
            $(".overlay").css('display', 'none')

        })

        $(document).click(function(event) {
            if ($(".email-history").css('left') !== '-700px') {
                if (!$(event.target).closest('.email-history').length) {
                    $(".email-history").css('left', '-700px');
                    $(".overlay").css('display', 'none')
                }
            }
        });
    </script>
@endsection
@endsection
