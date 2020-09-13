<div class="form-group mb-4">
    <p class="h5 mb-0">
        <strong class="headings-color">{{ __('messages.stripe_settings') }}</strong>
    </p>
    <p class="text-muted">{{ __('messages.stripe_settings_description') }}</p>
</div>

<div class="row">
    <div class="col-12 col-md-6">
        <div class="form-group required">
            <label for="stripe_public_key">{{ __('messages.publishable_key') }}</label>
            <input name="stripe_public_key" type="text" class="form-control" placeholder="{{ __('messages.publishable_key') }}" value="{{ $currentCompany->getSetting('stripe_public_key') }}" required>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="form-group required">
            <label for="stripe_secret_key">{{ __('messages.secret_key') }}</label>
            <input name="stripe_secret_key" type="text" class="form-control" placeholder="{{ __('messages.secret_key') }}" value="{{ $currentCompany->getSetting('stripe_secret_key') }}" required>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="stripe_test_mode">{{ __('messages.test_mode') }}</label>
            <select name="stripe_test_mode" class="form-control">
                <option value="0" {{ $currentCompany->getSetting('stripe_test_mode') == false ? 'selected' : '' }}>{{ __('messages.false') }}</option>
                <option value="1" {{ $currentCompany->getSetting('stripe_test_mode') == true  ? 'selected' : '' }}>{{ __('messages.true') }}</option>
            </select>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="stripe_active">{{ __('messages.active') }}</label>
            <select name="stripe_active" class="form-control">
                <option value="0" {{ $currentCompany->getSetting('stripe_active') == false ? 'selected' : '' }}>{{ __('messages.disabled') }}</option>
                <option value="1" {{ $currentCompany->getSetting('stripe_active') == true  ? 'selected' : '' }}>{{ __('messages.active') }}</option>
            </select>
        </div>
    </div>
</div>
 
