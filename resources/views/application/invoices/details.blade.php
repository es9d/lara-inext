@extends('layouts.app', ['page' => 'invoices'])

@section('title', __('messages.invoice_details'))
 
@section('page_header')
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('invoices') }}">{{ __('messages.invoices') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('messages.invoice_details') }}</li>
                </ol>
            </nav>
            <h1 class="m-0">{{ __('messages.invoice_details') }}</h1>
        </div>
    </div>
@endsection
 
@section('content') 
    <div class="row">
        <div class="col-12 col-md-4">
            <p class="h2 pb-4">
                #{{ $invoice->invoice_number }}
            </p>
        </div>
        <div class="col-12 col-md-8 text-right">
            <div class="btn-group mb-2">
                <a href="{{ route('pdf.invoice', ['invoice' => $invoice->uid, 'download' => true]) }}" target="_blank" class="btn btn-light">
                    <i class="material-icons">cloud_download</i> 
                    {{ __('messages.download') }}
                </a>
                <a href="{{ route('invoices.send', $invoice->id) }}" class="btn btn-light alert-confirm" data-alert-title="Are you sure?" data-alert-text="This action will send an email to customer.">
                    <i class="material-icons">send</i>
                    {{ __('messages.send_email') }}
                </a>
                <a href="{{ route('payments.create', ['invoice' => $invoice->id]) }}" target="_blank" class="btn btn-light">
                    <i class="material-icons">payment</i> 
                    {{ __('messages.enter_payment') }}
                </a>
                <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-light">
                    <i class="material-icons">edit</i> 
                    {{ __('messages.edit') }}
                </a>
                <div class="btn-group">
                    <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        {{ __('messages.more') }} <span class="caret"></span> 
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="{{ route('invoices.mark', ['invoice' => $invoice->id, 'status' => 'paid']) }}" class="dropdown-item">{{ __('messages.mark_paid') }}</a>
                        <a href="{{ route('invoices.mark', ['invoice' => $invoice->id, 'status' => 'sent']) }}" class="dropdown-item">{{ __('messages.mark_sent') }}</a>
                        <hr>
                        <a href="{{ route('invoices.delete', $invoice->id) }}" class="dropdown-item text-danger delete-confirm">{{ __('messages.delete') }}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            @if($invoice->status == 'DRAFT')
                <div class="alert alert-soft-dark d-flex align-items-center" role="alert">
                    <i class="material-icons mr-3">access_time</i>
                    <div class="text-body" style="width: 100%;">
                        <strong>{{ __('messages.status') }} : </strong> 
                        {{ __('messages.draft') }}
                        <span style="float:right;">{{$invoice->formatted_created_at}}</span>
                    </div>
                </div>
            @elseif($invoice->status == 'SENT')
                <div class="alert alert-soft-info d-flex align-items-center" role="alert">
                    <i class="material-icons mr-3">send</i>
                    <div class="text-body" style="width: 100%;">
                        <strong>{{ __('messages.status') }} : </strong> 
                        {{ __('messages.mailed_to_customer') }}
                        <span style="float:right;">{{$invoice->formatted_created_at}}</span>
                    </div>
                </div>
            @elseif($invoice->status == 'VIEWED')
                <div class="alert alert-soft-primary d-flex align-items-center" role="alert">
                    <i class="material-icons mr-3">visibility</i>
                    <div class="text-body" style="width: 100%;">
                        <strong>{{ __('messages.status') }} : </strong> 
                        {{ __('messages.viewed_by_customer') }}
                        <span style="float:right;">{{$invoice->formatted_created_at}}</span>
                    </div>
                </div>
            @elseif($invoice->status == 'OVERDUE')
                <div class="alert alert-soft-danger d-flex align-items-center" role="alert">
                    <i class="material-icons mr-3">schedule</i>
                    <div class="text-body" style="width: 100%;">
                        <strong>{{ __('messages.status') }} : </strong> 
                        {{ __('messages.overdue') }}
                        <span style="float:right;">{{$invoice->formatted_created_at}}</span>
                    </div>
                </div>
            @elseif($invoice->status == 'COMPLETED')
                <div class="alert alert-soft-success d-flex align-items-center" role="alert">
                    <i class="material-icons mr-3">done</i>
                    <div class="text-body" style="width: 100%;">
                        <strong>{{ __('messages.status') }} : </strong> 
                        {{ __('messages.payment_received') }}
                        <span style="float:right;">{{$invoice->formatted_created_at}}</span>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="pdf-iframe">
        <iframe src="{{ route('pdf.invoice', $invoice->uid) }}" frameborder="0"></iframe>
    </div>
@endsection
