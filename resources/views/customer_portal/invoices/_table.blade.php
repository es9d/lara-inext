@if($invoices->count() > 0)
    <div class="table-responsive">
        <table class="table table-xl mb-0 thead-border-top-0 table-striped">
            <thead>
                <tr>
                    <th>{{ __('messages.invoice_number') }}</th>
                    <th>{{ __('messages.date') }}</th>
                    <th>{{ __('messages.paid_status') }}</th>
                    <th>{{ __('messages.total') }}</th>
                    <th>{{ __('messages.due_amount') }}</th>
                    <th class="w-50px">{{ __('messages.view') }}</th>
                </tr>
            </thead>
            <tbody class="list" id="invoices">
                @foreach ($invoices as $invoice)
                    <tr>
                        <td class="h6">
                            <a href="{{ route('customer_portal.invoices.details', [$currentCustomer->uid, $invoice->uid]) }}">
                                {{ $invoice->invoice_number }}
                            </a>
                        </td>
                        <td class="h6">
                            {{ $invoice->formatted_invoice_date }}
                        </td>
                        <td class="h6">
                            @if($invoice->paid_status == 'UNPAID')
                                <div class="badge badge-warning fs-0-9rem">
                                    {{ $invoice->paid_status }}
                                </div>
                            @elseif($invoice->paid_status == 'PARTIALLY_PAID')
                                <div class="badge badge-info fs-0-9rem">
                                    {{ $invoice->paid_status }}
                                </div>
                            @elseif($invoice->paid_status == 'PAID')
                                <div class="badge badge-success fs-0-9rem">
                                    {{ $invoice->paid_status }}
                                </div>
                            @endif
                        </td>
                        <td class="h6">
                            {{ money($invoice->total, $invoice->currency_code) }}
                        </td>
                        <td class="h6">
                            {{ money($invoice->due_amount, $invoice->currency_code) }}
                        </td>
                        <td class="h6">
                            <a href="{{ route('customer_portal.invoices.details', [$currentCustomer->uid, $invoice->uid]) }}" class="btn btn-sm btn-link">
                                <i class="material-icons icon-16pt">arrow_forward</i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row card-body pagination-light justify-content-center text-center">
        {{ $invoices->links() }}
    </div>
@else
    <div class="row justify-content-center card-body pb-0 pt-5">
        <i class="material-icons fs-64px" >description</i>
    </div>
    <div class="row justify-content-center card-body pb-5">
        <p class="h4">{{ __('messages.no_invoices_yet') }}</p>
    </div>
@endif