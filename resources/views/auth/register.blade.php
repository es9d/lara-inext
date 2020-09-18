@extends('layouts.auth')

@section('title', __('messages.register'))

@section('content')
<h1 class="text-center h6 mb-4">{{ __('messages.register') }}</h1>

<form action="{{ route('register') }}" method="POST" novalidate>
    @csrf
    <div class="form-group">
        <label class="text-label" for="first_name">{{ __('messages.first_name') }}:</label>
        <div class="input-group input-group-merge">
            <input id="first_name" name="first_name" type="text"
                class="form-control  @error('first_name') is-invalid @enderror"
                placeholder="{{ __('messages.first_name') }}" required >
            @error('first_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <label class="text-label" for="last_name">{{ __('messages.last_name') }}:</label>
        <div class="input-group input-group-merge">
            <input id="password" name="last_name" type="text"
                class="form-control @error('last_name') is-invalid @enderror"
                placeholder="{{ __('messages.last_name') }}" required>
           
            @error('last_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <label class="text-label" for="email">{{ __('messages.email') }}:</label>
        <div class="input-group input-group-merge">
            <input id="email" name="email" type="email"
                class="form-control form-control-prepended @error('email') is-invalid @enderror"
                placeholder="user@example.com" autocomplete="email"
                autofocus required>
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <span class="far fa-envelope"></span>
                </div>
            </div>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

    </div>
    <div class="form-group">
        <label class="text-label" for="password">{{ __('messages.password') }}:</label>
        <div class="input-group input-group-merge">
            <input id="password" name="password" type="password"
                class="form-control form-control-prepended @error('password') is-invalid @enderror"
                placeholder="{{ __('messages.enter_your_password') }}" required autocomplete="current-password">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <span class="fa fa-key"></span>
                </div>
            </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <label class="text-label" for="password_confirmation">{{ __('messages.password_confirmation') }}:</label>
        <div class="input-group input-group-merge">
            <input id="password" name="password_confirmation" type="password"
                class="form-control form-control-prepended @error('password_confirmation') is-invalid @enderror"
                placeholder="{{ __('messages.retype_your_password') }}" required >
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <span class="fa fa-key"></span>
                </div>
            </div>
            @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <button class="btn btn-block btn-success" type="submit">{{ __('messages.register') }}</button>
    </div>
    <div class="form-group" style="text-align: center; color: darkgray; border-top: solid 1px gray; padding-top: 5px;">
        {{__('messages.return_to_login')}}
    </div>
    <div class="form-group">
        <button class="btn btn-block btn-success" type="button" onclick="window.location='login'">{{__('messages.login')}}</button>
    </div>
</form>

@endsection