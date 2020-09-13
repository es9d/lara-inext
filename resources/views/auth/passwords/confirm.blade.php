@extends('layouts.auth')

@section('title', __('messages.login'))

@section('content')

<h1 class="text-center h4 mb-4">{{ __('messages.confirm_password') }}</h1>

<p>
    {{ __('messages.please_confirm_password') }}
</p>

<form action="{{ route('password.confirm') }}" method="POST" novalidate>
    @csrf
    <div class="form-group">
        <label class="text-label" for="password">{{ __('messages.password') }}:</label>
        <div class="input-group input-group-merge">
            <input id="password" name="password" type="password"
                class="form-control form-control-prepended @error('password') is-invalid @enderror"
                placeholder="{{ __('messages.enter_your_password') }}" value="{{ old('password') }}"
                autocomplete="password" autofocus required>
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <span class="far fa-envelope"></span>
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
        <button class="btn btn-block btn-primary"
            type="submit">{{ __('messages.confirm_password') }}</button>
    </div>

    @if(Route::has('password.request'))
        <div class="form-group">
            <a href="{{ route('password.request') }}"
                class="btn btn-block btn-primary">{{ __('messages.forgot_your_password') }}</a>
        </div>
    @endif

</form>
@endsection