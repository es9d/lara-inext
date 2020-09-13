<div class="form-group mb-4">
    <p class="h5 mb-0">
        <strong class="headings-color">{{ __('messages.razorpay_settings') }}</strong>
    </p>
    <p class="text-muted">{{ __('messages.razorpay_settings_description') }}</p>
</div>

<div class="row">
    <div class="col-12 col-md-6">
        <div class="form-group required">
            <label for="razorpay_id">{{ __('messages.razorpay_id') }}</label>
            <input name="razorpay_id" type="text" class="form-control" placeholder="{{ __('messages.razorpay_id') }}" value="{{ $currentCompany->getSetting('razorpay_id') }}" required>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="form-group required">
            <label for="razorpay_secret_key">{{ __('messages.razorpay_secret_key') }}</label>
            <input name="razorpay_secret_key" type="text" class="form-control" placeholder="{{ __('messages.razorpay_secret_key') }}" value="{{ $currentCompany->getSetting('razorpay_secret_key') }}" required>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="razorpay_test_mode">{{ __('messages.test_mode') }}</label>
            <select name="razorpay_test_mode" class="form-control">
                <option value="0" {{ $currentCompany->getSetting('razorpay_test_mode') == false ? 'selected' : '' }}>{{ __('messages.false') }}</option>
                <option value="1" {{ $currentCompany->getSetting('razorpay_test_mode') == true  ? 'selected' : '' }}>{{ __('messages.true') }}</option>
            </select>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="razorpay_active">{{ __('messages.active') }}</label>
            <select name="razorpay_active" class="form-control">
                <option value="0" {{ $currentCompany->getSetting('razorpay_active') == false ? 'selected' : '' }}>{{ __('messages.disabled') }}</option>
                <option value="1" {{ $currentCompany->getSetting('razorpay_active') == true  ? 'selected' : '' }}>{{ __('messages.active') }}</option>
            </select>
        </div>
    </div>
</div>
 
