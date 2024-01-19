@extends('layouts.app')

@section('content')
    <main class="content ">
        <div class="container-fluid px-lg-0">
            <div class="row justify-content-center">
                <div class="col-xl-9 ">
                    <div class="row">
                        <div class="col-xl-6 col-md-6 mb-3">
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
                        <div class="col-xl-6 col-md-6 mb-3">
                            <div class="box">
                                <div class="d-flex justify-content-between align-items-start">
                                    <h1 class="box-heading">Total Revenue</h1>
                                    <select class="form-select select-duration mb-1 filter"
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

                        <div class="col-lg-12 h-100">
                            <div class="box mb-3  dasboard-table ">
                                <div class="flex-grow-1">
                                    <h1 class="f-20 w-500 mb-3 text-dark-clr">Upcoming Deliveries</h1>
                                    <div class="table-responsive-div">
                                        <table id="upcoming-table" class="table data-table-style  ">
                                            <thead>
                                                <tr>

                                                    <th scope="col">#</th>
                                                    <th scope="col">Days Left</th>
                                                    <th scope="col">Project Name</th>
                                                    <th scope="col">Deadline</th>
                                                    <th scope="col">Client Name
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($deliveries as $key => $delivery)
                                                    <tr class="">
                                                        <td scope="row" class="target-cell">
                                                            <p class="mb-0 pb-0 ms-2">{{ ++$key }}</p>
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($delivery->deadline)->diffInDays(now()) }}
                                                        </td>
                                                        <td class="">
                                                            <p title="Ecommerece Website lorem abscd"
                                                                class="project-name mb-0 pb-0">{{ $delivery->name }}</p>
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($delivery->deadline)->format('d M Y') }}
                                                        </td>
                                                        <td>{{ $delivery->client->user->name }}</td>
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
                @php
                    $colors = ['alert', 'warning', 'success', 'info'];
                @endphp
                <div class="col-xl-3 ">
                    <div class="box ticket-links mb-3">
                        <h1 class="f-20 w-500 mb-3 text-dark-clr">Recent Activity</h1>
                        <div class="recent-activities2">
                            @forelse (auth()->user()->notifications as $notification)
                                <a class="ticket-notify px-0  mb-3"
                                    href="{{ !empty($notification->data['link']) ? $notification->data['link'] : '#' }}">
                                    <div class="ticket-body ticket-{{ $colors[array_rand($colors)] }}">
                                        <h4 class="text-gray text-start justify-content-start mb-2">
                                            {{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</h4>
                                        <p class="mb-2 ellipsis-3">{{ $notification->data['message'] }}</p>
                                    </div>
                                </a>
                            @empty
                                <p class="no-recent-activity">No recent activity</p>
                            @endforelse
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
                var filter = $(this).data('filter');

                // Make an AJAX request to fetch data based on the selected duration
                $.ajax({
                    url: '{{ route('staff.sales.total_sales') }}',
                    type: 'GET',
                    data: {
                        _token: '{{ csrf_token() }}',
                        duration,
                        filter
                    },
                    success: function(data) {
                        $('#' + filter).text(data.total);
                    },
                    error: function(error) {
                        console.error('Error fetching data:', error);
                    }
                });
            });
        </script>
    @endsection
@endsection
