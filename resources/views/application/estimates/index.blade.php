@extends('layouts.app', ['page' => 'estimates'])

@section('title', __('messages.estimates'))
    
@section('page_header')
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('messages.estimates') }}</li>
                </ol>
            </nav>
            <h1 class="m-0">{{ __('messages.estimates') }}</h1>
        </div>
        <a href="{{ route('estimates.create') }}" class="btn btn-success ml-3">
            <i class="material-icons">add</i> 
            {{ __('messages.create_estimate') }}
        </a>
    </div>
@endsection

@section('content')
    @include('application.estimates._filters')

    <div class="card">
        <div class="card-header bg-white p-0">
            <div class="row no-gutters flex nav">
                <a href="{{ route('estimates') }}" class="col-2 border-right dashboard-area-tabs__tab card-body text-center {{ $tab == 'drafts' ? 'active' : '' }}">
                    <span class="card-header__title m-0">
                        {{ __('messages.drafts') }}
                    </span>
                </a>
                <a href="{{ route('estimates', 'sent') }}" class="col-2 border-right dashboard-area-tabs__tab card-body text-center {{ $tab == 'sent' ? 'active' : '' }}">
                    <span class="card-header__title m-0">
                        {{ __('messages.sent') }}
                    </span>
                </a>
                <a href="{{ route('estimates', 'all') }}" class="col-2 border-right dashboard-area-tabs__tab card-body text-center {{ $tab == 'all' ? 'active' : '' }}">
                    <span class="card-header__title m-0">
                        {{ __('messages.all') }}
                    </span>
                </a>
            </div>
        </div>

        @include('application.estimates._table')
    </div>
@endsection
