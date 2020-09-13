@extends('layouts.app', ['page' => 'settings'])

@section('title', __('messages.company_settings'))
    
@section('content')
    <div class="page__heading">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">business</i></a></li>
                <li class="breadcrumb-item">{{ __('messages.settings') }}</li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('messages.company_settings') }}</li>
            </ol>
        </nav>
        <h1 class="m-0">{{ __('messages.company_settings') }}</h1>
    </div>

    <div class="row">
        <div class="col-lg-3">
            @include('application.settings._aside', ['tab' => 'company'])
        </div>
        <div class="col-lg-9">
            
            <div class="card card-form">
                <div class="row no-gutters">
                    <div class="col card-form__body card-body bg-white">
                        <form action="{{route('settings.company.update')}}" method="POST" enctype="multipart/form-data">
                            @include('layouts._form_errors')
                            @csrf
        
                            <div class="form-group">
                                <label>{{ __('messages.company_logo') }}</label><br>
                                <input id="avatar" name="avatar" class="d-none" type="file" onchange="changePreview(this);">
                                <label for="avatar">
                                    <div class="media align-items-center">
                                        <div class="mr-3">
                                            <div class="avatar avatar-xl">
                                                <img id="file-prev" src="{{ $currentCompany->avatar }}" class="avatar-img rounded">
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <a class="btn btn-sm btn-light choose-button">{{ __('messages.choose_photo') }}</a>
                                        </div>
                                    </div>
                                </label>
                            </div>
            
                            <div class="row">
                                <div class="col">
                                    <div class="form-group required">
                                        <label for="name">{{ __('messages.company_name') }}</label>
                                        <input name="name" type="text" class="form-control" placeholder="{{ __('messages.company_name') }}" value="{{ $currentCompany->name }}" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="billing[phone]">{{ __('messages.phone') }}</label>
                                        <input name="billing[phone]" type="text" class="form-control" value="{{ $currentCompany->billing->phone }}" placeholder="{{ __('messages.phone') }}">
                                    </div>
                                </div>
                            </div>
            
                            <div class="row">
                                <div class="col">
                                    <div class="form-group required">
                                        <label for="billing[country_id]">{{ __('messages.country') }}</label>
                                        <select id="billing[country_id]" name="billing[country_id]" data-toggle="select" class="form-control select2-hidden-accessible" data-select2-id="billing[country_id]" required>
                                            <option disabled selected>{{ __('messages.select_country') }}</option>
                                            @foreach(get_countries_select2_array() as $option)
                                                <option value="{{ $option['id'] }}" {{ $currentCompany->billing->country_id == $option['id'] ? 'selected=""' : '' }}>{{ $option['text'] }}</option>
                                            @endforeach
                                        </select> 
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="billing[state]">{{ __('messages.state') }}</label>
                                        <input name="billing[state]" type="text" class="form-control" value="{{ $currentCompany->billing->state }}" placeholder="{{ __('messages.state') }}">
                                    </div>
                                </div>
                            </div>
            
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="billing[city]">{{ __('messages.city') }}</label>
                                        <input name="billing[city]" type="text" class="form-control" value="{{ $currentCompany->billing->city }}" placeholder="{{ __('messages.city') }}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="billing[zip]">{{ __('messages.postal_code') }}</label>
                                        <input name="billing[zip]" type="text" class="form-control" value="{{ $currentCompany->billing->zip }}" placeholder="{{ __('messages.postal_code') }}">
                                    </div>
                                </div>
                            </div>
            
                            <div class="form-group required">
                                <label for="billing[address_1]">{{ __('messages.address') }}</label>
                                <textarea name="billing[address_1]" class="form-control" rows="2" placeholder="{{ __('messages.address') }}" required>{{ $currentCompany->billing->address_1 }}</textarea>
                            </div>
            
                            <div class="form-group text-right mt-4">
                                <button type="submit" class="btn btn-primary">{{ __('messages.update_company') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection

