@extends('layouts.app')

@section('content')
    <main class="content ">
        <div class="container-fluid px-lg-0">
            <div class="row justify-content-center">
                <div class="col-xl-12 ">
                    @php
                        $colors = ['alert', 'warning', 'success', 'info'];
                    @endphp
                    <div class="box ticket-links mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h1 class="f-20 w-500 mb-3 text-dark-clr pt-1">Logs</h1>
                            <form action="{{ route('staff.clear_logs') }}" method="get">
                                @csrf
                                <button type="submit" class="table-btn">Clear Logs</button>
                            </form>
                        </div>
                        <div class="pt-2">
                            <pre class="text-dark-clr">{{ !empty($logContent) ? $logContent : 'No logs' }}</pre>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

@section('script')
@endsection
@endsection
