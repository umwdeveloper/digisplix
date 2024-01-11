@extends('layouts.partner')

@section('content')
    <main class="content ">
        <div class="container-fluid px-lg-0">
            <div class="row justify-content-center">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-xl-4 col-md-4 mb-3">
                            <div class="box">
                                <div class="d-flex justify-content-between align-items-start">
                                    <h1 class="box-heading">Total Sales</h1>
                                    <select class="form-select select-duration mb-1 filter"
                                        aria-label="Default select example" data-filter="sales">
                                        <option selected value="weekly">Weekly</option>
                                        <option value="monthly">Monthly</option>
                                        <option value="months_6">6 Months</option>
                                        <option value="yearly">Yearly</option>
                                        <option value="lifetime">Lifetime</option>
                                    </select>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class=" flex-grow-1  box-text d-flex align-items-center">

                                        <span class="box-value" id="sales">{{ number_format($sales, 0, ',') }}</span>

                                    </div>
                                    <div class="box-icon">
                                        <i class="fa-solid fa-chart-mixed-up-circle-currency"></i>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-4 mb-3">
                            <div class="box">
                                <div class="d-flex justify-content-between align-items-start">
                                    <h1 class="box-heading">Total Revenue</h1>
                                    <select class="form-select select-duration mb-1 filter-revenue"
                                        aria-label="Default select example" data-filter="revenue">
                                        <option selected value="weekly">Weekly</option>
                                        <option value="monthly">Monthly</option>
                                        <option value="months_6">6 Months</option>
                                        <option value="yearly">Yearly</option>
                                        <option value="lifetime">Lifetime</option>
                                    </select>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class=" flex-grow-1  box-text d-flex align-items-center">

                                        <span class="box-value">$<span
                                                id="revenue">{{ number_format(round($revenue), 0, ',') }}</span></span>

                                    </div>
                                    <div class="box-icon">
                                        <i class="fa-solid fa-chart-line-up"></i>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-4 mb-3">
                            <div class="box">
                                <div class="d-flex justify-content-between align-items-start">
                                    <h1 class="box-heading">Commission Earned</h1>
                                    <select class="form-select select-duration mb-1 filter-commission"
                                        aria-label="Default select example" data-filter="commission">
                                        <option selected value="weekly">Weekly</option>
                                        <option value="monthly">Monthly</option>
                                        <option value="months_6">6 Months</option>
                                        <option value="yearly">Yearly</option>
                                        <option value="lifetime">Lifetime</option>
                                    </select>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class=" flex-grow-1  box-text d-flex align-items-center">

                                        <span class="box-value">$<span
                                                id="commission">{{ number_format(round($commission), 0, ',') }}</span></span>

                                    </div>
                                    <div class="box-icon">
                                        <i class="fa-duotone fa-money-bill-trend-up"></i>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 h-100">
                            <div class="box mb-3   ">
                                <div class="flex-grow-1">
                                    <h1 class="f-20 w-500 mb-3 text-dark-clr">Commission by Project</h1>
                                    <div class="table-responsive-div">
                                        <table id="upcoming-table" class="table data-table-style  ">
                                            <thead>
                                                <tr>
                                                    <th class="no-sort"></th>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Client Name</th>
                                                    <th scope="col">Business Name</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Deal Size</th>
                                                    <th scope="col">Commission</th>
                                                    <th scope="col">Type</th>
                                                    <th scope="col">Client Paid On</th>
                                                    <th scope="col">Project Name</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($commissions as $key => $commission)
                                                    <tr class="">
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="table-arrow">
                                                                    <!-- <i class="fa-duotone fa-circle-chevron-down"></i> -->
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>{{ ++$key }}</td>
                                                        <td>{{ $commission->client->user->name }}
                                                        </td>
                                                        <td>{{ $commission->client->business_name }}
                                                        </td>
                                                        <td>
                                                            <div class="dropdown table-dropdown">
                                                                <a style="background-color: {{ $commission_status_colors[$commission->status] }}"
                                                                    class="btn table-dropdown-btn ticket-paid"
                                                                    href="#" role="button" id="dropdownMenuLink"
                                                                    data-bs-toggle="dropdown" aria-expanded="false"
                                                                    data-commission-id="{{ $commission->id }}">
                                                                    {{ $commission_status_labels[$commission->status] }}
                                                                </a>
                                                            </div>
                                                        </td>
                                                        <td>${{ number_format(round($commission->deal_size), 0, ',') }}
                                                        </td>
                                                        <td>${{ number_format(round($commission->deal_size * ($commission->commission / 100)), 0, ',') }}
                                                        </td>
                                                        <td>{{ $commission->type == 0 ? 'Straight' : 'Recurring' }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($commission->deal_date)->format('d M Y') }}
                                                        </td>
                                                        <td class="">
                                                            <p class=" mb-0 pb-0">
                                                                {{ $commission->project->name }}
                                                            </p>
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
            </div>
            <div class="row justify-content-center mt-lg-0 mt-2">
                <div class="col-md-7 mb-3">
                    <div class="box h-100 ">
                        <h1 class="f-20 w-500 mb-3 border-bottom pb-3 text-dark-clr">Regional Sales</h1>
                        <div class="d-flex justify-content-center">
                            <canvas id="regional-sales"></canvas>
                        </div>

                    </div>
                </div>
                <div class="col-md-5 mb-3">
                    <div class="box h-100 d-flex flex-column">
                        <h1 class="f-20 w-500 mb-3 border-bottom pb-3 text-dark-clr">Sales by Customer Location</h1>
                        <div class="flex-grow-1  my-auto d-flex align-items-center">
                            <div id="customer_location"></div>
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
    </main>



@section('script')
    <script>
        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }
    </script>

    <script>
        var regionalSalesData = @json($regional_sales);

        var bubbleSeriesData = [
            @foreach ($regional_sales as $region)
                {
                    id: "{{ $region->region_code }}",
                    name: "{{ $region->region }}",
                    value: {{ $region->sales_count }},
                    circleTemplate: {
                        fill: getRandomColor()
                    }, // Assuming you have a getRandomColor() function
                },
            @endforeach
        ];

        console.log(bubbleSeriesData);
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <script src="{{ asset('js/charts.js') }}"></script>

    <script>
        $('.filter').change(function() {
            var duration = $(this).val();
            // Make an AJAX request to fetch data based on the selected duration
            $.ajax({
                url: '{{ route('partner.sales.total_sales') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    duration,
                },
                success: function(data) {
                    $('#sales').text(data.total);
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        });

        $('.filter-revenue').change(function() {
            var duration = $(this).val();
            // Make an AJAX request to fetch data based on the selected duration
            $.ajax({
                url: '{{ route('partner.sales.total_revenue') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    duration,
                },
                success: function(data) {
                    console.log(data);
                    $('#revenue').text(data.total);
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        });

        $('.filter-commission').change(function() {
            var duration = $(this).val();
            // Make an AJAX request to fetch data based on the selected duration
            $.ajax({
                url: '{{ route('partner.sales.total_commission') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    duration,
                },
                success: function(data) {
                    $('#commission').text(data.total);
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        });
    </script>
@endsection
@endsection
