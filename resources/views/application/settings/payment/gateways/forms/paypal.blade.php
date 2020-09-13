<div class="form-group mb-4">
    <p class="h5 mb-0">
        <strong class="headings-color">{{ __('messages.paypal_settings') }}</strong>
    </p>
    <p class="text-muted">{{ __('messages.paypal_settings_description') }}</p>
</div>

<div class="row">
    <div class="col-12 col-md-6">
        <div class="form-group required">
            <label for="paypal_username">{{ __('messages.username') }}</label>
            <input name="paypal_username" type="text" class="form-control" placeholder="{{ __('messages.username') }}" value="{{ $currentCompany->getSetting('paypal_username') }}" required>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="form-group required">
            <label for="paypal_password">{{ __('messages.password') }}</label>
            <input name="paypal_password" type="text" class="form-control" placeholder="{{ __('messages.password') }}" value="{{ $currentCompany->getSetting('paypal_password') }}" required>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-6">
        <div class="form-group required">
            <label for="paypal_signature">{{ __('messages.signature') }}</label>
            <input name="paypal_signature" type="text" class="form-control" placeholder="{{ __('messages.enter_signature') }}" value="{{ $currentCompany->getSetting('paypal_signature') }}" required>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="paypal_test_mode">{{ __('messages.test_mode') }}</label>
            <select name="paypal_test_mode" class="form-control">
                <option value="0" {{ $currentCompany->getSetting('paypal_test_mode') == false ? 'selected' : '' }}>{{ __('messages.false') }}</option>
                <option value="1" {{ $currentCompany->getSetting('paypal_test_mode') == true  ? 'selected' : '' }}>{{ __('messages.true') }}</option>
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="paypal_active">{{ __('messages.active') }}</label>
            <select name="paypal_active" class="form-control">
                <option value="0" {{ $currentCompany->getSetting('paypal_active') == false ? 'selected' : '' }}>{{ __('messages.disabled') }}</option>
                <option value="1" {{ $currentCompany->getSetting('paypal_active') == true  ? 'selected' : '' }}>{{ __('messages.active') }}</option>
            </select>
        </div>
    </div>
</div>
 
