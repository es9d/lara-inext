@extends('layouts.customer_portal', ['page' => 'payments'])

@section('title', __('messages.payment_details'))
 
@section('page_header')
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item" aria-current="page">{{ __('messages.portal') }}</li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('messages.payment_details') }}</li>
                </ol>
            </nav>
            <h1 class="m-0">{{ __('messages.payment_details') }}</h1>
        </div>
    </div>
@endsection
 
@section('content') 
    <div class="row">
        <div class="col-12 col-md-4">
            <p class="h2 pb-4">
                #{{ $payment->payment_number }}
            </p>
        </div>
        <div class="col-12 col-md-8 text-right">
            <div class="btn-group mb-2">
                <a href="{{ route('pdf.payment', ['payment' => $payment->uid, 'download' => true]) }}" target="_blank" class="btn btn-light">
                    <i class="material-icons">cloud_download</i> 
                    {{ __('messages.download') }}
                </a>
            </div>
        </div>
    </div>
    <div class="pdf-iframe">
        <iframe src="{{ route('pdf.payment', $payment->uid) }}" frameborder="0"></iframe>
    </div>
@endsection
