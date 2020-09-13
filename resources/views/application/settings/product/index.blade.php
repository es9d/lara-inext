@extends('layouts.app', ['page' => 'settings'])

@section('title', __('messages.product_settings'))
    
@section('content')
    <div class="page__heading">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">business</i></a></li>
                <li class="breadcrumb-item">{{ __('messages.settings') }}</li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('messages.product_settings') }}</li>
            </ol>
        </nav>
        <h1 class="m-0">{{ __('messages.product_settings') }}</h1>
    </div>

    <div class="row">
        <div class="col-lg-3">
            @include('application.settings._aside', ['tab' => 'product'])
        </div>
        <div class="col-lg-9">
            
            <div class="card card-form">
                <div class="row no-gutters">
                    <div class="col card-form__body card-body bg-white">
                        <form action="{{ route('settings.product.update') }}" method="POST">
                            @include('layouts._form_errors')
                            @csrf

                            <div class="form-group mb-4">
                                <p class="h5 mb-0">
                                    <strong class="headings-color">{{ __('messages.product_settings') }}</strong>
                                </p>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="discount_per_item">{{ __('messages.discount_per_item') }}</label><br>
                                        <div class="custom-control custom-checkbox-toggle custom-control-inline mr-1">
                                            <input type="checkbox" name="discount_per_item" id="discount_per_item" {{ $currentCompany->getSetting('discount_per_item') ? 'checked' : '' }} class="custom-control-input">
                                            <label class="custom-control-label" for="discount_per_item">{{ __('messages.yes') }}</label>
                                        </div>
                                        <label for="discount_per_item" class="mb-0">{{ __('messages.yes') }}</label>
                                        <small class="form-text text-muted">
                                            {{ __('messages.discount_per_item_description') }}
                                        </small>
                                    </div> 
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="tax_per_item">{{ __('messages.tax_per_item') }}</label><br>
                                        <div class="custom-control custom-checkbox-toggle custom-control-inline mr-1">
                                            <input type="checkbox" name="tax_per_item" id="tax_per_item" {{ $currentCompany->getSetting('tax_per_item') ? 'checked' : '' }} class="custom-control-input">
                                            <label class="custom-control-label" for="tax_per_item">{{ __('messages.yes') }}</label>
                                        </div>
                                        <label for="tax_per_item" class="mb-0">{{ __('messages.yes') }}</label>
                                        <small class="form-text text-muted">
                                            {{ __('messages.tax_per_item_description') }}
                                        </small>
                                    </div>
                                </div>
                            </div>
            
                            <div class="form-group text-right mt-4">
                                <button type="submit" class="btn btn-primary">{{ __('messages.update_settings') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="card card-form">
                <div class="row no-gutters">
                    <div class="col card-form__body card-body bg-white">

                        <div class="form-row align-items-center mb-4">
                            <div class="col">
                                <p class="h5 mb-0">
                                    <strong class="headings-color">{{ __('messages.product_units') }}</strong>
                                </p>
                            </div>
                            <div class="col-auto">
                                <a href="{{ route('settings.product.unit.create') }}" class="btn btn-light">
                                    <i class="material-icons icon-16pt">add</i>
                                    {{ __('messages.add_product_unit') }}
                                </a>
                            </div>
                        </div>

                        @include('application.settings.product.unit._table')

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

