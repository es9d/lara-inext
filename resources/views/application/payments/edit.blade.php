@extends('layouts.app', ['page' => 'payments'])

@section('title', __('messages.create_payment'))
    
@section('page_header')
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('customers') }}">{{ __('messages.payments') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('messages.update_payment') }}</li>
                </ol>
            </nav>
            <h1 class="m-0 h3">{{ __('messages.update_payment') }}</h1>
        </div>
        <a href="{{ route('payments.delete', $payment->id) }}" class="btn btn-danger ml-3 delete-confirm">
            <i class="material-icons">delete</i> 
            {{ __('messages.delete_payment') }}
        </a>
    </div>
@endsection
 
@section('content') 
    <form action="{{ route('payments.update', $payment->id) }}" method="POST">
        @include('layouts._form_errors')
        @csrf
        
        @include('application.payments._form')
    </form>
@endsection

@section('page_body_scripts')
    <script>
        $(document).ready(function(){
            $('#invoice_select').prop('disabled', true);
            $('#customer').prop('disabled', true);
        });
    </script>
@endsection