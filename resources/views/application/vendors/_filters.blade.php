<form action="" method="GET">
    <div class="card card-form d-flex flex-column flex-sm-row">
        <div class="card-form__body card-body-form-group flex">
            <div class="row">
                <div class="col-sm-auto">
                    <div class="form-group">
                        <label for="filter[display_name]">{{ __('messages.display_name') }}</label>
                        <input name="filter[display_name]" type="text" class="form-control" value="{{ Request::get("filter")['display_name']??'' }}" placeholder="{{ __('messages.search') }}">
                    </div>
                </div>
                <div class="col-sm-auto">
                    <div class="form-group">
                        <label for="filter[contact_name]">{{ __('messages.contact_name') }}</label>
                        <input name="filter[contact_name]" type="text" class="form-control" value="{{ Request::get("filter")['contact_name'] ??''}}" placeholder="{{ __('messages.search') }}">
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-12">
                    <a href="{{ route('vendors') }}">{{ __('messages.clear_filters') }}</a>
                </div>
            </div>
        </div>
        <button type="submit" class="btn bg-white border-left border-top border-top-sm-0 rounded-top-0 rounded-top-sm rounded-left-sm-0">
            <i class="material-icons primary---text icon-20pt">refresh</i>
            {{ __('messages.filter') }}
        </button>
    </div>
</form>