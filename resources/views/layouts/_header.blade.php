@php
    $langs = [
        [
            'name'=>'English',
            'country_code'=>'us',
            'language_code'=>'en'
        ],[
            'name'=>'Korean',
            'country_code'=>'kr',
            'language_code'=>'ko'
        ],[
            'name'=>'French',
            'country_code'=>'fr',
            'language_code'=>'fr'
        ],[
            'name'=>'Khmer',
            'country_code'=>'kh',
            'language_code'=>'kh'
        ],[
            'name'=>'Vietnamese',
            'country_code'=>'vn',
            'language_code'=>'vn'
        ],[
            'name'=>'Indonesian',
            'country_code'=>'id',
            'language_code'=>'id'
        ],[
            'name'=>'Russian',
            'country_code'=>'ru',
            'language_code'=>'ru'
        ],[
            'name'=>'Nepali',
            'country_code'=>'np',
            'language_code'=>'ne'
        ],[
            'name'=>'Polish',
            'country_code'=>'pl',
            'language_code'=>'pl'
        ]
];
@endphp
<div id="header" class="mdk-header js-mdk-header m-0">
    <div class="mdk-header__bg">
        <div class="mdk-header__bg-front"></div>
        <div class="mdk-header__bg-rear"></div>
    </div>
    <div class="mdk-header__content">
        <div class="navbar navbar-expand-sm navbar-main navbar-light bg-white pr-0 mdk-header--fixed" id="navbar"
            data-primary="data-primary">
            <div class="container-fluid p-0">
                <button class="navbar-toggler navbar-toggler-right d-block d-md-none" type="button"
                    data-toggle="sidebar">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <a href="{{ route('dashboard') }}" class="navbar-brand">
                    <img class="navbar-brand-icon" src="{{ asset('assets/images/logo-invoice-next.svg') }}" width="50%">
                    {{-- <span>{{ config('app.name') }}</span> --}}
                </a>

                <ul class="nav navbar-nav ml-auto d-none d-md-flex">
                    {{-- <li class="nav-item">
                        <a href="https://docs-foxtrot.varuscreative.com/" target="_blank" class="nav-link">
                            <i class="material-icons">help_outline</i> {{ __('messages.get_help') }}
                        </a>
                    </li> --}}
                    <li class="nav-item dropdown">
                    @foreach ($langs as $lang)
                        @if ($lang['language_code'] ===app()->getlocale())
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="flag-icon flag-icon-{{$lang['country_code']}}" style="font-size: 20px"></span> {{$lang['name']}}
                            </a>
                        @endif
                    @endforeach
                        <div class="dropdown-menu" aria-labelledby="dropdown09" style="overflow: auto">
                        @foreach ($langs as $lang)
                            <a class="dropdown-item" href="/lang/{{ $lang['language_code'] }}"><span class="flag-icon mr-2 flag-icon-{{ $lang['country_code'] }}"> </span>{{$lang['name']}}</a>                                
                        @endforeach
                        </div>
                    </li>
                </ul>

                <ul class="nav navbar-nav d-none d-sm-flex border-left navbar-height align-items-center">
                    
                    <li class="nav-item dropdown"  style="overflow: auto">
                        <a href="#account_menu" class="nav-link dropdown-toggle" data-toggle="dropdown"
                            data-caret="false">
                            <img src="{{ $authUser->avatar }}" class="rounded-circle" width="32" height="32">
                            <span class="ml-1 d-flex-inline">
                                <span class="text-light">{{ $authUser->full_name }}</span>
                            </span>
                        </a>
                        <div id="account_menu" class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-item-text dropdown-item-text--lh">
                                <div><strong>{{ $authUser->full_name }}</strong></div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('dashboard') }}">{{ __('messages.dashboard') }}</a>
                            <a class="dropdown-item" href="{{ route('settings.company') }}">{{ __('messages.company') }}</a>
                            <a class="dropdown-item" href="{{ route('settings.account') }}">{{ __('messages.my_profile') }}</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}">{{ __('messages.logout') }}</a>
                        </div>
                    </li>
                   
                </ul>
            </div>
        </div>
    </div>
</div>
