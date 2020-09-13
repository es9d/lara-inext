@extends('layouts.customer_portal', ['page' => 'estimates'])

@section('title', __('messages.estimate_details'))
    
@section('page_header')
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item" aria-current="page">{{ __('messages.portal') }}</li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('messages.estimates') }}</li>
                </ol>
            </nav>
            <h1 class="m-0">{{ __('messages.estimates') }}</h1>
        </div>
    </div>
@endsection
 
@section('content')

    @include('customer_portal.estimates._filters')

    <div class="card">
        @include('customer_portal.estimates._table')
    </div>
@endsection
