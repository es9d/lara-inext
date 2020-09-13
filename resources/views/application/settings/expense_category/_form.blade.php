<div class="row">
    <div class="col-12">
        <div class="form-group required">
            <label for="name">{{ __('messages.name') }}</label>
            <input name="name" type="text" class="form-control" placeholder="{{ __('messages.name') }}" value="{{ $expense_category->name }}" required>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="description">{{ __('messages.description') }}</label>
            <textarea name="description" class="form-control" rows="4" placeholder="{{ __('messages.description') }}">{{ $expense_category->name }}</textarea>
        </div>
    </div>
</div>

