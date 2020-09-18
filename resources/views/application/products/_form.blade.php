<div class="card card-form">
    <div class="row no-gutters">
        <div class="col-lg-4 card-body">
            <p><strong class="headings-color">{{ __('messages.product_information') }}</strong></p>
            <p class="text-muted">{{ __('messages.basic_product_information') }}</p>
        </div>
        <div class="col-lg-8 card-form__body card-body">
            <div class="row">
                <div class="col"> 
                    <div class="form-group required">
                        <label for="name">{{ __('messages.name') }}</label>
                        <input name="name" type="text" class="form-control" placeholder="{{ __('messages.name') }}" value="{{ $product->name }}" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group required">
                        <label for="unit">{{ __('messages.unit') }}</label>
                        <select id="unit_id" name="unit_id" data-toggle="select" class="form-control select2-hidden-accessible" data-select2-id="unit_id" data-minimum-results-for-search="-1">
                            <option disabled selected>{{ __('messages.select_unit') }}</option>
                            @foreach(get_product_units_select2_array($currentCompany->id) as $option)
                                <option value="{{ $option['id'] }}" {{ $product->unit_id == $option['id'] ? 'selected=""' : '' }}>{{ $option['text'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group required">
                        <label for="price">{{ __('messages.price') }}</label>
                        <input name="price" type="text" class="form-control price_input" placeholder="{{ __('messages.price') }}" autocomplete="off" value="{{ $product->price ?? 0 }}" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="taxes">{{ __('messages.taxes') }}</label> 
                        <select id="taxes" name="taxes[]" data-toggle="select" multiple="multiple" class="form-control select2-hidden-accessible" data-select2-id="taxes">
                            @foreach(get_tax_types_select2_array($currentCompany->id) as $option)
                                <option value="{{ $option['id'] }}" {{ $product->hasTax($option['id']) ? 'selected=""' : '' }}>{{ $option['text'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
 
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="description">{{ __('messages.description') }}</label>
                        <textarea name="description" class="form-control" cols="30" rows="3">{{ $product->description }}</textarea>
                    </div>
                </div>
            </div>

            <div class="form-group text-center mt-3">
                <button type="button" class="btn btn-success form_with_price_input_submit">{{ __('messages.save_product') }}</button>
            </div>
        </div>
    </div>
</div>
