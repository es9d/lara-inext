@php
    $authUser = Auth::User();
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    @include('layouts._css')
</head>

<body class="layout-default has-drawer-opened">
    <div class="mdk-header-layout js-mdk-header-layout">
        @include('layouts._header')

        <div class="mdk-header-layout__content pt-64px">
            <div class="mdk-drawer-layout js-mdk-drawer-layout">
                <div class="mdk-drawer-layout__content page">
                    <div class="container-fluid page__container">
                        <div class="row justify-content-center">
                            <div class="d-flex flex-column justify-content-center align-items-center mt-2 mb-2 navbar-light">
                                <a href="{{ url('/login') }}" class="navbar-brand flex-column mb-2 align-items-center mr-0">
                                    <img class="navbar-brand-icon mr-0 mb-2" src="{{asset('assets/images/favicon.png')}}" width="150" alt="{{ config('app.name') }}">
                                </a>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="d-flex flex-column justify-content-center align-items-center mt-2 mb-2 navbar-light">
                                <h1 class="text-center h6 mb-4">{{ __('Verify Your Email Address') }}</h1>
                                <div class="card-body">
                                    @if (session('resent'))
                                        <div class="alert alert-success" role="alert">
                                            {{ __('A fresh verification link has been sent to your email address.') }}
                                        </div>
                                    @endif
            
                                    <h5>
                                        {{ __('Before proceeding, please check your email for a verification link.') }}
                                    </h5>
                                    <form method="POST" action="{{ route('verification.resend') }}">
                                        @csrf
                                        <button type="submit" class="btn btn-success form-control">{{ __('click here to request another') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
   
    @include('layouts._js')
    @include('layouts._flash')
</body>

</html>
