@extends('layouts.client')

@section('content')
    <main class="content ">
        <div class="container-fluid px-lg-0">
            <div class="row justify-content-center">
                <div class="col-xl-12 ">
                    <div class="row">
                        <div class="col-lg-12 h-100">
                            <div class="box mb-3 box-p">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <h1 class="f-20 w-500 mb-0 pb-0 text-dark-clr">Tickets</h1>
                                        <a class="table-btn" href="{{ route('client.support.create') }}"> <i
                                                class="bi bi-plus-circle me-1"></i>
                                            Open New Ticket</a>
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
@endsection
@endsection
