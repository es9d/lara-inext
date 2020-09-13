@extends('layouts.app', ['page' => 'settings'])

@section('title', __('messages.account_settings'))
    
@section('content')
@php
    $langs = [
        [
            'name'=>'English',
            'code'=>'en'
        ],[
            'name'=>'Khmer',
            'code'=>'kh'
        ],[
            'name'=>'Indonesian',
            'code'=>'id'
        ],[
            'name'=>'Russian',
            'code'=>'ru'
        ],
];
@endphp
    <div class="page__heading">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">business</i></a></li>
                <li class="breadcrumb-item">{{ __('messages.settings') }}</li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('messages.account_settings') }}</li>
            </ol>
        </nav>
        <h1 class="m-0">{{ __('messages.account_settings') }}</h1>
    </div>

    <div class="row">
        <div class="col-lg-3">
            @include('application.settings._aside', ['tab' => 'account'])
        </div>
        <div class="col-lg-9">
            
            <div class="card card-form">
                <div class="row no-gutters">
                    <div class="col card-form__body card-body bg-white">
                        <form action="{{route('settings.account.update')}}" method="POST" enctype="multipart/form-data">
                            @include('layouts._form_errors')
                            @csrf

                            <div class="form-group">
                                <label>{{ __('messages.profile_image') }}</label><br>
                                <input id="avatar" name="avatar" class="d-none" type="file" onchange="changePreview(this);">
                                <label for="avatar">
                                    <div class="media align-items-center">
                                        <div class="mr-3">
                                            <div class="avatar avatar-xl">
                                                <img id="file-prev" src="{{ $authUser->avatar }}" class="avatar-img rounded">
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
                                        <label for="first_name">{{ __('messages.first_name') }}</label>
                                        <input name="first_name" type="text" class="form-control" placeholder="{{ __('messages.first_name') }}" value="{{ $authUser->first_name }}" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group required">
                                        <label for="last_name">{{ __('messages.last_name') }}</label>
                                        <input name="last_name" type="text" class="form-control" placeholder="{{ __('messages.last_name') }}" value="{{ $authUser->last_name }}" required>
                                    </div>
                                </div>
                            </div>
            
                            <div class="row">
                                <div class="col">
                                    <div class="form-group required">
                                        <label for="email">{{ __('messages.email') }}</label>
                                        <input name="email" type="email" class="form-control" placeholder="{{ __('messages.email') }}" value="{{ $authUser->email }}" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="phone">{{ __('messages.phone') }}</label>
                                        <input name="phone" type="text" class="form-control" placeholder="{{ __('messages.phone') }}" value="{{ $authUser->phone }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="old_password">{{ __('messages.update_locate') }}</label>
                                        <select  class="form-control" name="locale"> 
                                            @foreach ($langs as $lang)
                                                <option value="{{$lang['code']}}" 
                                                    @if (app()->getLocale()==$lang['code'])
                                                        selected        
                                                    @endif
                                                >{{$lang['name']}}</option>                                                
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <p class="mb-1"><strong class="headings-color">{{ __('messages.update_password') }}</strong></p>
                                    <p class="text-muted">{{ __('messages.update_password_description') }}</p>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="old_password">{{ __('messages.old_password') }}</label>
                                        <input name="old_password" type="password" class="form-control" placeholder="{{ __('messages.old_password') }}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="new_password">{{ __('messages.new_password') }}</label>
                                        <input name="new_password" type="password" class="form-control" placeholder="{{ __('messages.new_password') }}">
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
            
        </div>
    </div>
@endsection

