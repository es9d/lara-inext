@extends('layouts.app', ['page' => 'payments'])

@section('title', __('messages.payments'))
    
@section('page_header')
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('messages.payments') }}</li>
                </ol>
            </nav>
            <h1 class="m-0">{{ __('messages.payments') }}</h1>
        </div>
        <a href="{{ route('payments.create') }}" class="btn btn-success ml-3">
            <i class="material-icons">add</i> 
            {{ __('messages.create_payment') }}
        </a>
    </div>
@endsection

@section('content')
    @include('application.payments._filters')

    <div class="card">
        @include('application.payments._table')
    </div>
@endsection
