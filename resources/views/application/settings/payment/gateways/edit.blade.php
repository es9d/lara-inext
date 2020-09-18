@extends('layouts.app', ['page' => 'settings'])

@section('title', __('messages.edit_payment_settings', ['payment_gateway' => ucfirst($gateway)]))
    
@section('content')
    <div class="page__heading">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">business</i></a></li>
                <li class="breadcrumb-item">{{ __('messages.settings') }}</li>
                <li class="breadcrumb-item"><a href="{{ route('settings.payment') }}">{{ __('messages.payment_settings') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('messages.edit_payment_settings', ['payment_gateway' => ucfirst($gateway)]) }}</li>
            </ol>
        </nav>
        <h1 class="m-0">{{ __('messages.edit_payment_settings', ['payment_gateway' => ucfirst($gateway)]) }}</h1>
    </div>
 
    <div class="row">
        <div class="col-lg-3">
            @include('application.settings._aside', ['tab' => 'payment'])
        </div>
        <div class="col-lg-9">
            <div class="card card-form">
                <div class="row no-gutters">
                    <div class="col card-form__body card-body bg-white">
                        <form action="{{ route('settings.payment.gateway.update', $gateway) }}" method="POST">
                            @include('layouts._form_errors')
                            @csrf
                             
                            @include('application.settings.payment.gateways.forms.'.$gateway)

                            <div class="form-group text-right mt-4">
                                <button type="submit" class="btn btn-success">{{ __('messages.update_gateway') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

