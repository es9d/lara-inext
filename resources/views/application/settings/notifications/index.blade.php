@extends('layouts.app', ['page' => 'settings'])

@section('title', __('messages.notification_settings'))
    
@section('content')
    <div class="page__heading">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">business</i></a></li>
                <li class="breadcrumb-item">{{ __('messages.settings') }}</li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('messages.notification_settings') }}</li>
            </ol>
        </nav>
        <h1 class="m-0">{{ __('messages.notification_settings') }}</h1>
    </div>

    <div class="row">
        <div class="col-lg-3">
            @include('application.settings._aside', ['tab' => 'notification'])
        </div>
        <div class="col-lg-9">

            <div class="card card-form">
                <div class="row no-gutters">
                    <div class="col card-form__body card-body bg-white">
                        <form action="{{ route('settings.notifications.update') }}" method="POST">
                            @include('layouts._form_errors')
                            @csrf

                            <div class="form-group mb-4">
                                <p class="h5 mb-0">
                                    <strong class="headings-color">{{ __('messages.notifications') }}</strong>
                                </p>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox-toggle custom-control-inline mr-1">
                                    <input type="checkbox" name="notification_invoice_sent" id="notification_invoice_sent" {{ $authUser->getSetting('notification_invoice_sent') ? 'checked' : '' }} class="custom-control-input">
                                    <label class="custom-control-label" for="notification_invoice_sent">{{ __('messages.yes') }}</label>
                                </div>
                                <label for="notification_invoice_sent" class="mb-0">{{ __('messages.email_when_invoice_sent') }}</label>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox-toggle custom-control-inline mr-1">
                                    <input type="checkbox" name="notification_invoice_viewed" id="notification_invoice_viewed" {{ $authUser->getSetting('notification_invoice_viewed') ? 'checked' : '' }} class="custom-control-input">
                                    <label class="custom-control-label" for="notification_invoice_viewed">{{ __('messages.yes') }}</label>
                                </div>
                                <label for="notification_invoice_viewed" class="mb-0">{{ __('messages.email_when_invoice_viewed') }}</label>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox-toggle custom-control-inline mr-1">
                                    <input type="checkbox" name="notification_invoice_paid" id="notification_invoice_paid" {{ $authUser->getSetting('notification_invoice_paid') ? 'checked' : '' }} class="custom-control-input">
                                    <label class="custom-control-label" for="notification_invoice_paid">{{ __('messages.yes') }}</label>
                                </div>
                                <label for="notification_invoice_paid" class="mb-0">{{ __('messages.email_when_invoice_paid') }}</label>
                            </div>


                            <div class="form-group">
                                <div class="custom-control custom-checkbox-toggle custom-control-inline mr-1">
                                    <input type="checkbox" name="notification_estimate_sent" id="notification_estimate_sent" {{ $authUser->getSetting('notification_estimate_sent') ? 'checked' : '' }} class="custom-control-input">
                                    <label class="custom-control-label" for="notification_estimate_sent">{{ __('messages.yes') }}</label>
                                </div>
                                <label for="notification_estimate_sent" class="mb-0">{{ __('messages.email_when_estimate_sent') }}</label>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox-toggle custom-control-inline mr-1">
                                    <input type="checkbox" name="notification_estimate_viewed" id="notification_estimate_viewed" {{ $authUser->getSetting('notification_estimate_viewed') ? 'checked' : '' }} class="custom-control-input">
                                    <label class="custom-control-label" for="notification_estimate_viewed">{{ __('messages.yes') }}</label>
                                </div>
                                <label for="notification_estimate_viewed" class="mb-0">{{ __('messages.email_when_estimate_viewed') }}</label>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox-toggle custom-control-inline mr-1">
                                    <input type="checkbox" name="notification_estimate_approved_or_rejected" id="notification_estimate_approved_or_rejected" {{ $authUser->getSetting('notification_estimate_approved_or_rejected') ? 'checked' : '' }} class="custom-control-input">
                                    <label class="custom-control-label" for="notification_estimate_approved_or_rejected">{{ __('messages.yes') }}</label>
                                </div>
                                <label for="notification_estimate_approved_or_rejected" class="mb-0">{{ __('messages.email_when_estimate_accepted_or_rejected') }}</label>
                            </div>
            
                            <div class="form-group text-right mt-4">
                                <button type="submit" class="btn btn-primary">{{ __('messages.update_settings') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection

