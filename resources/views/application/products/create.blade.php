@extends('layouts.app', ['page' => 'products'])

@section('title', __('messages.create_product'))
 
@section('page_header')
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('products') }}">{{ __('messages.products') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('messages.create_product') }}</li>
                </ol>
            </nav>
            <h1 class="m-0">{{ __('messages.create_product') }}</h1>
        </div>
    </div>
@endsection
 
@section('content') 
    <form action="{{ route('products.store') }}" method="POST">
        @include('layouts._form_errors')
        @csrf
        
        @include('application.products._form')
    </form>
@endsection