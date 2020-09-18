@extends('layouts.app', ['page' => 'settings'])

@section('title', __('messages.preferences'))
    
@section('content')
    <div class="page__heading">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">business</i></a></li>
                <li class="breadcrumb-item">{{ __('messages.settings') }}</li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('messages.preferences') }}</li>
            </ol>
        </nav>
        <h1 class="m-0">{{ __('messages.preferences') }}</h1>
    </div>

    <div class="row">
        <div class="col-lg-3">
            @include('application.settings._aside', ['tab' => 'preferences'])
        </div>
        <div class="col-lg-9">
            <div class="card card-form">
                <div class="row no-gutters">
                    <div class="col card-form__body card-body bg-white">
                        <form action="{{ route('settings.preferences.update') }}" method="POST">
                            @include('layouts._form_errors')
                            @csrf
                            
                            <div class="row"> 
                                <div class="col-12">
                                    <p class="h5 mb-0">
                                        <strong class="headings-color">{{ __('messages.preferences') }}</strong>
                                    </p>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col"> 
                                    <div class="form-group">
                                        <label for="currency_id">{{ __('messages.currency') }}</label>
                                        <select name="currency_id" data-toggle="select" class="form-control select2-hidden-accessible" data-select2-id="currency_id" required>
                                            <option disabled selected>{{ __('messages.select_currency') }}</option>
                                            @foreach(get_currencies_select2_array() as $option)
                                                <option value="{{ $option['id'] }}" {{ $currentCompany->getSetting('currency_id') == $option['id'] ? 'selected=""' : '' }}>{{ $option['text'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="langugage">{{ __('messages.language') }}</label>
                                        <select id="langugage" name="langugage" data-toggle="select" data-minimum-results-for-search="-1" class="form-control select2-hidden-accessible" data-select2-id="langugage">
                                            <option disabled selected>{{ __('messages.select_language') }}</option>
                                            @foreach(get_languages_select2_array() as $language)
                                                <option value="{{ $language['id'] }}" selected>{{ $language['text'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="timezone">{{ __('messages.timezone') }}</label>
                                        <select id="timezone" name="timezone" data-toggle="select" class="form-control select2-hidden-accessible" data-select2-id="timezone">
                                            <option disabled selected>{{ __('messages.select_timezone') }}</option>
                                            @foreach(get_timezones_select2_array() as $timezone)
                                                <option value="{{ $timezone['id'] }}" {{ $currentCompany->getSetting('timezone') == $timezone['id'] ? 'selected=""' : '' }}>{{ $timezone['text'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="date_format">{{ __('messages.date_format') }}</label>
                                        <select id="date_format" name="date_format" data-toggle="select" data-minimum-results-for-search="-1" class="form-control select2-hidden-accessible" data-select2-id="date_format">
                                            <option disabled selected>{{ __('messages.select_date_format') }}</option>
                                            @foreach(get_date_formats_select2_array() as $date_format)
                                                <option value="{{ $date_format['id'] }}" {{ $currentCompany->getSetting('date_format') == $date_format['id'] ? 'selected=""' : '' }}>{{ $date_format['text'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-12">
                                    <p class="h6 mb-3">
                                        <strong class="headings-color">{{ __('messages.financial_year') }}</strong>
                                    </p>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="financial_month_starts">{{ __('messages.month_starts') }}</label>
                                        <select id="financial_month_starts" name="financial_month_starts" data-minimum-results-for-search="-1" data-toggle="select" class="form-control select2-hidden-accessible" data-select2-id="financial_month_starts">
                                            <option disabled selected>{{ __('messages.select_month_starts') }}</option>
                                            @foreach(get_months_select2_array() as $month)
                                                <option value="{{ $month['id'] }}" {{ $currentCompany->getSetting('financial_month_starts') == $month['id'] ? 'selected=""' : '' }} >{{ $month['text'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="financial_month_ends">{{ __('messages.month_endss') }}</label>
                                        <select id="financial_month_ends" name="financial_month_ends" data-minimum-results-for-search="-1" data-toggle="select" class="form-control select2-hidden-accessible" data-select2-id="financial_month_ends">
                                            <option disabled selected>{{ __('messages.select_month_ends') }}</option>
                                            @foreach(get_months_select2_array() as $month)
                                                <option value="{{ $month['id'] }}" {{ $currentCompany->getSetting('financial_month_ends') == $month['id'] ? 'selected=""' : '' }}>{{ $month['text'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group text-right mt-5">
                                <button type="submit" class="btn btn-success">{{ __('messages.update_settings') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

