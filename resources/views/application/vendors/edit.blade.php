@extends('layouts.app', ['page' => 'vendors'])

@section('title', __('messages.update_vendor'))
    
@section('page_header')
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('vendors') }}">{{ __('messages.vendors') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('messages.update_vendor') }}</li>
                </ol>
            </nav>
            <h1 class="m-0 h3">{{ __('messages.update_vendor') }}</h1>
        </div>
        <a href="{{ route('vendors.delete', $vendor->id) }}" class="btn btn-danger ml-3 delete-confirm">
            <i class="material-icons">delete</i> 
            {{ __('messages.delete_vendor') }}
        </a>
    </div>
@endsection
 
@section('content') 
    <form action="{{ route('vendors.update', $vendor->id) }}" method="POST">
        @include('layouts._form_errors')
        @csrf
        
        @include('application.vendors._form')
    </form>
@endsection