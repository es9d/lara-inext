@extends('layouts.app', ['page' => 'products'])

@section('title', __('messages.products'))
    
@section('page_header')
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('messages.products') }}</li>
                </ol>
            </nav>
            <h1 class="m-0">{{ __('messages.products') }}</h1>
        </div>
        <a href="{{ route('products.create') }}" class="btn btn-success ml-3"><i class="material-icons">add</i> {{ __('messages.create_product') }}</a>
    </div>
@endsection

@section('content')
    @include('application.products._filters')

    <div class="card">
        @include('application.products._table')
    </div>
@endsection
