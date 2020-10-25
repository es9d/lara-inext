@extends('layouts.app', ['page' => 'dashboard'])

@section('title', __('messages.dashboard'))

@section('page_header')
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('messages.dashboard') }}</li>
                </ol>
            </nav>
            <h1 class="m-0">{{ __('messages.dashboard') }}</h1>
        </div>
    </div>
@endsection

@section('content')
    <div class="row card-group-row">
        <div class="col-lg-3 col-md-6 card-group-row__col">
            <div class="card card-group-row__card">
                <div class="card-body-x-lg card-body d-flex flex-row align-items-center" style="padding-bottom:0">
                    <div class="flex">
                        <a href="{{route('customers')}}" class="text-decoration-none">
                            <div class="card-header__title text-muted mb-2 d-flex">
                                {{ __('messages.customers') }}
                            </div>
                            <span class="h4 m-0">{{ $customersCount }}</span>
                        </a>
                    </div>
                    <div><i class="material-icons icon-muted icon-40pt ml-3">account_box</i></div>
                </div>
                <div class="card-body-x-lg card-body" style="padding-top: 0;">
                    <button class="btn btn-sm btn-dashboard-link" style="float: right;" to="customers">+ Create Customer</button>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 card-group-row__col">
            <div class="card card-group-row__card">
                <div class="card-body-x-lg card-body d-flex flex-row align-items-center" style="padding-bottom:0">
                    <div class="flex">
                        <a href="{{route('invoices')}}" class="text-decoration-none">
                            <div class="card-header__title text-muted mb-2 d-flex">
                                {{ __('messages.invoices') }}
                            </div>
                            <span class="h4 m-0">{{ $invoicesCount }}</span>
                        </a>
                    </div>
                    <div><i class="material-icons icon-muted icon-40pt ml-3">receipt</i></div>
                </div>
                <div class="card-body-x-lg card-body" style="padding-top: 0;">
                    <button class="btn btn-sm btn-dashboard-link" style="float: right;" to="invoices">+ Create Invoice</button>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 card-group-row__col">
            <div class="card card-group-row__card">
                <div class="card-body-x-lg card-body d-flex flex-row align-items-center" style="padding-bottom:0">
                    <div class="flex">
                        <a href="{{route('estimates')}}" class="text-decoration-none">
                            <div class="card-header__title text-muted mb-2 d-flex">
                                {{ __('messages.estimates') }}
                            </div>
                            <span class="h4 m-0">{{ $estimatesCount }}</span>
                        </a>
                    </div>
                    <div><i class="material-icons icon-muted icon-40pt ml-3">description</i></div>
                </div>
                <div class="card-body-x-lg card-body" style="padding-top: 0;">
                    <button class="btn btn-sm btn-dashboard-link" style="float: right;" to="estimates">+ Create Estimate</button>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 card-group-row__col">
            <div class="card card-group-row__card">
                <div class="card-body-x-lg card-body d-flex flex-row align-items-center" style="padding-bottom:0">
                    <div class="flex">
                        <div class="card-header__title text-muted mb-2 d-flex">{{ __('messages.due_amount') }}</div>
                        <span class="h4 m-0">{{ money($totalDueAmount, $currentCompany->currency->code) }}</span>
                    </div>
                    <div><i class="material-icons icon-muted icon-40pt ml-3">monetization_on</i></div>
                </div>
                <div class="card-body-x-lg card-body" style="padding-top: 0;width:0;">
                    <button class="btn btn-sm btn-dashboard-link" style="display:none" to="customer"></button>
                </div>
            </div>
        </div>
        
    </div>

    <div class="card">
        <div class="card-header bg-white d-flex align-items-center">
            <h3 class="card-header__title mb-0 fs-1-3rem">{{ __('messages.expenses') }}</h3>
        </div>
        <div class="card-body">
            <div class="chart">
                <canvas id="expensesChart" class="chart-canvas chartjs-render-monitor" width="1998" height="600"></canvas>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header card-header-large bg-white">
                    <h4 class="card-header__title">{{ __('messages.due_invoices') }}</h4>
                </div>

                @include('application.dashboard._due_invoices')
                
                <div class="card-footer text-center border-0">
                    <a class="text-muted" href="{{ route('invoices') }}/due">{{ __('messages.view_all') }}</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header card-header-large bg-white">
                    <h4 class="card-header__title">{{ __('messages.due_estimates') }}</h4>
                </div>

                @include('application.dashboard._due_estimates')

                <div class="card-footer text-center border-0">
                    <a class="text-muted" href="{{ route('estimates') }}">{{ __('messages.view_all') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_body_scripts')
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/vendor/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/js/chartjs-rounded-bar.js') }}"></script>
    <script src="{{ asset('assets/js/charts.js') }}"></script>

    <script>
        (function () {
            'use strict';
            Charts.init();

            var Orders = function Orders(id) {
                var type = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 'roundedBar';
                var options = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};
                options = Chart.helpers.merge({
                    barRoundness: 1.2,
                    scales: {
                        yAxes: [{
                            ticks: {
                                callback: function callback(a) {
                                    return a.toLocaleString("en-US", {style:"currency", currency: "{{ $currency_code }}"});
                                }
                            }
                        }]
                    },
                    tooltips: {
                        callbacks: {
                            label: function label(a, e) {
                                var t = e.datasets[a.datasetIndex].label || "",
                                    o = a.yLabel,
                                    r = "",
                                    val = o.toLocaleString("en-US", {style:"currency", currency: "{{ $currency_code }}"});
                                return 1 < e.datasets.length && (r += '<span class="popover-body-label mr-auto">' + t + "</span>"), r += '<span class="popover-body-value">' + val + "</span>";
                            }
                        }
                    }
                }, options);
                var data = {
                    labels: @json($expense_stats_label),
                    datasets: [{
                        label: "Expenses",
                        data: @json($expense_stats)
                    }]
                };
                Charts.create(id, type, options, data);
            };
            Orders('#expensesChart');
        })();
        $('.btn-dashboard-link').on('click',function(){
            location.href = "/"+$(this).attr('to')+"/create";
        })
    </script>
@endsection
