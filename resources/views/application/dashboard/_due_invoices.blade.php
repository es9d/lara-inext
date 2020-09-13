@if($dueInvoices->count() > 0)
    <table class="table table-striped border-bottom mb-0">
        <tbody>
            @foreach ($dueInvoices as $invoice)
                <tr>
                    <td>
                        <div>
                            <a href="{{ route('invoices.details', $invoice->id) }}" class="text-15pt d-flex align-items-center">
                                <strong>{{ $invoice->invoice_number }}</strong>
                            </a>
                        </div>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('customers.details', $invoice->customer->id) }}">
                            {{ $invoice->customer->display_name }}
                        </a>
                    </td>
                    <td class="text-center">
                        @if($invoice->status == 'DRAFT')
                            <div class="badge badge-dark">
                                {{ $invoice->status }}
                            </div>
                        @elseif($invoice->status == 'SENT')
                            <div class="badge badge-info">
                                {{ $invoice->status }}
                            </div>
                        @elseif($invoice->status == 'VIEWED')
                            <div class="badge badge-primary">
                                {{ $invoice->status }}
                            </div>
                        @elseif($invoice->status == 'OVERDUE')
                            <div class="badge badge-danger">
                                {{ $invoice->status }}
                            </div>
                        @elseif($invoice->status == 'COMPLETED')
                            <div class="badge badge-success">
                                {{ $invoice->status }}
                            </div>
                        @endif
                    </td>
                    <td class="text-right">
                        {{ money($invoice->due_amount, $invoice->currency_code) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <div class="row justify-content-center card-body pb-0 pt-5">
        <i class="material-icons fs-64px">receipt</i>
    </div>
    <div class="row justify-content-center card-body pb-5">
        <p class="h4">{{ __('messages.no_due_invoices') }}</p>
    </div>
@endif
