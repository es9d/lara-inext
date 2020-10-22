<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - InvoiceNext</title>

    @include('layouts._css')
</head>

<body>
    <div class="row" style="margin: 0px">
        <div class="col-lg-6  col-md-12 mt-5" >
            <div style="width: 350px;margin:auto;">
                <div class="d-flex flex-column justify-content-center align-items-center mt-2 mb-2 navbar-light">
                    <a href="{{ url('/login') }}" class="navbar-brand flex-column mb-2 align-items-center mr-0">
                        <img class="navbar-brand-icon mr-0 mb-2" src="{{asset('assets/images/favicon.png')}}" width="25" alt="{{ config('app.name') }}">
                        <img class="navbar-brand-icon mr-0 mb-2" src="{{asset('assets/images/logo-invoice-next.svg')}}" style="width: 50%;">
                    </a>
                </div>
                @yield('content')
            </div>
        </div>
        <div class="col-lg-6 auth-right" style="padding: 0px;position: fixed;">
            <div style="margin-top:30vh;height:70vh;background-image:url('{{asset('assets/images/auth/blue.svg')}}');background-size:cover;">
                <div class="p-5 row" style="padding-top:10vh!important;">
                    <div class="col-lg-6" style="display: grid">
                        <img src="{{asset('assets/images/favicon.png')}}" width="70" alt="{{ config('app.name') }}">
                        {{-- <img src="{{asset('assets/images/logo-invoice-next.svg')}}" style="width: 50%;"> --}}
                        <p style="color: white">Manage your real estate CRM on the go, away from the office with the iOS app from MyDesktop.</p>
                        <img src="{{asset('assets/images/auth/app.svg')}}" alt="{{ config('app.name') }}">

                    </div>
                    <div class="col-lg-6">
                        <img src="{{asset('assets/images/auth/mobile.png')}}" class="auth-mobile-img">
                    </div>
                </div>
            </div>
        </div>
    </div>
<style>
.auth-right{
    background-image: url(/assets/images/auth/1.jpg);
    background-size: cover;
    
    right: 0;
    top: 0;
    bottom: 0;
}
.auth-mobile-img{
    position: fixed;
    bottom: 0px;
    right:0px;
    height: 80vh;
}
@media only screen and (max-width: 992px) {
    .auth-right{
        display: none;
    }
    .auth-mobile-img{
        display: none;
    }
}
</style>
    @include('layouts._js')
    @include('layouts._flash')
</body>
</html>
