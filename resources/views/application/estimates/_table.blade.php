@if($estimates->count() > 0)
    <div class="table-responsive">
        <table class="table table-xl mb-0 thead-border-top-0 table-striped">
            <thead>
                <tr>
                    <th>{{ __('messages.estimate_number') }}</th>
                    <th>{{ __('messages.date') }}</th>
                    <th>{{ __('messages.customer') }}</th>
                    <th>{{ __('messages.status') }}</th>
                    <th>{{ __('messages.total') }}</th>
                    <th class="w-50px">{{ __('messages.view') }}</th>
                </tr>
            </thead>
            <tbody class="list" id="estimates">
                @foreach ($estimates as $estimate)
                    <tr>
                        <td class="h6">
                            <a href="{{ route('estimates.details', $estimate->id) }}">
                                {{ $estimate->estimate_number }}
                            </a>
                        </td>
                        <td class="h6">
                            {{ $estimate->formatted_estimate_date }}
                        </td>
                        <td class="h6">
                            {{ $estimate->customer->display_name }}
                        </td>
                        <td class="h6">
                            @if($estimate->status == 'DRAFT')
                                <div class="badge badge-dark fs-0-9rem">
                                    {{ $estimate->status }}
                                </div>
                            @elseif($estimate->status == 'SENT')
                                <div class="badge badge-info fs-0-9rem">
                                    {{ $estimate->status }}
                                </div>
                            @elseif($estimate->status == 'VIEWED')
                                <div class="badge badge-primary fs-0-9rem">
                                    {{ $estimate->status }}
                                </div>
                            @elseif($estimate->status == 'EXPIRED')
                                <div class="badge badge-danger fs-0-9rem">
                                    {{ $estimate->status }}
                                </div>
                            @elseif($estimate->status == 'ACCEPTED')
                                <div class="badge badge-success fs-0-9rem">
                                    {{ $estimate->status }}
                                </div>
                            @elseif($estimate->status == 'REJECTED')
                                <div class="badge badge-danger fs-0-9rem">
                                    {{ $estimate->status }}
                                </div>
                            @endif
                        </td>
                        <td class="h6">
                            {{ money($estimate->total, $estimate->currency_code) }}
                        </td>
                        <td class="h6">
                            <a href="{{ route('estimates.details', $estimate->id) }}" class="btn btn-sm btn-link">
                                <i class="material-icons icon-16pt">arrow_forward</i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row card-body pagination-light justify-content-center text-center">
        {{ $estimates->links() }}
    </div>
@else
    <div class="row justify-content-center card-body pb-0 pt-5">
        <i class="material-icons fs-64px">description</i>
    </div>
    <div class="row justify-content-center card-body">
        <p class="h4">{{ __('messages.no_estimates_yet') }}</p>
    </div>
    <form method="get" action="/estimates/create" style="text-align: center">
        <button class="btn btn-success mb-5" style="margin: auto;">
            <i class="material-icons">add</i> 
            {{ __('messages.create_estimate')}}
        </button>
        <input type="hidden" name="customerid" value="{{ isset($customer)?$customer->id:'' }}"/>
    </form>
@endif