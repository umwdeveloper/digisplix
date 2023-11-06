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

                                        <span class="box-value">102</span>

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

                                        <span class="box-value">32</span>

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
                                        <span class="box-value">143</span>

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
                                        <span class="box-value">09</span>

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
                                        <span class="box-value">32</span>

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
                                        <span class="box-value">132</span>

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
                                                <tr class="">


                                                    <td scope="row" class="target-cell">
                                                        <p class="mb-0 pb-0 ms-2">1</p>
                                                    </td>
                                                    <td>15</td>
                                                    <td class="">
                                                        <p title="Ecommerece Website lorem abscd"
                                                            class="project-name mb-0 pb-0">Ecommerece Website</p>
                                                    </td>
                                                    <td>15 OCT 2023</td>
                                                    <td>Michal Jhon</td>
                                                </tr>
                                                <tr class="">


                                                    <td scope="row" class="target-cell">
                                                        <p class="mb-0 pb-0 ms-2">2</p>
                                                    </td>
                                                    <td>15</td>
                                                    <td class="">
                                                        <p title="Ecommerece Website lorem abscd"
                                                            class="project-name mb-0 pb-0">Ecommerece Website</p>
                                                    </td>
                                                    <td>15 OCT 2023</td>
                                                    <td>Michal Jhon</td>
                                                </tr>
                                                <tr class="">


                                                    <td scope="row" class="target-cell">
                                                        <p class="mb-0 pb-0 ms-2">3</p>
                                                    </td>
                                                    <td>15</td>
                                                    <td class="">
                                                        <p title="Ecommerece Website lorem abscd"
                                                            class="project-name mb-0 pb-0">Ecommerece Website</p>
                                                    </td>
                                                    <td>15 OCT 2023</td>
                                                    <td>Michal Jhon</td>
                                                </tr>
                                                <tr class="">


                                                    <td scope="row" class="target-cell">
                                                        <p class="mb-0 pb-0 ms-2">4</p>
                                                    </td>
                                                    <td>15</td>
                                                    <td class="">
                                                        <p title="Ecommerece Website lorem abscd"
                                                            class="project-name mb-0 pb-0">Ecommerece Website</p>
                                                    </td>
                                                    <td>15 OCT 2023</td>
                                                    <td>Michal Jhon</td>
                                                </tr>
                                                <tr class="">


                                                    <td scope="row" class="target-cell">
                                                        <p class="mb-0 pb-0 ms-2">2</p>
                                                    </td>
                                                    <td>15</td>
                                                    <td class="">
                                                        <p title="Ecommerece Website lorem abscd"
                                                            class="project-name mb-0 pb-0">Ecommerece Website</p>
                                                    </td>
                                                    <td>15 OCT 2023</td>
                                                    <td>Michal Jhon</td>
                                                </tr>
                                                <tr class="">


                                                    <td scope="row" class="target-cell">
                                                        <p class="mb-0 pb-0 ms-2">3</p>
                                                    </td>
                                                    <td>15</td>
                                                    <td class="">
                                                        <p title="Ecommerece Website lorem abscd"
                                                            class="project-name mb-0 pb-0">Ecommerece Website</p>
                                                    </td>
                                                    <td>15 OCT 2023</td>
                                                    <td>Michal Jhon</td>
                                                </tr>
                                                <tr class="">


                                                    <td scope="row" class="target-cell">
                                                        <p class="mb-0 pb-0 ms-2">2</p>
                                                    </td>
                                                    <td>15</td>
                                                    <td class="">
                                                        <p title="Ecommerece Website lorem abscd"
                                                            class="project-name mb-0 pb-0">Ecommerece Website</p>
                                                    </td>
                                                    <td>15 OCT 2023</td>
                                                    <td>Michal Jhon</td>
                                                </tr>
                                                <tr class="">


                                                    <td scope="row" class="target-cell">
                                                        <p class="mb-0 pb-0 ms-2">3</p>
                                                    </td>
                                                    <td>15</td>
                                                    <td class="">
                                                        <p title="Ecommerece Website lorem abscd"
                                                            class="project-name mb-0 pb-0">Ecommerece Website</p>
                                                    </td>
                                                    <td>15 OCT 2023</td>
                                                    <td>Michal Jhon</td>
                                                </tr>
                                                <tr class="">


                                                    <td scope="row" class="target-cell">
                                                        <p class="mb-0 pb-0 ms-2">4</p>
                                                    </td>
                                                    <td>15</td>
                                                    <td class="">
                                                        <p title="Ecommerece Website lorem abscd"
                                                            class="project-name mb-0 pb-0">Ecommerece Website</p>
                                                    </td>
                                                    <td>15 OCT 2023</td>
                                                    <td>Michal Jhon</td>
                                                </tr>
                                                <tr class="">


                                                    <td scope="row" class="target-cell">
                                                        <p class="mb-0 pb-0 ms-2">2</p>
                                                    </td>
                                                    <td>15</td>
                                                    <td class="">
                                                        <p title="Ecommerece Website lorem abscd"
                                                            class="project-name mb-0 pb-0">Ecommerece Website</p>
                                                    </td>
                                                    <td>15 OCT 2023</td>
                                                    <td>Michal Jhon</td>
                                                </tr>
                                                <tr class="">


                                                    <td scope="row" class="target-cell">
                                                        <p class="mb-0 pb-0 ms-2">3</p>
                                                    </td>
                                                    <td>15</td>
                                                    <td class="">
                                                        <p title="Ecommerece Website lorem abscd"
                                                            class="project-name mb-0 pb-0">Ecommerece Website</p>
                                                    </td>
                                                    <td>15 OCT 2023</td>
                                                    <td>Michal Jhon</td>
                                                </tr>
                                                <tr class="">


                                                    <td scope="row" class="target-cell">
                                                        <p class="mb-0 pb-0 ms-2">4</p>
                                                    </td>
                                                    <td>15</td>
                                                    <td class="">
                                                        <p title="Ecommerece Website lorem abscd"
                                                            class="project-name mb-0 pb-0">Ecommerece Website</p>
                                                    </td>
                                                    <td>15 OCT 2023</td>
                                                    <td>Michal Jhon</td>
                                                </tr>
                                                <tr class="">


                                                    <td scope="row" class="target-cell">
                                                        <p class="mb-0 pb-0 ms-2">4</p>
                                                    </td>
                                                    <td>15</td>
                                                    <td class="">
                                                        <p title="Ecommerece Website lorem abscd"
                                                            class="project-name mb-0 pb-0">Ecommerece Website</p>
                                                    </td>
                                                    <td>15 OCT 2023</td>
                                                    <td>Michal Jhon</td>
                                                </tr>
                                                <tr class="">


                                                    <td scope="row" class="target-cell">
                                                        <p class="mb-0 pb-0 ms-2">5</p>
                                                    </td>
                                                    <td>15</td>
                                                    <td class="">
                                                        <p title="Ecommerece Website lorem abscd"
                                                            class="project-name mb-0 pb-0">Ecommerece Website</p>
                                                    </td>
                                                    <td>15 OCT 2023</td>
                                                    <td>Michal Jhon</td>
                                                </tr>
                                                <tr class="">


                                                    <td scope="row" class="target-cell">
                                                        <p class="mb-0 pb-0 ms-2">6</p>
                                                    </td>
                                                    <td>15</td>
                                                    <td class="">
                                                        <p title="Ecommerece Website lorem abscd"
                                                            class="project-name mb-0 pb-0">Ecommerece Website</p>
                                                    </td>
                                                    <td>15 OCT 2023</td>
                                                    <td>Michal Jhon</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 ">
                    <div class="box ticket-links mb-3">
                        <h1 class="f-20 w-500 mb-3 text-dark-clr">Recent Activity</h1>
                        <div class="recent-activities">
                            <a class="ticket-notify px-0  mb-3" href="#">
                                <div class="ticket-body ticket-alert">
                                    <h4 class="text-gray text-start justify-content-start mb-2">03:10</h4>
                                    <p class="mb-2 ellipsis-3">Morbi quis ex eu arcu auctor sagittis.</p>
                                </div>
                            </a>
                            <a class="ticket-notify px-0  mb-3" href="#">
                                <div class="ticket-body ticket-warning">
                                    <h4 class="text-gray text-start justify-content-start mb-2">03:10</h4>
                                    <p class="mb-2 ellipsis-3">Morbi quis ex eu arcu auctor sagittis.</p>
                                </div>
                            </a>
                            <a class="ticket-notify px-0  mb-3" href="#">
                                <div class="ticket-body ticket-info">
                                    <h4 class="text-gray text-start justify-content-start mb-2">03:10</h4>
                                    <p class="mb-2 ellipsis-3">Lorem ipsum dolor sit amet consectetur, adipisicing
                                        elit. Delectus, deserunt.</p>
                                </div>
                            </a>
                            <a class="ticket-notify px-0  mb-3" href="#">
                                <div class="ticket-body ticket-success">
                                    <h4 class="text-gray text-start justify-content-start mb-2">03:10</h4>
                                    <p class="mb-2 ellipsis-3">Lorem ipsum dolor sit amet consectetur, adipisicing
                                        elit. Delectus, deserunt.</p>
                                </div>
                            </a>
                            <a class="ticket-notify px-0  mb-3" href="#">
                                <div class="ticket-body ticket-alert">
                                    <h4 class="text-gray text-start justify-content-start mb-2">03:10</h4>
                                    <p class="mb-2 ellipsis-3">Morbi quis ex eu arcu auctor sagittis.</p>
                                </div>
                            </a>
                            <a class="ticket-notify px-0  mb-3" href="#">
                                <div class="ticket-body ticket-warning">
                                    <h4 class="text-gray text-start justify-content-start mb-2">03:10</h4>
                                    <p class="mb-2 ellipsis-3">Morbi quis ex eu arcu auctor sagittis.</p>
                                </div>
                            </a>

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
@endsection
