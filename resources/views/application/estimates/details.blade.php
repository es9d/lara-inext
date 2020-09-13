@extends('layouts.app', ['page' => 'estimates'])

@section('title', __('messages.estimate_details'))
 
@section('page_header')
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('estimates') }}">{{ __('messages.estimates') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('messages.estimate_details') }}</li>
                </ol>
            </nav>
            <h1 class="m-0">{{ __('messages.estimate_details') }}</h1>
        </div>
    </div>
@endsection
 
@section('content') 
    <div class="row">
        <div class="col-12 col-md-4">
            <p class="h2 pb-4">
                #{{ $estimate->estimate_number }}
            </p>
        </div>
        <div class="col-12 col-md-8 text-right">
            <div class="btn-group mb-2">
                <a href="{{ route('pdf.estimate', ['estimate' => $estimate->uid, 'download' => true]) }}" target="_blank" class="btn btn-light">
                    <i class="material-icons">cloud_download</i> 
                    {{ __('messages.download') }}
                </a>
                <a href="{{ route('estimates.send', $estimate->id) }}" class="btn btn-light alert-confirm" data-alert-title="{{ __('messages.are_you_sure') }}" data-alert-text="{{ __('messages.send_email_warning') }}">
                    <i class="material-icons">send</i>
                    {{ __('messages.send_email') }}
                </a>
                <a href="{{ route('estimates.edit', $estimate->id) }}" class="btn btn-light">
                    <i class="material-icons">edit</i> 
                    {{ __('messages.edit') }}
                </a>
                <div class="btn-group">
                    <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        {{ __('messages.more') }} <span class="caret"></span> 
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="{{ route('estimates.mark', ['estimate' => $estimate->id, 'status' => 'accepted']) }}" class="dropdown-item">{{ __('messages.mark_accepted') }}</a>
                        <a href="{{ route('estimates.mark', ['estimate' => $estimate->id, 'status' => 'rejected']) }}" class="dropdown-item">{{ __('messages.mark_rejected') }}</a>
                        <a href="{{ route('estimates.mark', ['estimate' => $estimate->id, 'status' => 'sent']) }}" class="dropdown-item">{{ __('messages.mark_sent') }}</a>
                        <hr>
                        <a href="{{ route('estimates.delete', $estimate->id) }}" class="dropdown-item text-danger delete-confirm">{{ __('messages.delete') }}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            @if($estimate->status == 'DRAFT')
                <div class="alert alert-soft-dark d-flex align-items-center" role="alert">
                    <i class="material-icons mr-3">access_time</i>
                    <div class="text-body"><strong>{{ __('messages.status') }} : </strong> {{ __('messages.draft') }}</div>
                </div>
            @elseif($estimate->status == 'SENT')
                <div class="alert alert-soft-info d-flex align-items-center" role="alert">
                    <i class="material-icons mr-3">send</i>
                    <div class="text-body"><strong>{{ __('messages.status') }} : </strong> {{ __('messages.mailed_to_customer') }}</div>
                </div>
            @elseif($estimate->status == 'VIEWED')
                <div class="alert alert-soft-primary d-flex align-items-center" role="alert">
                    <i class="material-icons mr-3">visibility</i>
                    <div class="text-body"><strong>{{ __('messages.status') }} : </strong> {{ __('messages.viewed_by_customer') }}</div>
                </div>
            @elseif($estimate->status == 'EXPIRED')
                <div class="alert alert-soft-danger d-flex align-items-center" role="alert">
                    <i class="material-icons mr-3">schedule</i>
                    <div class="text-body"><strong>{{ __('messages.status') }} : </strong> {{ __('messages.expired') }}</div>
                </div>
            @elseif($estimate->status == 'ACCEPTED')
                <div class="alert alert-soft-success d-flex align-items-center" role="alert">
                    <i class="material-icons mr-3">done</i>
                    <div class="text-body"><strong>{{ __('messages.status') }} : </strong> {{ __('messages.accepted') }}</div>
                </div>
            @elseif($estimate->status == 'REJECTED')
                <div class="alert alert-soft-danger d-flex align-items-center" role="alert">
                    <i class="material-icons mr-3">cancel</i>
                    <div class="text-body"><strong>{{ __('messages.status') }} : </strong> {{ __('messages.rejected') }}</div>
                </div>
            @endif
        </div>
    </div> 
    <div class="pdf-iframe">
        <iframe src="{{ route('pdf.estimate', $estimate->uid) }}" frameborder="0"></iframe>
    </div>
@endsection
