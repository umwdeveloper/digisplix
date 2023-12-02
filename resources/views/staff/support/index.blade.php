@extends('layouts.app')

@section('content')
    <main class="content ">
        <div class="container-fluid px-lg-0">
            <div class="row justify-content-center">
                <div class="col-xl-12 ">
                    <div class="row">

                        <div class="col-xl-3 col-md-6 mb-3">
                            <div class="box">
                                <h1 class="box-heading">Total Tickets</h1>
                                <div class="d-flex align-items-center">
                                    <div class=" flex-grow-1  box-text d-flex align-items-center">

                                        <span class="box-value">{{ $tickets->count() }}</span>

                                    </div>
                                    <div class="box-icon blue-icon">
                                        <i class="fa-solid fa-ticket"></i>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-3">
                            <div class="box">
                                <h1 class="box-heading">Completed Tickets</h1>
                                <div class="d-flex align-items-center">
                                    <div class=" flex-grow-1  box-text d-flex align-items-center">

                                        <span class="box-value">{{ $completed_tickets->count() }}</span>

                                    </div>
                                    <div class="box-icon yellow-icon">
                                        <i class="fa-solid fa-message-lines"></i>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-3">
                            <div class="box">
                                <h1 class="box-heading">Awaiting Client Response</h1>
                                <div class="d-flex align-items-center">
                                    <div class=" flex-grow-1  box-text d-flex align-items-center">
                                        <span class="box-value">{{ $awaiting_tickets->count() }}</span>

                                    </div>
                                    <div class="box-icon green-icon">
                                        <i class="fa-solid fa-thumbs-up"></i>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-3">
                            <div class="box">
                                <h1 class="box-heading">Customer Replied</h1>
                                <div class="d-flex align-items-center">
                                    <div class=" flex-grow-1  box-text d-flex align-items-center">
                                        <span class="box-value">{{ $replied_tickets->count() }}</span>

                                    </div>
                                    <div class="box-icon red-icon">
                                        <i class="fa-solid fa-message-check"></i>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 mb-3">
                            <div class="box">
                                <h1 class="box-heading">Tickets by Status</h1>
                                <div class="d-flex align-items-center">
                                    <div id="chartdiv2"></div>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 mb-3">
                            <div class="box">
                                <h1 class="box-heading">Tickets by Priority</h1>
                                <div class="d-flex align-items-center">
                                    <div id="chartdiv3"></div>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 h-100">
                            <div class="box mb-3 box-p">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <h1 class="f-20 w-500 mb-0 pb-0 text-dark-clr">Support Ticket List</h1>
                                    </div>

                                    <div class="tabcontent-lead">

                                        <table id="example" class="table data-table-style ">
                                            <thead>
                                                <tr>
                                                    <th class="no-sort"></th>
                                                    <th>ID</th>
                                                    <th>Customer Email</th>
                                                    <th>Subject</th>
                                                    <th>Status</th>
                                                    <th>Priority</th>
                                                    <th>Last Update Date</th>
                                                    <th>Opened Date</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    use App\Models\Support;
                                                    $ticketStatusClasses = [
                                                        Support::OPEN => 'ticket-open',
                                                        Support::AWAITING_USER_RESPONSE => 'ticket-waiting',
                                                        Support::USER_REPLIED => 'ticket-replied',
                                                        Support::CLOSED => 'ticket-completed',
                                                    ];

                                                    $ticketPriorityClasses = ['priority-low', 'priority-medium', 'priority-high'];
                                                    $ticketPriority = ['Low', 'Medium', 'High'];
                                                @endphp
                                                @foreach ($tickets as $ticket)
                                                    <tr class="">
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="table-arrow">
                                                                    <!-- <i class="fa-duotone fa-circle-chevron-down"></i> -->
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>1</td>
                                                        <td>{{ $ticket->user->email }}</td>

                                                        <td>
                                                            <p onclick="window.location.href = '{{ route('staff.support.show', $ticket->id) }}'"
                                                                class="subject mb-0 pb-0">{{ $ticket->subject }}</p>
                                                        </td>
                                                        <td>
                                                            <div class="{{ $ticketStatusClasses[$ticket->status] }}">
                                                                {{ $status_labels[$ticket->status] }}
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="{{ $ticketPriorityClasses[$ticket->priority] }}">
                                                                {{ $ticketPriority[$ticket->priority] }}</div>
                                                        </td>

                                                        <td>
                                                            {{ $ticket->updated_at->format('d M, Y') }}
                                                        </td>

                                                        <td>
                                                            {{ $ticket->created_at->format('d M, Y') }}
                                                        </td>


                                                        <td>
                                                            <div class="table-actions d-flex align-items-center">
                                                                <a href="{{ route('staff.support.show', $ticket->id) }}"
                                                                    class="edit"><i
                                                                        class="fa-solid fa-eye me-2"></i>View</a>
                                                                <form
                                                                    action="{{ route('staff.support.destroy', $ticket->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button class="delete"><i
                                                                            class="fa-solid fa-trash me-2"></i>
                                                                        Delete</button>
                                                                </form>
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
                                <p class="f-14 w-500 mb-0 pb-0 text-center text-gray text-dark-clr" id="copyright-year">
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </main>

    @php
        $priority_colors = ['#398bf7', '#f9a400', '#e72f55'];
    @endphp

@section('script')
    <script src="https://www.amcharts.com/lib/4/core.js"></script>
    <script src="https://www.amcharts.com/lib/4/charts.js"></script>
    <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

    <script>
        // Create chart instance
        var chart = am4core.create("chartdiv2", am4charts.PieChart);
        chart.fontSize = 16;

        var chartData = {!! json_encode(
            $status_counts->map(function ($ticket) use ($status_labels, $status_colors) {
                return [
                    'status' => str_replace('Response', '', str_replace('User ', '', $status_labels[$ticket->status])),
                    'count' => $ticket->count,
                    'color' => $status_colors[$ticket->status], // You may need to define this function
                ];
            }),
        ) !!};

        // Add data with different colors
        chart.data = chartData.map(function(item) {
            return {
                "status": item.status,
                "count": item.count,
                "color": am4core.color(item.color)
            };
        });

        // Add and configure Series
        var pieSeries = chart.series.push(new am4charts.PieSeries());
        pieSeries.dataFields.value = "count";
        pieSeries.dataFields.category = "status";
        pieSeries.innerRadius = am4core.percent(50);
        pieSeries.ticks.template.disabled = true;
        pieSeries.labels.template.disabled = true;

        // Set the color for each slice
        pieSeries.slices.template.propertyFields.fill = "color";

        var rgm = new am4core.LinearGradientModifier();
        rgm.brightnesses.push(0, -0.4);
        pieSeries.slices.template.fillModifier = rgm;

        var rgm2 = new am4core.LinearGradientModifier();
        rgm2.brightnesses.push(0, -0.4);

        pieSeries.slices.template.strokeModifier = rgm2;
        pieSeries.slices.template.strokeOpacity = 1;
        pieSeries.slices.template.strokeWidth = 1;

        // Create a custom legend formatter to display values instead of percentages
        chart.legend = new am4charts.Legend();
        chart.legend.position = "bottom";
        chart.legend.useDefaultMarker = true;

        chart.legend.itemContainers.template.events.on("validated", function(event) {
            var dataItem = event.dataItem;
            if (dataItem) {
                dataItem.label.text = dataItem.dataContext.litres; // Display the 'litres' value in the legend
            }
        });

        pieSeries.slices.template.events.on("validated", function(event) {
            var gradient = event.target.fillModifier.gradient;
            gradient.rotation = event.target.middleAngle + 90;

            var gradient2 = event.target.strokeModifier.gradient;
            gradient2.rotation = event.target.middleAngle + 90;
        });

        setInterval(function() {
            var themeLink = $("#theme-link").attr("href");
            if (themeLink && themeLink.includes("dark")) {
                chart.legend.labels.template.fill = am4core.color("#fff");
                chart.legend.valueLabels.template.fill = am4core.color("#fff");
            } else {
                chart.legend.labels.template.fill = am4core.color("#000");
                chart.legend.valueLabels.template.fill = am4core.color("#000");
            }
        }, 100)
    </script>
    <script>
        // Create chart instance
        var chart2 = am4core.create("chartdiv3", am4charts.PieChart);
        chart2.fontSize = 16;

        var chartData = {!! json_encode(
            $priority_counts->map(function ($ticket) use ($priority_colors) {
                return [
                    'priority' => $ticket->priority == 0 ? 'Low' : ($ticket->priority == 1 ? 'Medium' : 'High'),
                    'count' => $ticket->priority_count,
                    'color' => $priority_colors[$ticket->priority], // You may need to define this function
                ];
            }),
        ) !!};

        // Add data with different colors
        chart2.data = chartData.map(function(item) {
            return {
                "priority": item.priority,
                "count": item.count,
                "color": am4core.color(item.color)
            };
        });

        // Add and configure Series
        var pieSeries2 = chart2.series.push(new am4charts.PieSeries());
        pieSeries2.dataFields.value = "count";
        pieSeries2.dataFields.category = "priority";
        pieSeries2.innerRadius = am4core.percent(50);
        pieSeries2.ticks.template.disabled = true;
        pieSeries2.labels.template.disabled = true;

        // Set the color for each slice
        pieSeries2.slices.template.propertyFields.fill = "color";

        var rgm = new am4core.LinearGradientModifier();
        rgm.brightnesses.push(0, -0.4);
        pieSeries2.slices.template.fillModifier = rgm;

        var rgm2 = new am4core.LinearGradientModifier();
        rgm2.brightnesses.push(0, -0.4);

        pieSeries2.slices.template.strokeModifier = rgm2;
        pieSeries2.slices.template.strokeOpacity = 1;
        pieSeries2.slices.template.strokeWidth = 1;

        // Create a custom legend formatter to display values instead of percentages
        chart2.legend = new am4charts.Legend();
        chart2.legend.position = "bottom";
        chart2.legend.useDefaultMarker = true;

        chart2.legend.itemContainers.template.events.on("validated", function(event) {
            var dataItem = event.dataItem;
            if (dataItem) {
                dataItem.label.text = dataItem.dataContext.level; // Display the 'level' value in the legend
                dataItem.label.fill = dataItem.dataContext.labelColor; // Set the legend label text color
            }
        });

        // Change the liters text color in the legend
        pieSeries2.slices.template.events.on("validated", function(event) {
            var dataItem = event.target.dataItem;
            if (dataItem) {
                dataItem.label.fill = dataItem.dataContext.labelColor; // Set the liters text color in the legend
            }
        });

        setInterval(function() {
            var themeLink = $("#theme-link").attr("href");
            if (themeLink && themeLink.includes("dark")) {
                chart2.legend.labels.template.fill = am4core.color("#fff");
                chart2.legend.valueLabels.template.fill = am4core.color("#fff");
            } else {
                chart2.legend.labels.template.fill = am4core.color("#000");
                chart2.legend.valueLabels.template.fill = am4core.color("#000");
            }
        }, 100)
    </script>
    <script>
        function changeURL() {
            // Set the new URL using window.location.href
            window.location.href = 'ticket-detail.html'; // Replace with the desired URL
        }
    </script>
@endsection
@endsection
