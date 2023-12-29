@extends('layouts.app')

@section('content')
    <main class="content">
        <div class="container-fluid px-lg-0">
            <div class="row justify-content-center">
                <div class="col-xl-9 ">
                    <div class="row">
                        <div class="col-xl-4 col-md-6 mb-3">
                            <div class="box">
                                <h1 class="box-heading">Total Clients</h1>
                                <div class="d-flex align-items-center">
                                    <div class=" flex-grow-1  box-text d-flex align-items-center">

                                        <span class="box-value">{{ $totalClients }}</span>

                                    </div>
                                    <div class="box-icon">
                                        <i class="fa-duotone fa-user-group "></i>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 mb-3">
                            <div class="box">
                                <h1 class="box-heading">Active Clients</h1>
                                <div class="d-flex align-items-center">
                                    <div class=" flex-grow-1  box-text d-flex align-items-center">

                                        <span class="box-value">{{ $activeClients }}</span>

                                    </div>
                                    <div class="box-icon">
                                        <i class="fa-duotone fa-chart-network"></i>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 mb-3">
                            <div class="box">
                                <h1 class="box-heading">Total Projects</h1>
                                <div class="d-flex align-items-center">
                                    <div class=" flex-grow-1  box-text d-flex align-items-center">
                                        <span class="box-value">{{ $totalProjects }}</span>

                                    </div>
                                    <div class="box-icon">
                                        <i class="fa-duotone fa-rectangle-history"></i>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 mb-3">
                            <div class="box">
                                <h1 class="box-heading">Overdue Projects</h1>
                                <div class="d-flex align-items-center">
                                    <div class=" flex-grow-1  box-text d-flex align-items-center">
                                        <span class="box-value">{{ $overdueProjects }}</span>

                                    </div>
                                    <div class="box-icon">
                                        <i class="fa-duotone fa-calendar-days "></i>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 mb-3">
                            <div class="box">
                                <h1 class="box-heading">Ongoing Projects</h1>
                                <div class="d-flex align-items-center">
                                    <div class=" flex-grow-1  box-text d-flex align-items-center">
                                        <span class="box-value">{{ $onGoingProjects }}</span>

                                    </div>
                                    <div class="box-icon">
                                        <i class="fa-duotone fa-circle-quarter"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 mb-3">
                            <div class="box">
                                <h1 class="box-heading">Completed Projects</h1>
                                <div class="d-flex align-items-center">
                                    <div class=" flex-grow-1  box-text d-flex align-items-center">
                                        <span class="box-value">{{ $completedProjects }}</span>

                                    </div>
                                    <div class="box-icon">
                                        <i class="fa-duotone fa-award"></i>
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
                        <div class="recent-activities">
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
    @endsection
@endsection
