@extends('layouts.app', ['page' => 'payments'])

@section('title', __('messages.create_payment'))
    
@section('page_header')
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('payments') }}">{{ __('messages.payments') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('messages.create_payment') }}</li>
                </ol>
            </nav>
            <h1 class="m-0">{{ __('messages.create_payment') }}</h1>
        </div>
    </div>
@endsection
 
@section('content') 
    <form action="{{ route('payments.store') }}" method="POST">
        @include('layouts._form_errors')
        @csrf
        
        @include('application.payments._form')
    </form>
@endsection

@section('page_body_scripts')
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        
        $(document).ready(function(){
            $('#invoice_select').select2({
                placeholder: "{{ __('messages.select_invoice') }}",
                minimumResultsForSearch: -1
            })

            $("#customer").select2({
                placeholder: "{{ __('messages.customer') }}",
                ajax: { 
                    url: "{{ route('ajax.customers') }}",
                    type: "get",
                    dataType: "json",
                    delay: 250,
                    data: function (params) {
                        return {
                            _token: CSRF_TOKEN,
                            search: params.term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                },
                templateSelection: function (data, container) {
                    $(data.element).attr('data-currency', JSON.stringify(data.currency));
                    return data.text;
                }
            });

            $("#customer").change(function() {
                var customer_id = $("#customer").val();
                var currency = $('#customer').find(':selected').data('currency');
                console.log(currency);
                setupPriceInput(currency);

                $.get("{{ route('ajax.invoices') }}", {customer_id: customer_id}, function(response) {
                    if(!jQuery.isEmptyObject(response)) {
                        $('#invoice_select').empty();
                        $('#invoice_select').select2({
                            placeholder: 'Select Invoice',
                            minimumResultsForSearch: -1,
                            data: response,
                            templateSelection: function (data, container) {
                                $(data.element).attr('data-due_amount', data.due_amount);
                                return data.text;
                            }
                        });

                        $('#amount').val($('#invoice_select').find(':selected').data('due_amount'));
                        $("#amount").focusout();
                    }
                });
            });
        });
    </script>
@endsection
