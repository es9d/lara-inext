@extends('layouts.app', ['page' => 'settings'])

@section('title', __('messages.payment_settings'))
    
@section('content')
    <div class="page__heading">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">business</i></a></li>
                <li class="breadcrumb-item">{{ __('messages.settings') }}</li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('messages.payment_settings') }}</li>
            </ol>
        </nav>
        <h1 class="m-0">{{ __('messages.payment_settings') }}</h1>
    </div>

    <div class="row">
        <div class="col-lg-3">
            @include('application.settings._aside', ['tab' => 'payment'])
        </div>
        <div class="col-lg-9">
            
            <div class="card card-form">
                <div class="row no-gutters">
                    <div class="col card-form__body card-body bg-white">
                        <form action="{{ route('settings.payment.update') }}" method="POST">
                            @include('layouts._form_errors')
                            @csrf

                            <div class="form-group mb-4">
                                <p class="h5 mb-0">
                                    <strong class="headings-color">{{ __('messages.payment_settings') }}</strong>
                                </p>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-5">
                                    <div class="form-group required">
                                        <label for="payment_prefix">{{ __('messages.payment_prefix') }}</label>
                                        <input name="payment_prefix" type="text" class="form-control" value="{{ $currentCompany->getSetting('payment_prefix') }}" placeholder="{{ __('messages.payment_prefix') }}">
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="payment_auto_archive">{{ __('messages.auto_archive') }}</label><br>
                                        <div class="custom-control custom-checkbox-toggle custom-control-inline mr-1">
                                            <input type="checkbox" name="payment_auto_archive" id="payment_auto_archive" {{ $currentCompany->getSetting('payment_auto_archive') ? 'checked' : '' }} class="custom-control-input">
                                            <label class="custom-control-label" for="payment_auto_archive">{{ __('messages.yes') }}</label>
                                        </div>
                                        <label for="payment_auto_archive" class="mb-0">{{ __('messages.yes') }}</label>
                                        <small class="form-text text-muted">
                                            {{ __('messages.auto_archive_description') }}
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-5">
                                    <div class="form-group required">
                                        <label for="payment_color">{{ __('messages.payment_color') }}</label>
                                        <input name="payment_color" type="color" class="form-control" value="{{ $currentCompany->getSetting('payment_color') }}" placeholder="{{ __('messages.payment_color') }}">
                                    </div>
                                </div>
                            </div> 

                            <div class="form-group">
                                <label for="payment_footer">{{ __('messages.footer') }}</label>
                                <textarea name="payment_footer" class="form-control" rows="4" placeholder="{{ __('messages.footer') }}">{{ $currentCompany->getSetting('payment_footer') }}</textarea>
                            </div>
            
                            <div class="form-group text-right mt-4">
                                <button type="submit" class="btn btn-success">{{ __('messages.update_settings') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card card-form">
                <div class="row no-gutters">
                    <div class="col card-form__body card-body bg-white">

                        <div class="form-group mb-4">
                            <p class="h5 mb-0">
                                <strong class="headings-color">{{ __('messages.online_payment_gateways') }}</strong>
                            </p>
                        </div>

                        @include('application.settings.payment.gateways._table')

                    </div>
                </div>
            </div>

            <div class="card card-form">
                <div class="row no-gutters">
                    <div class="col card-form__body card-body bg-white">

                        <div class="form-row align-items-center mb-4">
                            <div class="col">
                                <p class="h5 mb-0">
                                    <strong class="headings-color">{{ __('messages.payment_types') }}</strong>
                                </p>
                            </div>
                            <div class="col-auto">
                                <a href="{{ route('settings.payment.type.create') }}" class="btn btn-light">
                                    <i class="material-icons icon-16pt">add</i>
                                    {{ __('messages.add_payment_type') }}
                                </a>
                            </div>
                        </div>

                        @include('application.settings.payment.types._table')

                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection

