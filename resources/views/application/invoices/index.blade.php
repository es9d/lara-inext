@extends('layouts.app', ['page' => 'invoices'])

@section('title', __('messages.invoices'))
    
@section('page_header')
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('messages.invoice') }}</li>
                </ol>
            </nav>
            <h1 class="m-0">{{ __('messages.invoices') }}</h1>
        </div>
        <a href="{{ route('invoices.create') }}" class="btn btn-success ml-3">
            <i class="material-icons">add</i> 
            {{ __('messages.create_invoice') }}
        </a>
    </div>
@endsection

@section('content')
    @include('application.invoices._filters')

    <div class="card">
        <div class="card-header bg-white p-0">
            <div class="row no-gutters flex nav">
                <a href="{{ route('invoices') }}" class="col-2 border-right dashboard-area-tabs__tab card-body text-center {{ $tab == 'drafts' ? 'active' : '' }}">
                    <span class="card-header__title m-0">
                        {{ __('messages.drafts') }}
                    </span>
                </a>
                <a href="{{ route('invoices', 'due') }}" class="col-2 border-right dashboard-area-tabs__tab card-body text-center {{ $tab == 'due' ? 'active' : '' }}">
                    <span class="card-header__title m-0">
                        {{ __('messages.due_invoices') }}
                    </span>
                </a>
                <a href="{{ route('invoices', 'all') }}" class="col-2 border-right dashboard-area-tabs__tab card-body text-center {{ $tab == 'all' ? 'active' : '' }}">
                    <span class="card-header__title m-0">
                        {{ __('messages.all_invoices') }}
                    </span>
                </a>
            </div>
        </div>

        @include('application.invoices._table')
    </div>
@endsection
