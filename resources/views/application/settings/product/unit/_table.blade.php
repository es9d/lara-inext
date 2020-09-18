@if($product_units->count() > 0)
    <div class="table-responsive" data-toggle="lists">
        <table class="table table-xl mb-0 thead-border-top-0 table-striped">
            <thead>
                <tr>
                    <th>{{ __('messages.name') }}</th> 
                    <th class="w-30">{{ __('messages.actions') }}</th>
                </tr>
            </thead>
            <tbody class="list" id="product_units">
                @foreach($product_units as $product_unit)
                    <tr>
                        <td class="h6">
                            <a href="{{ route('settings.product.unit.edit', $product_unit->id) }}">
                                <strong class="h6">
                                    {{ $product_unit->name }}
                                </strong>
                            </a>
                        </td>
                        <td class="h6">
                            <a href="{{ route('settings.product.unit.edit', $product_unit->id) }}" class="btn text-primary">
                                <i class="material-icons icon-16pt">edit</i>
                                {{ __('messages.edit') }}
                            </a>
                            <a href="{{ route('settings.product.unit.delete', $product_unit->id) }}" class="btn text-danger delete-confirm">
                                <i class="material-icons icon-16pt">delete</i>
                                {{ __('messages.delete') }}
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row card-body pagination-light justify-content-center text-center">
        {{ $product_units->links() }}
    </div>
@else
    <div class="row justify-content-center card-body pb-0 pt-5">
        <i class="material-icons fs-64px">style</i>
    </div>
    <div class="row justify-content-center card-body pb-5">
        <p class="h4">{{ __('messages.no_product_units_yet') }}</p>
    </div>
@endif
