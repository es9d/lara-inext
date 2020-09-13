@if($payments->count() > 0)
    <div class="table-responsive">
        <table class="table mb-0 thead-border-top-0 table-striped">
            <thead>
                <tr>
                    <th>{{ __('messages.payment_#') }}</th>
                    <th>{{ __('messages.date') }}</th>
                    <th>{{ __('messages.payment_type') }}</th>
                    <th>{{ __('messages.invoice') }}</th>
                    <th>{{ __('messages.amount') }}</th>
                    <th class="w-50px">{{ __('messages.view') }}</th>
                </tr>
            </thead>
            <tbody class="list" id="payments">
                @foreach ($payments as $payment)
                    <tr>
                        <td>
                            <a href="{{ route('customer_portal.payments.details', [$currentCustomer->uid, $payment->uid]) }}">
                                {{ $payment->payment_number }}
                            </a>
                        </td>
                        <td>
                            {{ $payment->formatted_payment_date }}
                        </td>
                        <td>
                            {{ $payment->payment_method->name ?? "-"}}
                        </td>
                        <td>
                            {{ $payment->invoice->invoice_number ?? "-" }}
                        </td>
                        <td>
                            {{ money($payment->amount, $payment->currency_code) }}
                        </td>
                        <td>
                            <a href="{{ route('customer_portal.payments.details', [$currentCustomer->uid, $payment->uid]) }}" class="btn btn-sm btn-link">
                                <i class="material-icons icon-16pt">arrow_forward</i>
                            </a> 
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row card-body pagination-light justify-content-center text-center">
        {{ $payments->links() }}
    </div>
@else
    <div class="row justify-content-center card-body pb-0 pt-5">
        <i class="material-icons fs-64px" >payment</i>
    </div>
    <div class="row justify-content-center card-body pb-5">
        <p class="h4">{{ __('messages.no_payments_yet') }}</p>
    </div>
@endif