@extends('layouts.app', ['page' => 'vendors'])

@section('title', __('messages.create_vendor'))
    
@section('page_header')
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('vendors') }}">{{ __('messages.vendors') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('messages.create_vendor') }}</li>
                </ol>
            </nav>
            <h1 class="m-0">{{ __('messages.create_vendor') }}</h1>
        </div>
    </div>
@endsection
 
@section('content') 
    <form action="{{ route('vendors.store') }}" method="POST">
        @include('layouts._form_errors')
        @csrf

        @include('application.vendors._form')
    </form>
@endsection
