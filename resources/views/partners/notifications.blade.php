@extends('layouts.partner')

@section('content')
    <main class="content ">
        <div class="container-fluid px-lg-0">
            <div class="row justify-content-center">
                <div class="col-xl-12 ">
                    @php
                        $colors = ['alert', 'warning', 'success', 'info'];
                    @endphp
                    <div class="box ticket-links mb-3">
                        <h1 class="f-20 w-500 mb-3 text-dark-clr pt-1">All Notifications</h1>
                        <div class="pt-2">
                            @forelse (auth()->user()->notifications as $notification)
                                <a class="ticket-notify px-0  mb-3"
                                    href="{{ !empty($notification->data['link']) ? $notification->data['link'] : '#' }}">
                                    <div class="ticket-body ticket-{{ $colors[array_rand($colors)] }}">
                                        <h4 class="text-gray text-start justify-content-start mb-2">
                                            {{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</h4>
                                        <p style="{{ empty($notification->read_at) ? 'font-weight: 600' : '' }}"
                                            class="mb-2 ellipsis-2">
                                            @if (empty($notification->read_at))
                                                <i class="bi bi-dot"></i>
                                            @endif
                                            {{ $notification->data['message'] }}
                                        </p>
                                    </div>
                                </a>
                            @empty
                                <p>No notifications</p>
                            @endforelse
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
    @endsection
@endsection
