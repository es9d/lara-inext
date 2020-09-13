@extends('layouts.app', ['page' => 'expenses'])

@section('title', __('messages.update_expense'))
    
@section('page_header')
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('expenses') }}">{{ __('messages.expenses') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('messages.update_expense') }}</li>
                </ol>
            </nav>
            <h1 class="m-0 h3">{{ __('messages.update_expense') }}</h1>
        </div>
        <a href="{{ route('expenses.delete', $expense->id) }}" class="btn btn-danger ml-3 delete-confirm">
            <i class="material-icons">delete</i> 
            {{ __('messages.delete_expense') }}
        </a>
    </div>
@endsection
 
@section('content') 
    <form action="{{ route('expenses.update', $expense->id) }}" method="POST" enctype="multipart/form-data">
        @include('layouts._form_errors')
        @csrf
        
        @include('application.expenses._form')
    </form>
@endsection