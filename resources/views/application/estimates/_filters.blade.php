<form action="" method="GET">
    <div class="card card-form d-flex flex-column flex-sm-row">
        <div class="card-form__body card-body-form-group flex">
            <div class="row">
                <div class="col-sm-auto">
                    <div class="form-group">
                        <label for="filter[estimate_number]">{{ __('messages.estimate_number') }}</label>
                        <input name="filter[estimate_number]" type="text" class="form-control" value="{{ Request::get("filter")['estimate_number']??'' }}" placeholder="{{ __('messages.search') }}">
                    </div>
                </div>
                <div class="col-sm-auto">
                    <div class="form-group">
                        <label for="filter[from]">{{ __('messages.from') }}</label>
                        <input name="filter[from]" type="text" class="form-control" data-toggle="flatpickr" data-flatpickr-default-date="{{ Request::get("filter")['from'] ?? '' }}" readonly="readonly" placeholder="{{ __('messages.from') }}">
                    </div>
                </div>
                <div class="col-sm-auto">
                    <div class="form-group">
                        <label for="filter[to]">{{ __('messages.to') }}</label>
                        <input name="filter[to]" type="text" class="form-control" data-toggle="flatpickr" data-flatpickr-default-date="{{ Request::get("filter")['to'] ?? '' }}" readonly="readonly" placeholder="{{ __('messages.to') }}">
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-12">
                    <a href="{{ route('estimates') }}">{{ __('messages.clear_filters') }}</a>
                </div>
            </div>
        </div>
        <button type="submit" class="btn bg-white border-left border-top border-top-sm-0 rounded-top-0 rounded-top-sm rounded-left-sm-0">
            <i class="material-icons primary---text icon-20pt">refresh</i>
            {{ __('messages.filter') }}
        </button>
    </div>
</form>
