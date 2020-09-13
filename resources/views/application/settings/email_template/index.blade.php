@extends('layouts.app', ['page' => 'settings'])

@section('title', __('messages.email_templates'))

@section('page_head_scripts')
    <!-- Quill Theme -->
    <link type="text/css" href="{{ asset('assets/css/vendor-quill.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('assets/css/vendor-quill.rtl.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="page__heading">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">business</i></a></li>
                <li class="breadcrumb-item">{{ __('messages.settings') }}</li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('messages.email_templates') }}</li>
            </ol>
        </nav>
        <h1 class="m-0">{{ __('messages.email_templates') }}</h1>
    </div>

    <div class="row">
        <div class="col-lg-3">
            @include('application.settings._aside', ['tab' => 'email_template'])
        </div>
        <div class="col-lg-9">
            
            <div class="card card-form">
                <div class="row no-gutters">
                    <div class="col card-form__body card-body bg-white">
                        <form action="{{ route('settings.email_template.update') }}" method="POST">
                            @include('layouts._form_errors')
                            @csrf

                            <div class="form-group mb-4">
                                <p class="h5 mb-0">
                                    <strong class="headings-color">{{ __('messages.invoice_mail') }}</strong>
                                </p>
                                <p class="text-muted">{{ __('messages.invoice_mail_description') }} <a href="#" data-toggle="modal" data-target="#modal-invoice-tags">{{ __('messages.show_templates') }}</a></p>
                            </div>

                            <div class="form-group required">
                                <label for="invoice_mail_subject">{{ __('messages.subject') }}</label>
                                <input name="invoice_mail_subject" type="text" class="form-control" placeholder="{{ __('messages.invoice_mail_subject') }}" value="{{ $currentCompany->getSetting('invoice_mail_subject') }}" required>
                            </div>

                            <div class="form-group required">
                                <label>{{ __('messages.content') }}</label>
                                <div class="quill h-250px" data-toggle="quill" data-quill-placeholder="{{ __('messages.invoice_mail_content') }}" data-quill-modules-toolbar='[["bold", "italic", "underline"], ["link", "blockquote"], [{"list": "ordered"}, {"list": "bullet"}]]'>
                                    {!! $currentCompany->getSetting('invoice_mail_content') !!}
                                </div>
                                <textarea name="invoice_mail_content" class="d-none" required>{!! $currentCompany->getSetting('invoice_mail_content') !!}</textarea>
                            </div>

                            <hr class="mt-5 mb-5">

                            <div class="form-group mb-4">
                                <p class="h5 mb-0">
                                    <strong class="headings-color">{{ __('messages.estimate_mail') }}</strong>
                                </p>
                                <p class="text-muted">{{ __('messages.estimate_mail_description') }} <a href="#" data-toggle="modal" data-target="#modal-estimate-tags">{{ __('messages.show_templates') }}</a></p>
                            </div>

                            <div class="form-group required">
                                <label for="estimate_mail_subject">{{ __('messages.subject') }}</label>
                                <input name="estimate_mail_subject" type="text" class="form-control" placeholder="{{ __('messages.estimate_mail_subject') }}" value="{{ $currentCompany->getSetting('estimate_mail_subject') }}" required>
                            </div>

                            <div class="form-group required">
                                <label>{{ __('messages.content') }}</label>
                                <div class="quill h-250px" data-toggle="quill" data-quill-placeholder="{{ __('messages.estimate_mail_content') }}" data-quill-modules-toolbar='[["bold", "italic", "underline"], ["link", "blockquote"], [{"list": "ordered"}, {"list": "bullet"}]]'>
                                    {!! $currentCompany->getSetting('estimate_mail_content') !!}
                                </div>
                                <textarea name="estimate_mail_content" class="d-none" required>{!! $currentCompany->getSetting('estimate_mail_content') !!}</textarea>
                            </div>

                            <hr class="mt-5 mb-5">

                            <div class="form-group mb-4">
                                <p class="h5 mb-0">
                                    <strong class="headings-color">{{ __('messages.payment_receipt_mail') }}</strong>
                                </p>
                                <p class="text-muted">{{ __('messages.payment_receipt_mail_description') }} <a href="#" data-toggle="modal" data-target="#modal-payment-tags">{{ __('messages.show_templates') }}</a></p>
                            </div>

                            <div class="form-group required">
                                <label for="payment_mail_subject">{{ __('messages.subject') }}</label>
                                <input name="payment_mail_subject" type="text" class="form-control" placeholder="{{ __('messages.payment_receipt_mail_subject') }}" value="{{ $currentCompany->getSetting('payment_mail_subject') }}" required>
                            </div>

                            <div class="form-group required">
                                <label>{{ __('messages.content') }}</label>
                                <div class="quill h-250px" data-toggle="quill" data-quill-placeholder="{{ __('messages.payment_receipt_mail_content') }}" data-quill-modules-toolbar='[["bold", "italic", "underline"], ["link", "blockquote"], [{"list": "ordered"}, {"list": "bullet"}]]'>
                                    {!! $currentCompany->getSetting('payment_mail_content') !!}
                                </div>
                                <textarea name="payment_mail_content" class="d-none" required>{!! $currentCompany->getSetting('payment_mail_content') !!}</textarea>
                            </div>
            
                            <div class="form-group text-right mt-4">
                                <button type="button" class="btn btn-primary submit">{{ __('messages.update_settings') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection

@section('page_body_scripts')
    <div id="modal-invoice-tags" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-large-title" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-large-title">{{ __('messages.template_tags') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('messages.close') }}">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ __('messages.company_name') }} : <kbd>{company.name}</kbd></p>
                    <br>
 
                    <p>{{ __('messages.customer_display_name') }} : <kbd>{customer.display_name}</kbd></p>
                    <p>{{ __('messages.customer_contact_name') }} : <kbd>{customer.contact_name}</kbd></p>
                    <p>{{ __('messages.customer_email') }} : <kbd>{customer.email}</kbd></p>
                    <p>{{ __('messages.customer_phone') }} : <kbd>{customer.phone}</kbd></p>
                    <br>

                    <p>{{ __('messages.invoice_number') }} : <kbd>{invoice.number}</kbd></p>
                    <p>{{ __('messages.invoice_pdf_view_link') }} : <kbd>{invoice.link}</kbd></p>
                    <p>{{ __('messages.invoice_date') }} : <kbd>{invoice.date}</kbd></p>
                    <p>{{ __('messages.invoice_due_date') }} : <kbd>{invoice.due_date}</kbd></p>
                    <p>{{ __('messages.invoice_reference_no') }} : <kbd>{invoice.reference}</kbd></p>
                    <p>{{ __('messages.invoice_notes') }} : <kbd>{invoice.notes}</kbd></p>
                    <p>{{ __('messages.invoice_sub_total') }} : <kbd>{invoice.sub_total}</kbd></p>
                    <p>{{ __('messages.invoice_total') }} : <kbd>{invoice.total}</kbd></p>
                    <br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('messages.close') }}</button>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-estimate-tags" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-large-title" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-large-title">{{ __('messages.template_tags') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('messages.close') }}">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ __('messages.company_name') }} : <kbd>{company.name}</kbd></p>
                    <br>
 
                    <p>{{ __('messages.customer_display_name') }} : <kbd>{customer.display_name}</kbd></p>
                    <p>{{ __('messages.customer_contact_name') }} : <kbd>{customer.contact_name}</kbd></p>
                    <p>{{ __('messages.customer_email') }} : <kbd>{customer.email}</kbd></p>
                    <p>{{ __('messages.customer_phone') }} : <kbd>{customer.phone}</kbd></p>
                    <br>

                    <p>{{ __('messages.estimate_number') }} : <kbd>{estimate.number}</kbd></p>
                    <p>{{ __('messages.estimate_pdf_view_link') }} : <kbd>{estimate.link}</kbd></p>
                    <p>{{ __('messages.estimate_date') }} : <kbd>{estimate.date}</kbd></p>
                    <p>{{ __('messages.estimate_expiry_date') }} : <kbd>{estimate.expiry_date}</kbd></p>
                    <p>{{ __('messages.estimate_reference_no') }} : <kbd>{estimate.reference}</kbd></p>
                    <p>{{ __('messages.estimate_notes') }} : <kbd>{estimate.notes}</kbd></p>
                    <p>{{ __('messages.estimate_sub_total') }} : <kbd>{estimate.sub_total}</kbd></p>
                    <p>{{ __('messages.estimate_total') }} : <kbd>{estimate.total}</kbd></p>
                    <br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('messages.close') }}</button>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-payment-tags" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-large-title" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-large-title">{{ __('messages.template_tags') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('messages.close') }}">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{ __('messages.company_name') }} : <kbd>{company.name}</kbd></p>
                    <br>
 
                    <p>{{ __('messages.customer_display_name') }} : <kbd>{customer.display_name}</kbd></p>
                    <p>{{ __('messages.customer_contact_name') }} : <kbd>{customer.contact_name}</kbd></p>
                    <p>{{ __('messages.customer_email') }} : <kbd>{customer.email}</kbd></p>
                    <p>{{ __('messages.customer_phone') }} : <kbd>{customer.phone}</kbd></p>
                    <br>

                    <p>{{ __('messages.payment_number') }} : <kbd>{payment.number}</kbd></p>
                    <p>{{ __('messages.payment_date') }} : <kbd>{payment.date}</kbd></p>
                    <p>{{ __('messages.payment_notes') }} : <kbd>{payment.notes}</kbd></p>
                    <p>{{ __('messages.payment_receipt_link') }} : <kbd>{payment.link}</kbd></p>
                    <p>{{ __('messages.payment_type') }} : <kbd>{payment.type}</kbd></p>
                    <p>{{ __('messages.payment_total') }} : <kbd>{payment.amount}</kbd></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">{{ __('messages.close') }}</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Quill -->
    <script src="{{ asset('assets/vendor/quill.min.js') }}"></script>
    <script src="{{ asset('assets/js/quill.js') }}"></script>

    <script>
        $('.submit').on('click', function() {
            var form = $(this).closest('form');

            var quill = $('.ql-editor').each(function (index, element) {
                var text_area = $(element).closest('.form-group').find('textarea');
                text_area.val($(element).html());
            });

            form.submit();
        });
    </script>
@endsection

