@extends('layouts.auth')

@section('title', __('messages.reset_your_password'))

@section('content')
<h1 class="text-center h4 mb-4">{{ __('messages.reset_your_password') }}</h1>

<form action="{{ route('password.update') }}" method="POST" novalidate>
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">

    <div class="form-group">
        <label class="text-label" for="email">{{ __('messages.email') }}:</label>
        <div class="input-group input-group-merge">
            <input id="email" name="email" type="email"
                class="form-control form-control-prepended @error('email') is-invalid @enderror"
                placeholder="user@example.com" value="{{ old('email') }}" autocomplete="email"
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
        <label class="text-label" for="password">{{ __('messages.new_password') }}:</label>
        <div class="input-group input-group-merge">
            <input id="password" name="password" type="password"
                class="form-control form-control-prepended @error('password') is-invalid @enderror"
                placeholder="{{ __('messages.enter_your_password') }}"
                value="" autocomplete="password" required>
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <span class="far fa-key"></span>
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
        <label class="text-label" for="password_confirmation">{{ __('messages.retype_your_password') }}:</label>
        <div class="input-group input-group-merge">
            <input id="password_confirmation" name="password_confirmation" type="password"
                class="form-control form-control-prepended @error('password_confirmation') is-invalid @enderror"
                placeholder="{{ __('messages.retype_your_password') }}" value=""
                autocomplete="password_confirmation" required>
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <span class="far fa-key"></span>
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
        <button class="btn btn-block btn-light" type="submit">{{ __('messages.reset_password') }}</button>
    </div>
</form>
@endsection