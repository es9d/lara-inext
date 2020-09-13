<div class="card card-form">
    <div class="row no-gutters">
        <div class="col-lg-4 card-body">
            <p><strong class="headings-color">{{ __('messages.vendor_information') }}</strong></p>
            <p class="text-muted">{{ __('messages.basic_vendor_information') }}</p>
        </div>
        <div class="col-lg-8 card-form__body card-body">
            <div class="row">
                <div class="col">
                    <div class="form-group required">
                        <label for="display_name">{{ __('messages.display_name') }}</label>
                        <input name="display_name" type="text" class="form-control" placeholder="{{ __('messages.display_name') }}" value="{{ $vendor->display_name }}" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group required">
                        <label for="contact_name">{{ __('messages.contact_name') }}</label>
                        <input name="contact_name" type="text" class="form-control" placeholder="{{ __('messages.contact_name') }}" value="{{ $vendor->contact_name }}" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group required">
                        <label for="email">{{ __('messages.email') }}</label>
                        <input name="email" type="email" class="form-control" placeholder="{{ __('messages.email') }}" value="{{ $vendor->email }}" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="phone">{{ __('messages.phone') }}</label>
                        <input name="phone" type="text" class="form-control" placeholder="{{ __('messages.phone') }}" value="{{ $vendor->phone }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="website">{{ __('messages.website') }}</label>
                        <input name="website" type="text" class="form-control" placeholder="{{ __('messages.website') }}" value="{{ $vendor->website }}">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row no-gutters">
        <div class="col-lg-4 card-body">
            <p><strong class="headings-color">{{ __('messages.billing_address') }}</strong></p>
            <p class="text-muted">{{ __('messages.vendor_billing_address') }}</p>
        </div>
        <div class="col-lg-8 card-form__body card-body">
            <p class="row"><strong class=" col headings-color">{{ __('messages.billing_address') }}</strong></p>
            <div class="row">
                <div class="col">
                    <div class="form-group required">
                        <label for="billing[name]">{{ __('messages.name') }}</label>
                        <input name="billing[name]" type="text" class="form-control" placeholder="{{ __('messages.name') }}" value="{{ $vendor->billing->name }}" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="billing[phone]">{{ __('messages.phone') }}</label>
                        <input name="billing[phone]" type="text" class="form-control" value="{{ $vendor->billing->phone }}" placeholder="{{ __('messages.phone') }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group required">
                        <label for="billing[country_id]">{{ __('messages.country') }}</label>
                        <select id="billing[country_id]" name="billing[country_id]" data-toggle="select" class="form-control select2-hidden-accessible" data-select2-id="billing[country_id]" required>
                            <option disabled selected>{{ __('messages.select_country') }}</option>
                            @foreach(get_countries_select2_array() as $option)
                                <option value="{{ $option['id'] }}" {{ $vendor->billing->country_id == $option['id'] ? 'selected=""' : '' }}>{{ $option['text'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="billing[state]">{{ __('messages.state') }}</label>
                        <input name="billing[state]" type="text" class="form-control" value="{{ $vendor->billing->state }}" placeholder="{{ __('messages.state') }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="billing[city]">{{ __('messages.city') }}</label>
                        <input name="billing[city]" type="text" class="form-control" value="{{ $vendor->billing->city }}" placeholder="{{ __('messages.city') }}">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="billing[zip]">{{ __('messages.postal_code') }}</label>
                        <input name="billing[zip]" type="text" class="form-control" value="{{ $vendor->billing->zip }}" placeholder="{{ __('messages.postal_code') }}">
                    </div>
                </div>
            </div>

            <div class="form-group required">
                <label for="billing[address_1]">{{ __('messages.address') }}</label>
                <textarea name="billing[address_1]" class="form-control" rows="2" placeholder="{{ __('messages.address') }}" required>{{ $vendor->billing->address_1 }}</textarea>
            </div>

            <div class="form-group text-center mt-5">
                <button type="submit" class="btn btn-primary">{{ __('messages.save_vendor') }}</button>
            </div>
        </div>
    </div>
</div>
