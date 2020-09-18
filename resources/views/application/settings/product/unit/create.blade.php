@extends('layouts.app', ['page' => 'settings'])

@section('title', __('messages.create_product_unit'))
    
@section('content')
    <div class="page__heading">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">business</i></a></li>
                <li class="breadcrumb-item">{{ __('messages.settings') }}</li>
                <li class="breadcrumb-item"><a href="{{ route('settings.product') }}">{{ __('messages.product_settings') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('messages.create_product_unit') }}</li>
            </ol>
        </nav>
        <h1 class="m-0">{{ __('messages.create_product_unit') }}</h1>
    </div>
 
    <div class="row">
        <div class="col-lg-3">
            @include('application.settings._aside', ['tab' => 'product'])
        </div>
        <div class="col-lg-9">
            <div class="card card-form">
                <div class="row no-gutters">
                    <div class="col card-form__body card-body bg-white">
                        <div class="form-row align-items-center mb-4">
                            <div class="col">
                                <p class="h4 mb-0">
                                    <strong class="headings-color">{{ __('messages.create_product_unit') }}</strong>
                                </p>
                            </div>
                        </div>

                        <form action="{{ route('settings.product.unit.store') }}" method="POST">
                            @include('layouts._form_errors')
                            @csrf
                            
                            @include('application.settings.product.unit._form')

                            <div class="form-group text-right mt-4">
                                <button type="submit" class="btn btn-success">{{ __('messages.create_product_unit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

