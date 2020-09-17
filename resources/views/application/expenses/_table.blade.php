@if($expenses->count() > 0)
    <div class="table-responsive">
        <table class="table table-xl mb-0 thead-border-top-0 table-striped">
            <thead>
                <tr>
                    <th class="text-center w-30px">{{ __('messages.#id') }}</th>
                    <th>{{ __('messages.category') }}</th>
                    <th>{{ __('messages.date') }}</th>
                    <th>{{ __('messages.note') }}</th>
                    <th>{{ __('messages.amount') }}</th>
                    <th class="w-50px">{{ __('messages.view') }}</th>
                </tr>
            </thead>
            <tbody class="list" id="expenses">
                @foreach ($expenses as $expense)
                    <tr>
                        <td class="h6">
                            <a href="{{ route('expenses.edit', $expense->id) }}">
                                #{{ $expense->id }}
                            </a>
                        </td>
                        <td class="h6">
                            <a href="{{ route('expenses.edit', $expense->id) }}">
                                <strong class="h6">
                                    {{ $expense->category->name ?? '-' }}
                                </strong>
                            </a>
                        </td>
                        <td class="h6">
                            {{ $expense->formatted_expense_date }} 
                        </td>
                        <td class="h6 d-inline-block text-truncate maxw-13rem">
                            {{ $expense->notes ?? '-' }}
                        </td>
                        <td class="h6">
                            {{ money($expense->amount, $expense->currency_code) }}
                        </td>
                        <td class="h6">
                            <a href="{{ route('expenses.edit', $expense->id) }}" class="btn btn-sm btn-link">
                                <i class="material-icons icon-16pt">arrow_forward</i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row card-body pagination-light justify-content-center text-center">
        {{ $expenses->links() }}
    </div>
@else
    <div class="row justify-content-center card-body pb-0 pt-5">
        <i class="material-icons fs-64px">monetization_on</i>
    </div>
    <div class="row justify-content-center card-body ">
        <p class="h4">{{ __('messages.no_expenses_yet') }}</p>
    </div>
    <form method="get" action="/expenses/create" style="text-align: center">
        <button class="btn btn-success mb-5" style="margin: auto;">
            <i class="material-icons">add</i> 
            Create Expense
        </button>
        <input type="hidden" name="vid" value="{{ isset($vendor)?$vendor->id:'' }}"/>
    </form>
@endif