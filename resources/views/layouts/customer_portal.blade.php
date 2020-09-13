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

<body class="layout-fixed">
    <div class="mdk-header-layout js-mdk-header-layout">
        @include('layouts._customer_portal_header')

        <div class="mdk-header-layout__content page pt-64px">
            <div class="container page__heading-container">
                @yield('page_header')
            </div>

            <div class="container page__container">
                @yield('content')
            </div>
        </div>
    </div>
   
    @include('layouts._js')
    @include('layouts._flash')
</body>

</html>
