<div class="card card-form">
    <div class="row no-gutters">
        <div class="col-lg-4 card-body">
            <p><strong class="headings-color">{{ __('messages.expense_information') }}</strong></p>
            <p class="text-muted">{{ __('messages.basic_expense_information') }}</p>
        </div>
        <div class="col-lg-8 card-form__body card-body">
            <div class="form-group">
                <label>{{ __('messages.receipt') }}</label><br>
                <input type="file" onchange="changePreview(this);" class="d-none" name="receipt" id="receipt">
                <label for="receipt">
                    <div class="media align-items-center">
                        <div class="mr-3">
                            <div class="avatar avatar-xl">
                                <img id="file-prev" src="{{ $expense->receipt ?? asset('assets/images/account-add-photo.svg') }}" class="avatar-img rounded">
                            </div>
                        </div>
                        <div class="media-body">
                            <a class="btn btn-sm btn-light choose-button">{{ __('messages.choose_file') }}</a>
                        </div>
                    </div>
                </label><br>
                @if($expense->receipt)
                    <a href="{{ route('expenses.download_receipt', $expense->id) }}" target="_blank" class="btn btn-sm btn-info text-white choose-button">{{ __('messages.download_receipt') }}</a>
                @endif
            </div>
            
            <div class="row">
                <div class="col"> 
                    <div class="form-group required">
                        <label for="expense_category_id">{{ __('messages.category') }}</label> 
                        <select id="expense_category_id" name="expense_category_id" data-toggle="select" class="form-control select2-hidden-accessible" data-select2-id="expense_category_id" data-minimum-results-for-search="-1" required>
                            <option disabled selected>{{ __('messages.select_category') }}</option>
                            @foreach(get_expense_categories_select2_array($currentCompany->id) as $option)
                                <option value="{{ $option['id'] }}" {{ $expense->expense_category_id == $option['id'] ? 'selected=""' : '' }}>{{ $option['text'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col"> 
                    <div class="form-group">
                        <label for="vendor_id">{{ __('messages.vendor') }}</label> 
                        <select name="vendor_id" data-toggle="select" class="form-control select2-hidden-accessible" data-select2-id="vendor_id">
                            <option disabled selected>{{ __('messages.select_vendor') }}</option>
                            @foreach($vendors as $vendor)
                                <option value="{{ $vendor->id }}" {{ $expense->vendor_id == $vendor->id ? 'selected=""' : '' }}>{{ $vendor->display_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col"> 
                    <div class="form-group required">
                        <label for="expense_date">{{ __('messages.expense_date') }}</label>
                        <input name="expense_date" type="text"  class="form-control input" data-toggle="flatpickr" data-flatpickr-default-date="{{ $expense->expense_date ?? now() }}" placeholder="{{ __('messages.expense_date') }}" readonly="readonly" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group required">
                        <label for="amount">{{ __('messages.amount') }}</label>
                        <input name="amount" type="text" class="form-control price_input" placeholder="{{ __('messages.amount') }}" autocomplete="off" value="{{ $expense->amount ?? 0 }}" required>
                    </div>
                </div>
            </div>
 
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="notes">{{ __('messages.notes') }}</label>
                        <textarea name="notes" class="form-control" cols="30" rows="3" placeholder="{{ __('messages.notes') }}">{{ $expense->notes }}</textarea>
                    </div>
                </div>
            </div>

            <div class="form-group text-center mt-3">
                <button type="button" class="btn btn-primary form_with_price_input_submit">{{ __('messages.save_expense') }}</button>
            </div>
        </div>
    </div>
</div>
