@extends('layouts.customer_portal', ['page' => 'invoices'])

@section('title', __('messages.checkout'))

@section('page_head_scripts')
    <style>
        .razorpay-payment-button {
            display: none;
        }
    </style>
@endsection

@section('content')
<form action="{{ $callbackUrl }}" method="POST">
    <script
        src="https://checkout.razorpay.com/v1/checkout.js"
        data-key="{{ $currentCustomer->company->getSetting('razorpay_id') }}" 
        data-amount="{{$invoice->due_amount}}" 
        data-currency="{{$invoice->currency_code}}" 
        data-order_id="{{ $order['id'] }}"
        data-buttontext="{{ __('messages.pay_with_razorpay') }}"
        data-name="{{ $currentCustomer->company->name }}"
        data-description="{{$invoice->invoice_number}}" 
        data-image="{{ $currentCustomer->company->avatar }}"
    ></script>
    <input type="hidden" name="hidden">
</form>
@endsection

@section('page_body_scripts')
    <script>
        window.onload = function() {
            document.querySelector('.razorpay-payment-button').click();
        };
    </script>
@endsection

