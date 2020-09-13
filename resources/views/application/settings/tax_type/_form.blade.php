<div class="row">
    <div class="col">
        <div class="form-group required">
            <label for="name">{{ __('messages.name') }}</label>
            <input name="name" type="text" class="form-control" placeholder="{{ __('messages.name') }}" value="{{ $tax_type->name }}" required>
        </div>
    </div>
    <div class="col">
        <div class="form-group required">
            <label for="percent">{{ __('messages.percent') }}</label>
            <input name="percent" type="number" class="form-control" placeholder="{{ __('messages.percent') }}" value="{{ $tax_type->percent }}" required>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label for="description">{{ __('messages.description') }}</label>
            <textarea name="description" class="form-control" placeholder="{{ __('messages.description') }}" rows="4">{{ $tax_type->description }}</textarea>
        </div>
    </div>
</div>
