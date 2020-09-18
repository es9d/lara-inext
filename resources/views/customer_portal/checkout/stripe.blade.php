@extends('layouts.customer_portal', ['page' => 'invoices'])

@section('title', __('messages.checkout'))

@section('page_header')
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item" aria-current="page">{{ __('messages.portal') }}</li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{route('customer_portal.invoices', $currentCustomer->uid)}}">{{ __('messages.invoices') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('messages.checkout') }}</li>
                </ol>
            </nav>
            <h1 class="m-0">{{ __('messages.checkout') }}</h1>
        </div>
    </div>
@endsection

@section('content')
    <div class="row  justify-content-center">
        <div class="col-12 col-md-4">
            <div class="card">
                <h4 class="card-header">{{ __('messages.invoice') }}</h4>
                <div class="card-body">
                    <p class="h6"><strong>{{ $invoice->invoice_number }}</strong></p>
                    <p class="h6"><strong>{{ __('messages.amount') }} :</strong> {{ money($invoice->due_amount, $invoice->currency_code) }}</p>
                    <p class="h6"><strong>{{ __('messages.notes') }} :</strong> {{ $invoice->notes ?? '-' }}</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-8">
            <div class="card">
                <h4 class="card-header">{{ __('messages.credit_debit_card') }}</h4>
                <div class="card-body">
                    <div class="card-text">
                        <form action="{{ route('customer_portal.invoices.stripe.payment', ['customer' => $currentCustomer->uid, 'invoice' => $invoice->uid]) }}" method="POST" id="payment-form">
                            @csrf
                            <input type="hidden" name="paymentMethodId" id="paymentMethodId">
                            <div>
                                <label>{{ __('messages.card_holder') }}</label>
                                <input id="cardholder-name" class="form-control mb-4" type="text">
                                <!-- placeholder for Elements -->
                                <div id="card-element" class="form-control"></div>
                                <!-- Used to display form errors -->
                                <div id="card-errors" role="alert"></div>
                            </div>
        
                            <div class="d-flex flex-row mt-4 justify-content-end align-items-center">
                                <button id="card-button" class="btn btn-success">
                                    {{ __('messages.pay') }} ({{ money($invoice->due_amount, $invoice->currency_code) }})
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_body_scripts')
    <script src='https://js.stripe.com/v3/' type='text/javascript'></script>
    <script>

        var style = {
            base: {
                color: '#32325d',
                lineHeight: '1.8rem'
            }
        };

        var stripe = Stripe("{{ $currentCustomer->company->getSetting('stripe_public_key') }}");

        var elements = stripe.elements();
        var cardElement = elements.create('card', {style: style});
        cardElement.mount('#card-element');

        var cardholderName = document.getElementById('cardholder-name');
        var cardButton = document.getElementById('card-button');
        var paymentMethodIdField = document.getElementById('paymentMethodId');
        var myForm = document.getElementById('payment-form');

        cardButton.addEventListener('click', function(ev) {
            ev.preventDefault();
            cardButton.disabled = true;

            stripe.createPaymentMethod('card', cardElement, {
                billing_details: {name: cardholderName.value }
            }).then(function(result) {
                if (result.error) {
                    cardButton.disabled = false;
                    alert(result.error.message);
                } else {
                    paymentMethodIdField.value = result.paymentMethod.id;
                    myForm.submit();
                }
            });
        });
    </script>
@endsection
