@extends('layouts.customer_portal', ['page' => 'invoices'])

@section('title', __('messages.invoice_details'))
 
@section('page_header')
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item" aria-current="page">{{ __('messages.portal') }}</li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('messages.invoice_details') }}</li>
                </ol>
            </nav>
            <h1 class="m-0">{{ __('messages.invoice_details') }}</h1>
        </div>
    </div>
@endsection
 
@section('content') 
    <div class="row">
        <div class="col-12">
            @if(session()->has('message-danger'))
                <div class="alert alert-danger" role="alert">
                    {{ session('message-danger') }}
                </div>
            @elseif(session()->has('message-success'))
                <div class="alert alert-success" role="alert">
                    {{ session('message-success') }}
                </div>
            @endif
        </div>

        <div class="col-12 col-md-4">
            <p class="h2 pb-4">
                #{{ $invoice->invoice_number }}
            </p>
        </div>

        <div class="col-12 col-md-8 text-md-right mb-4">
            <a href="{{ route('pdf.invoice', ['invoice' => $invoice->uid, 'download' => true]) }}" target="_blank" class="btn btn-light">
                <i class="material-icons">cloud_download</i> 
                {{ __('messages.download') }}
            </a>
            @if($invoice->paid_status != 'PAID' and $invoice->company->isPaypalActive())
                <form class="d-inline-block" method="POST" action="{{ route('customer_portal.invoices.paypal.payment', ['customer' => $currentCustomer->uid, 'invoice' => $invoice->uid]) }}">
                    @csrf
                    <button class="btn paypal-button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 32" preserveAspectRatio="xMinYMin meet">
                            <path fill="#009cde" d="M 20.905 9.5 C 21.185 7.4 20.905 6 19.782 4.7 C 18.564 3.3 16.411 2.6 13.697 2.6 L 5.739 2.6 C 5.271 2.6 4.71 3.1 4.615 3.6 L 1.339 25.8 C 1.339 26.2 1.62 26.7 2.088 26.7 L 6.956 26.7 L 6.675 28.9 C 6.581 29.3 6.862 29.6 7.236 29.6 L 11.356 29.6 C 11.825 29.6 12.292 29.3 12.386 28.8 L 12.386 28.5 L 13.228 23.3 L 13.228 23.1 C 13.322 22.6 13.79 22.2 14.258 22.2 L 14.821 22.2 C 18.845 22.2 21.935 20.5 22.871 15.5 C 23.339 13.4 23.153 11.7 22.029 10.5 C 21.748 10.1 21.279 9.8 20.905 9.5 L 20.905 9.5"/>
                            <path fill="#012169" d="M 20.905 9.5 C 21.185 7.4 20.905 6 19.782 4.7 C 18.564 3.3 16.411 2.6 13.697 2.6 L 5.739 2.6 C 5.271 2.6 4.71 3.1 4.615 3.6 L 1.339 25.8 C 1.339 26.2 1.62 26.7 2.088 26.7 L 6.956 26.7 L 8.267 18.4 L 8.173 18.7 C 8.267 18.1 8.735 17.7 9.296 17.7 L 11.636 17.7 C 16.224 17.7 19.782 15.7 20.905 10.1 C 20.812 9.8 20.905 9.7 20.905 9.5"/>
                            <path fill="#003087" d="M 9.485 9.5 C 9.577 9.2 9.765 8.9 10.046 8.7 C 10.232 8.7 10.326 8.6 10.513 8.6 L 16.692 8.6 C 17.442 8.6 18.189 8.7 18.753 8.8 C 18.939 8.8 19.127 8.8 19.314 8.9 C 19.501 9 19.688 9 19.782 9.1 C 19.875 9.1 19.968 9.1 20.063 9.1 C 20.343 9.2 20.624 9.4 20.905 9.5 C 21.185 7.4 20.905 6 19.782 4.6 C 18.658 3.2 16.506 2.6 13.79 2.6 L 5.739 2.6 C 5.271 2.6 4.71 3 4.615 3.6 L 1.339 25.8 C 1.339 26.2 1.62 26.7 2.088 26.7 L 6.956 26.7 L 8.267 18.4 L 9.485 9.5 Z"/>
                        </svg> 
                        {{ __('messages.pay_with_paypal') }}
                    </button>
                </form>
            @endif
            @if($invoice->paid_status != 'PAID' and $invoice->company->isRazorpayActive())
                <a href="{{ route('customer_portal.invoices.razorpay.checkout', ['customer' => $currentCustomer->uid, 'invoice' => $invoice->uid]) }}" class="btn btn-success">
                    <i class="material-icons">payment</i> 
                    {{ __('messages.pay_with_razorpay') }}
                </a>
            @endif
            @if($invoice->paid_status != 'PAID' and $invoice->company->isStripeActive())
                <a href="{{ route('customer_portal.invoices.stripe.checkout', ['customer' => $currentCustomer->uid, 'invoice' => $invoice->uid]) }}" class="btn btn-success">
                    <i class="material-icons">payment</i> 
                    {{ __('messages.pay_with_credit_card') }}
                </a>
            @endif
        </div>
    </div>
    <div class="pdf-iframe">
        <iframe src="{{ route('pdf.invoice', $invoice->uid) }}" frameborder="0"></iframe>
    </div>
@endsection
