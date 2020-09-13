@extends('layouts.app', ['page' => 'customers'])

@section('title', __('messages.customers'))
    
@section('page_header')
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('messages.customers') }}</li>
                </ol>
            </nav>
            <h1 class="m-0">{{ __('messages.customers') }}</h1>
        </div>
        <a href="{{ route('customers.create') }}" class="btn btn-success ml-3"><i class="material-icons">add</i> {{ __('messages.create_customer') }}</a>
    </div>
@endsection

@section('content')
    @include('application.customers._filters')

    <div class="card">
        @include('application.customers._table')
    </div>
@endsection
