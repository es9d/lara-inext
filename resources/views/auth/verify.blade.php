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
   

        <div class="mdk-header-layout__content pt-64px">
            <div class="mdk-drawer-layout js-mdk-drawer-layout">
                <div class="mdk-drawer-layout__content page">
                    <div class="container-fluid page__heading-container">
                        @yield('page_header')
                    </div>

                    <div class="container-fluid page__container">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-header">{{ __('Verify Your Email Address') }}</div>
                        
                                        <div class="card-body">
                                            @if (session('resent'))
                                                <div class="alert alert-success" role="alert">
                                                    {{ __('A fresh verification link has been sent to your email address.') }}
                                                </div>
                                            @endif
                        
                                            {{ __('Before proceeding, please check your email for a verification link.') }}
                                            {{ __('If you did not receive the email') }},
                                            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                                @csrf
                                                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                                            </form>
                                        </div>
                                    </div>
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