@extends('layouts.auth')

@section('title', __('messages.reset_password'))

@section('content')
   
    <h1 class="text-center h4 mb-4">{{ __('messages.reset_password') }}</h1>

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{ route('password.email') }}" method="POST" novalidate>
        @csrf
        <div class="form-group">
            <label class="text-label" for="email">{{ __('messages.email') }}:</label>
            <div class="input-group input-group-merge">
                <input id="email" name="email" type="email" class="form-control form-control-prepended @error('email') is-invalid @enderror" placeholder="user@example.com" value="{{ old('email') }}" autocomplete="email" autofocus required>
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
            <button class="btn btn-block btn-primary" type="submit">{{ __('messages.send_reset_link') }}</button>
        </div>

        <div class="form-group">
            <a href="{{ route('login') }}" class="btn btn-block btn-light">{{ __('messages.return_to_login') }}</a>
        </div>
    </form>
@endsection
