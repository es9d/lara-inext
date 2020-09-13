@extends('layouts.app', ['page' => 'expenses'])

@section('title', __('messages.expenses'))
    
@section('page_header')
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('messages.expenses') }}</li>
                </ol>
            </nav>
            <h1 class="m-0">{{ __('messages.expenses') }}</h1>
        </div>
        <a href="{{ route('expenses.create') }}" class="btn btn-success ml-3">
            <i class="material-icons">add</i> 
            {{ __('messages.create_expense') }}
        </a>
    </div>
@endsection

@section('content')
    @include('application.expenses._filters')

    <div class="card">
        @include('application.expenses._table')
    </div>
@endsection
