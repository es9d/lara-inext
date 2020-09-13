@if($products->count() > 0)
    <div class="table-responsive" data-toggle="lists">
        <table class="table mb-0 thead-border-top-0 table-striped">
            <thead>
                <tr>
                    <th class="text-center w-30px">{{ __('messages.#id') }}</th>
                    <th>{{ __('messages.product') }}</th>
                    <th>{{ __('messages.unit') }}</th>
                    <th class="text-center">{{ __('messages.price') }}</th>
                    <th class="text-center width: 120px;">{{ __('messages.created_at') }}</th>
                    <th class="w-50px">{{ __('messages.view') }}</th>
                </tr>
            </thead>
            <tbody class="list" id="products">
                @foreach ($products as $product)
                    <tr>
                        <td>
                            <div class="badge badge-light">
                                <a class="mb-0" href="{{ route('products.edit', $product->id) }}">
                                    #{{ $product->id }}
                                </a>
                            </div>
                        </td>
                        <td>
                            <a  class="h6 mb-0" href="{{ route('products.edit', $product->id) }}">
                                <strong>{{ $product->name }}</strong>
                            </a>
                        </td>
                        <td class="text-center w-80px">
                            {{ $product->unit->name ?? '-' }}
                        </td>
                        <td class="text-center w-80px">
                            {{ money($product->price, $product->currency_code) }}
                        </td>
                        <td class="text-center">
                            {{ $product->formatted_created_at }}
                        </td>
                        <td>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-link">
                                <i class="material-icons icon-16pt">arrow_forward</i>
                            </a> 
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row card-body pagination-light justify-content-center text-center">
        {{ $products->links() }}
    </div>
@else
    <div class="row justify-content-center card-body pb-0 pt-5">
        <i class="material-icons fs-64px">store</i>
    </div>
    <div class="row justify-content-center card-body pb-5">
        <p class="h4">{{ __('messages.no_products_yet') }}</p>
    </div>
@endif