@extends('layouts.app', ['page' => 'expenses'])

@section('title', __('messages.create_expense'))
 
@section('page_header')
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('expenses') }}">{{ __('messages.expenses') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('messages.create_expense') }}</li>
                </ol>
            </nav>
            <h1 class="m-0">{{ __('messages.create_expense') }}</h1>
        </div>
    </div>
@endsection
 
@section('content') 
    <form action="{{ route('expenses.store') }}" method="POST" enctype="multipart/form-data">
        @include('layouts._form_errors')
        @csrf
        
        @include('application.expenses._form')
    </form>
@endsection