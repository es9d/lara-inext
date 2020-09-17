@extends('layouts.app', ['page' => 'estimates'])

@section('title', __('messages.create_estimate'))
 
@section('page_header')
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('estimates') }}">{{ __('messages.estimates') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('messages.create_estimate') }}</li>
                </ol>
            </nav>
            <h1 class="m-0">{{ __('messages.create_estimate') }}</h1>
        </div>
    </div>
@endsection
 
@section('content') 
    <form action="{{ route('estimates.store') }}" method="POST">
        @include('layouts._form_errors')
        @csrf
        
        @include('application.estimates._form')
    </form>
@endsection
@section('page_body_scripts')
    @include('application.estimates._js')
    <script>
        $(document).ready(function() {
            addProductRow();
        });
    </script>
@endsection