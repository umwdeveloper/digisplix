@extends('layouts.app')

@section('content')
    <main class="content ">
        <div class="container-fluid px-lg-0">
            <div class="row justify-content-center">
                <div class="col-xl-12 ">
                    <div class="row">

                        <div class="col-xl-4 col-md-6 mb-3">
                            <div class="box">
                                <h1 class="box-heading">New Leads</h1>
                                <div class="d-flex align-items-center">
                                    <div class=" flex-grow-1  box-text d-flex align-items-center">

                                        <span class="box-value">14</span>

                                    </div>
                                    <div class="box-icon">
                                        <i class="fa-duotone fa-user-group "></i>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 mb-3">
                            <div class="box">
                                <h1 class="box-heading">Follow Up</h1>
                                <div class="d-flex align-items-center">
                                    <div class=" flex-grow-1  box-text d-flex align-items-center">

                                        <span class="box-value">32</span>

                                    </div>
                                    <div class="box-icon">
                                        <i class="fa-duotone fa-arrows-down-to-people"></i>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 mb-3">
                            <div class="box">
                                <h1 class="box-heading">Leads In Progress</h1>
                                <div class="d-flex align-items-center">
                                    <div class=" flex-grow-1  box-text d-flex align-items-center">
                                        <span class="box-value">143</span>

                                    </div>
                                    <div class="box-icon">
                                        <i class="fa-duotone fa-bars-progress"></i>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 mb-3">
                            <div class="box">
                                <h1 class="box-heading">Unqualified Leads</h1>
                                <div class="d-flex align-items-center">
                                    <div class=" flex-grow-1  box-text d-flex align-items-center">
                                        <span class="box-value">09</span>

                                    </div>
                                    <div class="box-icon">
                                        <i class="fa-duotone fa-diamond-exclamation"></i>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-12 mb-3">
                            <div class="box">
                                <h1 class="box-heading">Qualified Leads</h1>
                                <div class="d-flex align-items-center">
                                    <div class=" flex-grow-1  box-text d-flex align-items-center">
                                        <span class="box-value">32</span>

                                    </div>
                                    <div class="box-icon">
                                        <i class="fa-duotone fa-trophy-star"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 h-100">
                            <div class="box mb-3 box-p">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <h1 class="f-20 w-500 mb-0 pb-0 text-dark-clr">Leads</h1>
                                        <button class="table-btn" type="button" class="btn btn-primary"
                                            data-bs-toggle="modal" data-bs-target="#leadModal">Add New</button>
                                    </div>


                                    <div class="tab">
                                        <button class="tablink" data-tab="Tab1" id="defaultOpen">New</button>
                                        <button class="tablink" data-tab="Tab2">In-progress</button>
                                        <button class="tablink" data-tab="Tab3">Failed</button>
                                        <button class="tablink" data-tab="Tab4">Qualified</button>
                                    </div>

                                    <div id="Tab1" class="tabcontent-lead">

                                        <table id="example" class="table data-table-style ">
                                            <thead>
                                                <tr>
                                                    <th class="no-sort"></th>
                                                    <th>Client Name</th>
                                                    <th>Title</th>
                                                    <th>Bussiness Name</th>
                                                    <th>Email</th>
                                                    <th>Status</th>
                                                    <th>Partners</th>
                                                    <th>Country</th>
                                                    <th>Phone Number</th>
                                                    <th>Date</th>
                                                    <th>Follow-Up Date</th>
                                                    <th>URL</th>
                                                    <th>Address</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="">
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="table-arrow">
                                                                <!-- <i class="fa-duotone fa-circle-chevron-down"></i> -->
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>Jhon Doe</td>
                                                    <td class="">
                                                        CEO
                                                    </td>
                                                    <td class="bussiness-name">Jhon D. </td>
                                                    <td>jhon@gmail.com</td>
                                                    <td>
                                                        <div class="dropdown table-dropdown">
                                                            <a class="btn  dropdown-toggle table-dropdown-btn new"
                                                                href="#" role="button" id="dropdownMenuLink"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                New Lead
                                                            </a>

                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                <li><a class="dropdown-item contracted"
                                                                        href="#">Contracted</a></li>
                                                                <li><a class="dropdown-item follow-up"
                                                                        href="#">Follow-Up</a></li>
                                                                <li><a class="dropdown-item in-progress" href="#">In
                                                                        Progress</a></li>
                                                                <li><a class="dropdown-item failed"
                                                                        href="#">Failed</a></li>
                                                                <li><a class="dropdown-item qualified"
                                                                        href="#">Qualified</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                    <td>AB Divilar</td>

                                                    <td>
                                                        Pakistan
                                                    </td>

                                                    <td>
                                                        0300 887 6652
                                                    </td>
                                                    <td>
                                                        12/8/2023
                                                    </td>
                                                    <td>12/8/2023</td>
                                                    <td>
                                                        <a
                                                            href="https://crm-admin123.netlify.app/">https://crm-admin123.netlify.app/</a>
                                                    </td>
                                                    <td>
                                                        Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                                        Ex, voluptatibus?
                                                    </td>
                                                    <td>
                                                        <div class="table-actions d-flex align-items-center">
                                                            <button class="edit">Edit</button>
                                                            <button class="save">Save</button>
                                                        </div>


                                                    </td>
                                                </tr>
                                                <tr class="">
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="table-arrow">
                                                                <!-- <i class="fa-duotone fa-circle-chevron-down"></i> -->
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>Jhon Doe</td>
                                                    <td class="">
                                                        CEO
                                                    </td>
                                                    <td class="bussiness-name">Jhon D. </td>
                                                    <td>jhon@gmail.com</td>
                                                    <td>
                                                        <div class="dropdown table-dropdown">
                                                            <a class="btn  dropdown-toggle table-dropdown-btn new"
                                                                href="#" role="button" id="dropdownMenuLink"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                New Lead
                                                            </a>

                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                <li><a class="dropdown-item contracted"
                                                                        href="#">Contracted</a></li>
                                                                <li><a class="dropdown-item follow-up"
                                                                        href="#">Follow-Up</a></li>
                                                                <li><a class="dropdown-item in-progress" href="#">In
                                                                        Progress</a></li>
                                                                <li><a class="dropdown-item failed"
                                                                        href="#">Failed</a></li>
                                                                <li><a class="dropdown-item qualified"
                                                                        href="#">Qualified</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                    <td>AB Divilar</td>

                                                    <td>
                                                        Pakistan
                                                    </td>

                                                    <td>
                                                        0300 887 6652
                                                    </td>
                                                    <td>
                                                        12/8/2023
                                                    </td>
                                                    <td>12/8/2023</td>
                                                    <td>
                                                        <a
                                                            href="https://crm-admin123.netlify.app/">https://crm-admin123.netlify.app/</a>
                                                    </td>
                                                    <td>
                                                        Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                                        Ex, voluptatibus?
                                                    </td>
                                                    <td>
                                                        <div class="table-actions d-flex align-items-center">
                                                            <button class="edit">Edit</button>
                                                            <button class="save">Save</button>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr class="">
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="table-arrow">
                                                                <!-- <i class="fa-duotone fa-circle-chevron-down"></i> -->
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>Jhon Doe</td>
                                                    <td class="">
                                                        CEO
                                                    </td>
                                                    <td class="bussiness-name">Jhon D. </td>
                                                    <td>jhon@gmail.com</td>
                                                    <td>
                                                        <div class="dropdown table-dropdown">
                                                            <a class="btn  dropdown-toggle table-dropdown-btn new"
                                                                href="#" role="button" id="dropdownMenuLink"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                New Lead
                                                            </a>

                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                <li><a class="dropdown-item contracted"
                                                                        href="#">Contracted</a></li>
                                                                <li><a class="dropdown-item follow-up"
                                                                        href="#">Follow-Up</a></li>
                                                                <li><a class="dropdown-item in-progress" href="#">In
                                                                        Progress</a></li>
                                                                <li><a class="dropdown-item failed"
                                                                        href="#">Failed</a></li>
                                                                <li><a class="dropdown-item qualified"
                                                                        href="#">Qualified</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                    <td>AB Divilar</td>

                                                    <td>
                                                        Pakistan
                                                    </td>

                                                    <td>
                                                        0300 887 6652
                                                    </td>
                                                    <td>
                                                        12/8/2023
                                                    </td>
                                                    <td>12/8/2023</td>
                                                    <td>
                                                        <a
                                                            href="https://crm-admin123.netlify.app/">https://crm-admin123.netlify.app/</a>
                                                    </td>
                                                    <td>
                                                        Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                                        Ex, voluptatibus?
                                                    </td>
                                                    <td>
                                                        <div class="table-actions d-flex align-items-center">
                                                            <button class="edit">Edit</button>
                                                            <button class="save">Save</button>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr class="">
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="table-arrow">
                                                                <!-- <i class="fa-duotone fa-circle-chevron-down"></i> -->
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>Jhon Doe</td>
                                                    <td class="">
                                                        CEO
                                                    </td>
                                                    <td class="bussiness-name">Jhon D. </td>
                                                    <td>jhon@gmail.com</td>
                                                    <td>
                                                        <div class="dropdown table-dropdown">
                                                            <a class="btn  dropdown-toggle table-dropdown-btn new"
                                                                href="#" role="button" id="dropdownMenuLink"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                New Lead
                                                            </a>

                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                <li><a class="dropdown-item contracted"
                                                                        href="#">Contracted</a></li>
                                                                <li><a class="dropdown-item follow-up"
                                                                        href="#">Follow-Up</a></li>
                                                                <li><a class="dropdown-item in-progress" href="#">In
                                                                        Progress</a></li>
                                                                <li><a class="dropdown-item failed"
                                                                        href="#">Failed</a></li>
                                                                <li><a class="dropdown-item qualified"
                                                                        href="#">Qualified</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                    <td>AB Divilar</td>

                                                    <td>
                                                        Pakistan
                                                    </td>

                                                    <td>
                                                        0300 887 6652
                                                    </td>
                                                    <td>
                                                        12/8/2023
                                                    </td>
                                                    <td>12/8/2023</td>
                                                    <td>
                                                        <a
                                                            href="https://crm-admin123.netlify.app/">https://crm-admin123.netlify.app/</a>
                                                    </td>
                                                    <td>
                                                        Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                                        Ex, voluptatibus?
                                                    </td>
                                                    <td>
                                                        <div class="table-actions d-flex align-items-center">
                                                            <button class="edit">Edit</button>
                                                            <button class="save">Save</button>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr class="">
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="table-arrow">
                                                                <!-- <i class="fa-duotone fa-circle-chevron-down"></i> -->
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>Jhon Doe</td>
                                                    <td class="">
                                                        CEO
                                                    </td>
                                                    <td class="bussiness-name">Jhon D. </td>
                                                    <td>jhon@gmail.com</td>
                                                    <td>
                                                        <div class="dropdown table-dropdown">
                                                            <a class="btn  dropdown-toggle table-dropdown-btn new"
                                                                href="#" role="button" id="dropdownMenuLink"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                New Lead
                                                            </a>

                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                <li><a class="dropdown-item contracted"
                                                                        href="#">Contracted</a></li>
                                                                <li><a class="dropdown-item follow-up"
                                                                        href="#">Follow-Up</a></li>
                                                                <li><a class="dropdown-item in-progress" href="#">In
                                                                        Progress</a></li>
                                                                <li><a class="dropdown-item failed"
                                                                        href="#">Failed</a></li>
                                                                <li><a class="dropdown-item qualified"
                                                                        href="#">Qualified</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                    <td>AB Divilar</td>

                                                    <td>
                                                        Pakistan
                                                    </td>

                                                    <td>
                                                        0300 887 6652
                                                    </td>
                                                    <td>
                                                        12/8/2023
                                                    </td>
                                                    <td>12/8/2023</td>
                                                    <td>
                                                        <a
                                                            href="https://crm-admin123.netlify.app/">https://crm-admin123.netlify.app/</a>
                                                    </td>
                                                    <td>
                                                        Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                                        Ex, voluptatibus?
                                                    </td>
                                                    <td>
                                                        <div class="table-actions d-flex align-items-center">
                                                            <button class="edit">Edit</button>
                                                            <button class="save">Save</button>
                                                        </div>
                                                    </td>

                                                </tr>


                                            </tbody>
                                        </table>
                                    </div>

                                    <div id="Tab2" class="tabcontent-lead">
                                        <div id="In-Progress">
                                            <table id="example-inprogress" class="table data-table-style ">
                                                <thead>
                                                    <tr>
                                                        <th class="no-sort"></th>
                                                        <th>Client Name</th>
                                                        <th>Title</th>
                                                        <th>Bussiness Name</th>
                                                        <th>Email</th>
                                                        <th>Status</th>
                                                        <th>Partners</th>
                                                        <th>Country</th>
                                                        <th>Phone Number</th>
                                                        <th>Date</th>
                                                        <th>Follow-Up Date</th>
                                                        <th>URL</th>
                                                        <th>Address</th>
                                                        <th>Actions</th>


                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="">
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="table-arrow">
                                                                    <!-- <i class="fa-duotone fa-circle-chevron-down"></i> -->
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>Jhon Doe</td>
                                                        <td class="">
                                                            CEO
                                                        </td>
                                                        <td class="bussiness-name">Jhon D. </td>
                                                        <td>jhon@gmail.com</td>
                                                        <td>
                                                            <div class="dropdown table-dropdown">
                                                                <a class="btn  dropdown-toggle table-dropdown-btn in-progress"
                                                                    href="#" role="button" id="dropdownMenuLink"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                    In Progress
                                                                </a>

                                                                <ul class="dropdown-menu"
                                                                    aria-labelledby="dropdownMenuLink">
                                                                    <li><a class="dropdown-item new" href="#">New
                                                                            Leads</a></li>
                                                                    <li><a class="dropdown-item contracted"
                                                                            href="#">Contracted</a></li>
                                                                    <li><a class="dropdown-item follow-up"
                                                                            href="#">Follow-Up</a></li>
                                                                    <li><a class="dropdown-item failed"
                                                                            href="#">Failed</a></li>
                                                                    <li><a class="dropdown-item qualified"
                                                                            href="#">Qualified</a></li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                        <td>AB Divilar</td>

                                                        <td>
                                                            Pakistan
                                                        </td>

                                                        <td>
                                                            0300 887 6652
                                                        </td>
                                                        <td>
                                                            12/8/2023
                                                        </td>
                                                        <td>12/8/2023</td>
                                                        <td>
                                                            <a
                                                                href="https://crm-admin123.netlify.app/">https://crm-admin123.netlify.app/</a>
                                                        </td>
                                                        <td>
                                                            Lorem ipsum dolor, sit amet consectetur adipisicing
                                                            elit. Ex, voluptatibus?
                                                        </td>
                                                        <td>
                                                            <div class="table-actions d-flex align-items-center">
                                                                <button class="edit">Edit</button>
                                                                <button class="save">Save</button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="">
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="table-arrow">
                                                                    <!-- <i class="fa-duotone fa-circle-chevron-down"></i> -->
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>Jhon Doe</td>
                                                        <td class="">
                                                            CEO
                                                        </td>
                                                        <td class="bussiness-name">Jhon D. </td>
                                                        <td>jhon@gmail.com</td>
                                                        <td>
                                                            <div class="dropdown table-dropdown">
                                                                <a class="btn  dropdown-toggle table-dropdown-btn in-progress"
                                                                    href="#" role="button" id="dropdownMenuLink"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                    In Progress
                                                                </a>

                                                                <ul class="dropdown-menu"
                                                                    aria-labelledby="dropdownMenuLink">
                                                                    <li><a class="dropdown-item new" href="#">New
                                                                            Leads</a></li>
                                                                    <li><a class="dropdown-item contracted"
                                                                            href="#">Contracted</a></li>
                                                                    <li><a class="dropdown-item follow-up"
                                                                            href="#">Follow-Up</a></li>
                                                                    <li><a class="dropdown-item failed"
                                                                            href="#">Failed</a></li>
                                                                    <li><a class="dropdown-item qualified"
                                                                            href="#">Qualified</a></li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                        <td>AB Divilar</td>

                                                        <td>
                                                            Pakistan
                                                        </td>

                                                        <td>
                                                            0300 887 6652
                                                        </td>
                                                        <td>
                                                            12/8/2023
                                                        </td>
                                                        <td>12/8/2023</td>
                                                        <td>
                                                            <a
                                                                href="https://crm-admin123.netlify.app/">https://crm-admin123.netlify.app/</a>
                                                        </td>
                                                        <td>
                                                            Lorem ipsum dolor, sit amet consectetur adipisicing
                                                            elit. Ex, voluptatibus?
                                                        </td>
                                                        <td>
                                                            <div class="table-actions d-flex align-items-center">
                                                                <button class="edit">Edit</button>
                                                                <button class="save">Save</button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="">
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="table-arrow">
                                                                    <!-- <i class="fa-duotone fa-circle-chevron-down"></i> -->
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>Jhon Doe</td>
                                                        <td class="">
                                                            CEO
                                                        </td>
                                                        <td class="bussiness-name">Jhon D. </td>
                                                        <td>jhon@gmail.com</td>
                                                        <td>
                                                            <div class="dropdown table-dropdown">
                                                                <a class="btn  dropdown-toggle table-dropdown-btn in-progress"
                                                                    href="#" role="button" id="dropdownMenuLink"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                    In Progress
                                                                </a>

                                                                <ul class="dropdown-menu"
                                                                    aria-labelledby="dropdownMenuLink">
                                                                    <li><a class="dropdown-item new" href="#">New
                                                                            Leads</a></li>
                                                                    <li><a class="dropdown-item contracted"
                                                                            href="#">Contracted</a></li>
                                                                    <li><a class="dropdown-item follow-up"
                                                                            href="#">Follow-Up</a></li>
                                                                    <li><a class="dropdown-item failed"
                                                                            href="#">Failed</a></li>
                                                                    <li><a class="dropdown-item qualified"
                                                                            href="#">Qualified</a></li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                        <td>AB Divilar</td>

                                                        <td>
                                                            Pakistan
                                                        </td>

                                                        <td>
                                                            0300 887 6652
                                                        </td>
                                                        <td>
                                                            12/8/2023
                                                        </td>
                                                        <td>12/8/2023</td>
                                                        <td>
                                                            <a
                                                                href="https://crm-admin123.netlify.app/">https://crm-admin123.netlify.app/</a>
                                                        </td>
                                                        <td>
                                                            Lorem ipsum dolor, sit amet consectetur adipisicing
                                                            elit. Ex, voluptatibus?
                                                        </td>
                                                        <td>
                                                            <div class="table-actions d-flex align-items-center">
                                                                <button class="edit">Edit</button>
                                                                <button class="save">Save</button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="">
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="table-arrow">
                                                                    <!-- <i class="fa-duotone fa-circle-chevron-down"></i> -->
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>Jhon Doe</td>
                                                        <td class="">
                                                            CEO
                                                        </td>
                                                        <td class="bussiness-name">Jhon D. </td>
                                                        <td>jhon@gmail.com</td>
                                                        <td>
                                                            <div class="dropdown table-dropdown">
                                                                <a class="btn  dropdown-toggle table-dropdown-btn in-progress"
                                                                    href="#" role="button" id="dropdownMenuLink"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                    In Progress
                                                                </a>

                                                                <ul class="dropdown-menu"
                                                                    aria-labelledby="dropdownMenuLink">
                                                                    <li><a class="dropdown-item new" href="#">New
                                                                            Leads</a></li>
                                                                    <li><a class="dropdown-item contracted"
                                                                            href="#">Contracted</a></li>
                                                                    <li><a class="dropdown-item follow-up"
                                                                            href="#">Follow-Up</a></li>
                                                                    <li><a class="dropdown-item failed"
                                                                            href="#">Failed</a></li>
                                                                    <li><a class="dropdown-item qualified"
                                                                            href="#">Qualified</a></li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                        <td>AB Divilar</td>

                                                        <td>
                                                            Pakistan
                                                        </td>

                                                        <td>
                                                            0300 887 6652
                                                        </td>
                                                        <td>
                                                            12/8/2023
                                                        </td>
                                                        <td>12/8/2023</td>
                                                        <td>
                                                            <a
                                                                href="https://crm-admin123.netlify.app/">https://crm-admin123.netlify.app/</a>
                                                        </td>
                                                        <td>
                                                            Lorem ipsum dolor, sit amet consectetur adipisicing
                                                            elit. Ex, voluptatibus?
                                                        </td>
                                                        <td>
                                                            <div class="table-actions d-flex align-items-center">
                                                                <button class="edit">Edit</button>
                                                                <button class="save">Save</button>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div id="Tab3" class="tabcontent-lead">

                                        <table id="example-failed" class="table data-table-style ">
                                            <thead>
                                                <tr>
                                                    <th class="no-sort"></th>
                                                    <th>Client Name</th>
                                                    <th>Title</th>
                                                    <th>Bussiness Name</th>
                                                    <th>Email</th>
                                                    <th>Status</th>
                                                    <th>Partners</th>
                                                    <th>Country</th>
                                                    <th>Phone Number</th>
                                                    <th>Date</th>
                                                    <th>Follow-Up Date</th>
                                                    <th>URL</th>
                                                    <th>Address</th>
                                                    <th>Actions</th>


                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="">
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="table-arrow">
                                                                <!-- <i class="fa-duotone fa-circle-chevron-down"></i> -->
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>Jhon Doe</td>
                                                    <td class="">
                                                        CEO
                                                    </td>
                                                    <td class="bussiness-name">Jhon D. </td>
                                                    <td>jhon@gmail.com</td>
                                                    <td>
                                                        <div class="dropdown table-dropdown">
                                                            <a class="btn  dropdown-toggle table-dropdown-btn failed"
                                                                href="#" role="button" id="dropdownMenuLink"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                Failed
                                                            </a>

                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                <li><a class="dropdown-item in-progress"
                                                                        href="#">In-Progress</a></li>
                                                                <li><a class="dropdown-item new" href="#">New
                                                                        Leads</a></li>
                                                                <li><a class="dropdown-item contracted"
                                                                        href="#">Contracted</a></li>
                                                                <li><a class="dropdown-item follow-up"
                                                                        href="#">Follow-Up</a></li>

                                                                <li><a class="dropdown-item qualified"
                                                                        href="#">Qualified</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                    <td>AB Divilar</td>

                                                    <td>
                                                        Pakistan
                                                    </td>

                                                    <td>
                                                        0300 887 6652
                                                    </td>
                                                    <td>
                                                        12/8/2023
                                                    </td>
                                                    <td>12/8/2023</td>
                                                    <td>
                                                        <a
                                                            href="https://crm-admin123.netlify.app/">https://crm-admin123.netlify.app/</a>
                                                    </td>
                                                    <td>
                                                        Lorem ipsum dolor, sit amet consectetur adipisicing
                                                        elit. Ex, voluptatibus?
                                                    </td>
                                                    <td>
                                                        <div class="table-actions d-flex align-items-center">
                                                            <button class="edit">Edit</button>
                                                            <button class="save">Save</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="">
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="table-arrow">
                                                                <!-- <i class="fa-duotone fa-circle-chevron-down"></i> -->
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>Jhon Doe</td>
                                                    <td class="">
                                                        CEO
                                                    </td>
                                                    <td class="bussiness-name">Jhon D. </td>
                                                    <td>jhon@gmail.com</td>
                                                    <td>
                                                        <div class="dropdown table-dropdown">
                                                            <a class="btn  dropdown-toggle table-dropdown-btn failed"
                                                                href="#" role="button" id="dropdownMenuLink"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                Failed
                                                            </a>

                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                <li><a class="dropdown-item in-progress"
                                                                        href="#">In-Progress</a></li>
                                                                <li><a class="dropdown-item new" href="#">New
                                                                        Leads</a></li>
                                                                <li><a class="dropdown-item contracted"
                                                                        href="#">Contracted</a></li>
                                                                <li><a class="dropdown-item follow-up"
                                                                        href="#">Follow-Up</a></li>

                                                                <li><a class="dropdown-item qualified"
                                                                        href="#">Qualified</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                    <td>AB Divilar</td>

                                                    <td>
                                                        Pakistan
                                                    </td>

                                                    <td>
                                                        0300 887 6652
                                                    </td>
                                                    <td>
                                                        12/8/2023
                                                    </td>
                                                    <td>12/8/2023</td>
                                                    <td>
                                                        <a
                                                            href="https://crm-admin123.netlify.app/">https://crm-admin123.netlify.app/</a>
                                                    </td>
                                                    <td>
                                                        Lorem ipsum dolor, sit amet consectetur adipisicing
                                                        elit. Ex, voluptatibus?
                                                    </td>
                                                    <td>
                                                        <div class="table-actions d-flex align-items-center">
                                                            <button class="edit">Edit</button>
                                                            <button class="save">Save</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="">
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="table-arrow">
                                                                <!-- <i class="fa-duotone fa-circle-chevron-down"></i> -->
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>Jhon Doe</td>
                                                    <td class="">
                                                        CEO
                                                    </td>
                                                    <td class="bussiness-name">Jhon D. </td>
                                                    <td>jhon@gmail.com</td>
                                                    <td>
                                                        <div class="dropdown table-dropdown">
                                                            <a class="btn  dropdown-toggle table-dropdown-btn failed"
                                                                href="#" role="button" id="dropdownMenuLink"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                Failed
                                                            </a>

                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                <li><a class="dropdown-item in-progress"
                                                                        href="#">In-Progress</a></li>
                                                                <li><a class="dropdown-item new" href="#">New
                                                                        Leads</a></li>
                                                                <li><a class="dropdown-item contracted"
                                                                        href="#">Contracted</a></li>
                                                                <li><a class="dropdown-item follow-up"
                                                                        href="#">Follow-Up</a></li>

                                                                <li><a class="dropdown-item qualified"
                                                                        href="#">Qualified</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                    <td>AB Divilar</td>

                                                    <td>
                                                        Pakistan
                                                    </td>

                                                    <td>
                                                        0300 887 6652
                                                    </td>
                                                    <td>
                                                        12/8/2023
                                                    </td>
                                                    <td>12/8/2023</td>
                                                    <td>
                                                        <a
                                                            href="https://crm-admin123.netlify.app/">https://crm-admin123.netlify.app/</a>
                                                    </td>
                                                    <td>
                                                        Lorem ipsum dolor, sit amet consectetur adipisicing
                                                        elit. Ex, voluptatibus?
                                                    </td>
                                                    <td>
                                                        <div class="table-actions d-flex align-items-center">
                                                            <button class="edit">Edit</button>
                                                            <button class="save">Save</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="">
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="table-arrow">
                                                                <!-- <i class="fa-duotone fa-circle-chevron-down"></i> -->
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>Jhon Doe</td>
                                                    <td class="">
                                                        CEO
                                                    </td>
                                                    <td class="bussiness-name">Jhon D. </td>
                                                    <td>jhon@gmail.com</td>
                                                    <td>
                                                        <div class="dropdown table-dropdown">
                                                            <a class="btn  dropdown-toggle table-dropdown-btn failed"
                                                                href="#" role="button" id="dropdownMenuLink"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                Failed
                                                            </a>

                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                <li><a class="dropdown-item in-progress"
                                                                        href="#">In-Progress</a></li>
                                                                <li><a class="dropdown-item new" href="#">New
                                                                        Leads</a></li>
                                                                <li><a class="dropdown-item contracted"
                                                                        href="#">Contracted</a></li>
                                                                <li><a class="dropdown-item follow-up"
                                                                        href="#">Follow-Up</a></li>

                                                                <li><a class="dropdown-item qualified"
                                                                        href="#">Qualified</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                    <td>AB Divilar</td>

                                                    <td>
                                                        Pakistan
                                                    </td>

                                                    <td>
                                                        0300 887 6652
                                                    </td>
                                                    <td>
                                                        12/8/2023
                                                    </td>
                                                    <td>12/8/2023</td>
                                                    <td>
                                                        <a
                                                            href="https://crm-admin123.netlify.app/">https://crm-admin123.netlify.app/</a>
                                                    </td>
                                                    <td>
                                                        Lorem ipsum dolor, sit amet consectetur adipisicing
                                                        elit. Ex, voluptatibus?
                                                    </td>
                                                    <td>
                                                        <div class="table-actions d-flex align-items-center">
                                                            <button class="edit">Edit</button>
                                                            <button class="save">Save</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="">
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="table-arrow">
                                                                <!-- <i class="fa-duotone fa-circle-chevron-down"></i> -->
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>Jhon Doe</td>
                                                    <td class="">
                                                        CEO
                                                    </td>
                                                    <td class="bussiness-name">Jhon D. </td>
                                                    <td>jhon@gmail.com</td>
                                                    <td>
                                                        <div class="dropdown table-dropdown">
                                                            <a class="btn  dropdown-toggle table-dropdown-btn failed"
                                                                href="#" role="button" id="dropdownMenuLink"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                Failed
                                                            </a>

                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                <li><a class="dropdown-item in-progress"
                                                                        href="#">In-Progress</a></li>
                                                                <li><a class="dropdown-item new" href="#">New
                                                                        Leads</a></li>
                                                                <li><a class="dropdown-item contracted"
                                                                        href="#">Contracted</a></li>
                                                                <li><a class="dropdown-item follow-up"
                                                                        href="#">Follow-Up</a></li>

                                                                <li><a class="dropdown-item qualified"
                                                                        href="#">Qualified</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                    <td>AB Divilar</td>

                                                    <td>
                                                        Pakistan
                                                    </td>

                                                    <td>
                                                        0300 887 6652
                                                    </td>
                                                    <td>
                                                        12/8/2023
                                                    </td>
                                                    <td>12/8/2023</td>
                                                    <td>
                                                        <a
                                                            href="https://crm-admin123.netlify.app/">https://crm-admin123.netlify.app/</a>
                                                    </td>
                                                    <td>
                                                        Lorem ipsum dolor, sit amet consectetur adipisicing
                                                        elit. Ex, voluptatibus?
                                                    </td>
                                                    <td>
                                                        <div class="table-actions d-flex align-items-center">
                                                            <button class="edit">Edit</button>
                                                            <button class="save">Save</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="">
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="table-arrow">
                                                                <!-- <i class="fa-duotone fa-circle-chevron-down"></i> -->
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>Jhon Doe</td>
                                                    <td class="">
                                                        CEO
                                                    </td>
                                                    <td class="bussiness-name">Jhon D. </td>
                                                    <td>jhon@gmail.com</td>
                                                    <td>
                                                        <div class="dropdown table-dropdown">
                                                            <a class="btn  dropdown-toggle table-dropdown-btn failed"
                                                                href="#" role="button" id="dropdownMenuLink"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                Failed
                                                            </a>

                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                <li><a class="dropdown-item in-progress"
                                                                        href="#">In-Progress</a></li>
                                                                <li><a class="dropdown-item new" href="#">New
                                                                        Leads</a></li>
                                                                <li><a class="dropdown-item contracted"
                                                                        href="#">Contracted</a></li>
                                                                <li><a class="dropdown-item follow-up"
                                                                        href="#">Follow-Up</a></li>

                                                                <li><a class="dropdown-item qualified"
                                                                        href="#">Qualified</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                    <td>AB Divilar</td>

                                                    <td>
                                                        Pakistan
                                                    </td>

                                                    <td>
                                                        0300 887 6652
                                                    </td>
                                                    <td>
                                                        12/8/2023
                                                    </td>
                                                    <td>12/8/2023</td>
                                                    <td>
                                                        <a
                                                            href="https://crm-admin123.netlify.app/">https://crm-admin123.netlify.app/</a>
                                                    </td>
                                                    <td>
                                                        Lorem ipsum dolor, sit amet consectetur adipisicing
                                                        elit. Ex, voluptatibus?
                                                    </td>
                                                    <td>
                                                        <div class="table-actions d-flex align-items-center">
                                                            <button class="edit">Edit</button>
                                                            <button class="save">Save</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>

                                    <div id="Tab4" class="tabcontent-lead">
                                        <table id="example-qualify" class="table data-table-style ">
                                            <thead>
                                                <tr>
                                                    <th class="no-sort"></th>
                                                    <th>Client Name</th>
                                                    <th>Title</th>
                                                    <th>Bussiness Name</th>
                                                    <th>Email</th>
                                                    <th>Status</th>
                                                    <th>Partners</th>
                                                    <th>Country</th>
                                                    <th>Phone Number</th>
                                                    <th>Date</th>
                                                    <th>Follow-Up Date</th>
                                                    <th>URL</th>
                                                    <th>Address</th>
                                                    <th>Actions</th>


                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="">
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="table-arrow">
                                                                <!-- <i class="fa-duotone fa-circle-chevron-down"></i> -->
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>Jhon Doe</td>
                                                    <td class="">
                                                        CEO
                                                    </td>
                                                    <td class="bussiness-name">Jhon D. </td>
                                                    <td>jhon@gmail.com</td>
                                                    <td>
                                                        <div class="dropdown table-dropdown">
                                                            <a class="btn  dropdown-toggle table-dropdown-btn qualified"
                                                                href="#" role="button" id="dropdownMenuLink"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                Qualified
                                                            </a>

                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                <li><a class="dropdown-item in-progress"
                                                                        href="#">In-Progress</a></li>
                                                                <li><a class="dropdown-item new" href="#">New
                                                                        Leads</a></li>
                                                                <li><a class="dropdown-item contracted"
                                                                        href="#">Contracted</a></li>
                                                                <li><a class="dropdown-item follow-up"
                                                                        href="#">Follow-Up</a></li>

                                                                <li><a class="dropdown-item failed "
                                                                        href="#">Failed</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                    <td>AB Divilar</td>

                                                    <td>
                                                        Pakistan
                                                    </td>

                                                    <td>
                                                        0300 887 6652
                                                    </td>
                                                    <td>
                                                        12/8/2023
                                                    </td>
                                                    <td>12/8/2023</td>
                                                    <td>
                                                        <a
                                                            href="https://crm-admin123.netlify.app/">https://crm-admin123.netlify.app/</a>
                                                    </td>
                                                    <td>
                                                        Lorem ipsum dolor, sit amet consectetur adipisicing
                                                        elit. Ex, voluptatibus?
                                                    </td>
                                                    <td>
                                                        <div class="table-actions d-flex align-items-center">
                                                            <button class="edit">Edit</button>
                                                            <button class="save">Save</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="">
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="table-arrow">
                                                                <!-- <i class="fa-duotone fa-circle-chevron-down"></i> -->
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>Jhon Doe</td>
                                                    <td class="">
                                                        CEO
                                                    </td>
                                                    <td class="bussiness-name">Jhon D. </td>
                                                    <td>jhon@gmail.com</td>
                                                    <td>
                                                        <div class="dropdown table-dropdown">
                                                            <a class="btn  dropdown-toggle table-dropdown-btn qualified"
                                                                href="#" role="button" id="dropdownMenuLink"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                Qualified
                                                            </a>

                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                <li><a class="dropdown-item in-progress"
                                                                        href="#">In-Progress</a></li>
                                                                <li><a class="dropdown-item new" href="#">New
                                                                        Leads</a></li>
                                                                <li><a class="dropdown-item contracted"
                                                                        href="#">Contracted</a></li>
                                                                <li><a class="dropdown-item follow-up"
                                                                        href="#">Follow-Up</a></li>

                                                                <li><a class="dropdown-item failed "
                                                                        href="#">Failed</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                    <td>AB Divilar</td>

                                                    <td>
                                                        Pakistan
                                                    </td>

                                                    <td>
                                                        0300 887 6652
                                                    </td>
                                                    <td>
                                                        12/8/2023
                                                    </td>
                                                    <td>12/8/2023</td>
                                                    <td>
                                                        <a
                                                            href="https://crm-admin123.netlify.app/">https://crm-admin123.netlify.app/</a>
                                                    </td>
                                                    <td>
                                                        Lorem ipsum dolor, sit amet consectetur adipisicing
                                                        elit. Ex, voluptatibus?
                                                    </td>
                                                    <td>
                                                        <div class="table-actions d-flex align-items-center">
                                                            <button class="edit">Edit</button>
                                                            <button class="save">Save</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="">
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="table-arrow">
                                                                <!-- <i class="fa-duotone fa-circle-chevron-down"></i> -->
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>Jhon Doe</td>
                                                    <td class="">
                                                        CEO
                                                    </td>
                                                    <td class="bussiness-name">Jhon D. </td>
                                                    <td>jhon@gmail.com</td>
                                                    <td>
                                                        <div class="dropdown table-dropdown">
                                                            <a class="btn  dropdown-toggle table-dropdown-btn qualified"
                                                                href="#" role="button" id="dropdownMenuLink"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                Qualified
                                                            </a>

                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                <li><a class="dropdown-item in-progress"
                                                                        href="#">In-Progress</a></li>
                                                                <li><a class="dropdown-item new" href="#">New
                                                                        Leads</a></li>
                                                                <li><a class="dropdown-item contracted"
                                                                        href="#">Contracted</a></li>
                                                                <li><a class="dropdown-item follow-up"
                                                                        href="#">Follow-Up</a></li>

                                                                <li><a class="dropdown-item failed "
                                                                        href="#">Failed</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                    <td>AB Divilar</td>

                                                    <td>
                                                        Pakistan
                                                    </td>

                                                    <td>
                                                        0300 887 6652
                                                    </td>
                                                    <td>
                                                        12/8/2023
                                                    </td>
                                                    <td>12/8/2023</td>
                                                    <td>
                                                        <a
                                                            href="https://crm-admin123.netlify.app/">https://crm-admin123.netlify.app/</a>
                                                    </td>
                                                    <td>
                                                        Lorem ipsum dolor, sit amet consectetur adipisicing
                                                        elit. Ex, voluptatibus?
                                                    </td>
                                                    <td>
                                                        <div class="table-actions d-flex align-items-center">
                                                            <button class="edit">Edit</button>
                                                            <button class="save">Save</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="">
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="table-arrow">
                                                                <!-- <i class="fa-duotone fa-circle-chevron-down"></i> -->
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>Jhon Doe</td>
                                                    <td class="">
                                                        CEO
                                                    </td>
                                                    <td class="bussiness-name">Jhon D. </td>
                                                    <td>jhon@gmail.com</td>
                                                    <td>
                                                        <div class="dropdown table-dropdown">
                                                            <a class="btn  dropdown-toggle table-dropdown-btn qualified"
                                                                href="#" role="button" id="dropdownMenuLink"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                Qualified
                                                            </a>

                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                <li><a class="dropdown-item in-progress"
                                                                        href="#">In-Progress</a></li>
                                                                <li><a class="dropdown-item new" href="#">New
                                                                        Leads</a></li>
                                                                <li><a class="dropdown-item contracted"
                                                                        href="#">Contracted</a></li>
                                                                <li><a class="dropdown-item follow-up"
                                                                        href="#">Follow-Up</a></li>

                                                                <li><a class="dropdown-item failed "
                                                                        href="#">Failed</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                    <td>AB Divilar</td>

                                                    <td>
                                                        Pakistan
                                                    </td>

                                                    <td>
                                                        0300 887 6652
                                                    </td>
                                                    <td>
                                                        12/8/2023
                                                    </td>
                                                    <td>12/8/2023</td>
                                                    <td>
                                                        <a
                                                            href="https://crm-admin123.netlify.app/">https://crm-admin123.netlify.app/</a>
                                                    </td>
                                                    <td>
                                                        Lorem ipsum dolor, sit amet consectetur adipisicing
                                                        elit. Ex, voluptatibus?
                                                    </td>
                                                    <td>
                                                        <div class="table-actions d-flex align-items-center">
                                                            <button class="edit">Edit</button>
                                                            <button class="save">Save</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="">
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="table-arrow">
                                                                <!-- <i class="fa-duotone fa-circle-chevron-down"></i> -->
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>Jhon Doe</td>
                                                    <td class="">
                                                        CEO
                                                    </td>
                                                    <td class="bussiness-name">Jhon D. </td>
                                                    <td>jhon@gmail.com</td>
                                                    <td>
                                                        <div class="dropdown table-dropdown">
                                                            <a class="btn  dropdown-toggle table-dropdown-btn qualified"
                                                                href="#" role="button" id="dropdownMenuLink"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                Qualified
                                                            </a>

                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                <li><a class="dropdown-item in-progress"
                                                                        href="#">In-Progress</a></li>
                                                                <li><a class="dropdown-item new" href="#">New
                                                                        Leads</a></li>
                                                                <li><a class="dropdown-item contracted"
                                                                        href="#">Contracted</a></li>
                                                                <li><a class="dropdown-item follow-up"
                                                                        href="#">Follow-Up</a></li>

                                                                <li><a class="dropdown-item failed "
                                                                        href="#">Failed</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                    <td>AB Divilar</td>

                                                    <td>
                                                        Pakistan
                                                    </td>

                                                    <td>
                                                        0300 887 6652
                                                    </td>
                                                    <td>
                                                        12/8/2023
                                                    </td>
                                                    <td>12/8/2023</td>
                                                    <td>
                                                        <a
                                                            href="https://crm-admin123.netlify.app/">https://crm-admin123.netlify.app/</a>
                                                    </td>
                                                    <td>
                                                        Lorem ipsum dolor, sit amet consectetur adipisicing
                                                        elit. Ex, voluptatibus?
                                                    </td>
                                                    <td>
                                                        <div class="table-actions d-flex align-items-center">
                                                            <button class="edit">Edit</button>
                                                            <button class="save">Save</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="">
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="table-arrow">
                                                                <!-- <i class="fa-duotone fa-circle-chevron-down"></i> -->
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>Jhon Doe</td>
                                                    <td class="">
                                                        CEO
                                                    </td>
                                                    <td class="bussiness-name">Jhon D. </td>
                                                    <td>jhon@gmail.com</td>
                                                    <td>
                                                        <div class="dropdown table-dropdown">
                                                            <a class="btn  dropdown-toggle table-dropdown-btn qualified"
                                                                href="#" role="button" id="dropdownMenuLink"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                Qualified
                                                            </a>

                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                <li><a class="dropdown-item in-progress"
                                                                        href="#">In-Progress</a></li>
                                                                <li><a class="dropdown-item new" href="#">New
                                                                        Leads</a></li>
                                                                <li><a class="dropdown-item contracted"
                                                                        href="#">Contracted</a></li>
                                                                <li><a class="dropdown-item follow-up"
                                                                        href="#">Follow-Up</a></li>

                                                                <li><a class="dropdown-item failed "
                                                                        href="#">Failed</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                    <td>AB Divilar</td>

                                                    <td>
                                                        Pakistan
                                                    </td>

                                                    <td>
                                                        0300 887 6652
                                                    </td>
                                                    <td>
                                                        12/8/2023
                                                    </td>
                                                    <td>12/8/2023</td>
                                                    <td>
                                                        <a
                                                            href="https://crm-admin123.netlify.app/">https://crm-admin123.netlify.app/</a>
                                                    </td>
                                                    <td>
                                                        Lorem ipsum dolor, sit amet consectetur adipisicing
                                                        elit. Ex, voluptatibus?
                                                    </td>
                                                    <td>
                                                        <div class="table-actions d-flex align-items-center">
                                                            <button class="edit">Edit</button>
                                                            <button class="save">Save</button>
                                                        </div>
                                                    </td>
                                                </tr>
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
@endsection
