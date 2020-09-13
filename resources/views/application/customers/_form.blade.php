<div class="card card-form">
    <div class="row no-gutters">
        <div class="col-lg-4 card-body">
            <p><strong class="headings-color">{{ __('messages.customer_information') }}</strong></p>
            <p class="text-muted">{{ __('messages.basic_customer_information') }}</p>
        </div>
        <div class="col-lg-8 card-form__body card-body">
            <div class="row">
                <div class="col">
                    <div class="form-group required">
                        <label for="display_name">{{ __('messages.display_name') }}</label>
                        <input name="display_name" type="text" class="form-control" placeholder="{{ __('messages.display_name') }}" value="{{ $customer->display_name }}" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group required">
                        <label for="contact_name">{{ __('messages.contact_name') }}</label>
                        <input name="contact_name" type="text" class="form-control" placeholder="{{ __('messages.contact_name') }}" value="{{ $customer->contact_name }}" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group required">
                        <label for="email">{{ __('messages.email') }}</label>
                        <input name="email" type="email" class="form-control" placeholder="{{ __('messages.email') }}" value="{{ $customer->email }}" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="phone">{{ __('messages.phone') }}</label>
                        <input name="phone" type="text" class="form-control" placeholder="{{ __('messages.phone') }}" value="{{ $customer->phone }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group required">
                        <label for="currency_id">{{ __('messages.currency') }}</label> 
                        <select name="currency_id" data-toggle="select" class="form-control select2-hidden-accessible" data-select2-id="currency_id" required>
                            <option disabled selected>{{ __('messages.select_currency') }}</option>
                            @foreach(get_currencies_select2_array() as $option)
                                <option value="{{ $option['id'] }}" {{ $customer->currency_id == $option['id'] ? 'selected=""' : '' }}>{{ $option['text'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="website">{{ __('messages.website') }}</label>
                        <input name="website" type="text" class="form-control" placeholder="{{ __('messages.website') }}" value="{{ $customer->website }}">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row no-gutters">
        <div class="col-lg-4 card-body">
            <p><strong class="headings-color">{{ __('messages.billing_address') }}</strong></p>
            <p class="text-muted">{{ __('messages.customer_billing_address') }}</p>
        </div>
        <div class="col-lg-8 card-form__body card-body">
            <p class="row"><strong class=" col headings-color">{{ __('messages.billing_address') }}</strong></p>
            <div class="row">
                <div class="col">
                    <div class="form-group required">
                        <label for="billing[name]">{{ __('messages.name') }}</label>
                        <input name="billing[name]" type="text" class="form-control" placeholder="{{ __('messages.address_name') }}" value="{{ $customer->billing->name }}" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="billing[phone]">{{ __('messages.phone') }}</label>
                        <input name="billing[phone]" type="text" class="form-control" value="{{ $customer->billing->phone }}" placeholder="{{ __('messages.phone') }}">
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
                                <option value="{{ $option['id'] }}" {{ $customer->billing->country_id == $option['id'] ? 'selected=""' : '' }}>{{ $option['text'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="billing[state]">{{ __('messages.state') }}</label>
                        <input name="billing[state]" type="text" class="form-control" value="{{ $customer->billing->state }}" placeholder="{{ __('messages.state') }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="billing[city]">{{ __('messages.city') }}</label>
                        <input name="billing[city]" type="text" class="form-control" value="{{ $customer->billing->city }}" placeholder="{{ __('messages.city') }}">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="billing[zip]">{{ __('messages.postal_code') }}</label>
                        <input name="billing[zip]" type="text" class="form-control" value="{{ $customer->billing->zip }}" placeholder="{{ __('messages.postal_code') }}">
                    </div>
                </div>
            </div>

            <div class="form-group required">
                <label for="billing[address_1]">{{ __('messages.address') }}</label>
                <textarea name="billing[address_1]" class="form-control" rows="2" placeholder="{{ __('messages.address') }}" required>{{ $customer->billing->address_1 }}</textarea>
            </div>
        </div>
    </div>

    <div class="row no-gutters">
        <div class="col-lg-4 card-body">
            <p><strong class="headings-color">{{ __('messages.shipping_address') }}</strong></p>
            <p class="text-muted">{{ __('messages.customer_shipping_address') }}</p>
        </div>
        <div class="col-lg-8 card-form__body card-body">
            <p class="row"><strong class=" col headings-color">{{ __('messages.shipping_address') }}</strong></p>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="shipping[name]">{{ __('messages.name') }}</label>
                        <input name="shipping[name]" type="text" class="form-control" value="{{ $customer->shipping->name }}" placeholder="{{ __('messages.address_name') }}">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="shipping[phone]">{{ __('messages.phone') }}</label>
                        <input name="shipping[phone]" type="text" class="form-control" value="{{ $customer->shipping->phone }}" placeholder="{{ __('messages.phone') }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="shipping[country_id]">{{ __('messages.country') }}</label>
                        <select id="shipping[country_id]" name="shipping[country_id]" data-toggle="select" class="form-control select2-hidden-accessible" data-select2-id="shipping[country_id]">
                            <option disabled selected>{{ __('messages.select_country') }}</option>
                            @foreach(get_countries_select2_array() as $option)
                                <option value="{{ $option['id'] }}" {{ $customer->shipping->country_id == $option['id'] ? 'selected=""' : '' }}>{{ $option['text'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="shipping[state]">{{ __('messages.state') }}</label>
                        <input name="shipping[state]" type="text" class="form-control" value="{{ $customer->shipping->state }}" placeholder="{{ __('messages.state') }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="shipping[city]">{{ __('messages.city') }}</label>
                        <input name="shipping[city]" type="text" class="form-control" value="{{ $customer->shipping->city }}" placeholder="{{ __('messages.city') }}">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="shipping[zip]">{{ __('messages.postal_code') }}</label>
                        <input name="shipping[zip]" type="text" class="form-control" value="{{ $customer->shipping->zip }}" placeholder="{{ __('messages.postal_code') }}">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="shipping[address_1]">{{ __('messages.address') }}</label>
                <textarea name="shipping[address_1]" class="form-control" rows="2" placeholder="{{ __('messages.address') }}">{{ $customer->shipping->address_1 }}</textarea>
            </div>

            <div class="form-group text-center mt-5">
                <button type="submit" class="btn btn-primary">{{ __('messages.save_customer') }}</button>
            </div>
        </div>
    </div>
</div>
