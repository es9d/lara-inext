<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\Application\Product\Store;
use App\Http\Requests\Application\Product\Update;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ProductController extends Controller
{
    /**
     * Display Products Page
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $currentCompany = $user->currentCompany();
 
        // Get Products by Company
        $products = QueryBuilder::for(Product::findByCompany($currentCompany->id))
            ->allowedFilters([
                AllowedFilter::partial('name'),
                AllowedFilter::exact('unit_id'),
            ])
            ->oldest()
            ->paginate()
            ->appends(request()->query());

        return view('application.products.index', [
            'products' => $products
        ]);
    }

    /**
     * Display the Form for Creating New Product
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $product = new Product();

        // Fill model with old input
        if (!empty($request->old())) {
            $product->fill($request->old());
        }

        return view('application.products.create', [
            'product' => $product,
        ]); 
    }

    /**
     * Store the Product in Database
     *
     * @param \App\Http\Requests\Application\Product\Store $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(Store $request)
    {
        $user = $request->user();
        $currentCompany = $user->currentCompany();

        // Create Product and Store in Database
        $product = Product::create([
            'name' => $request->name,
            'company_id' => $currentCompany->id,
            'unit_id' => $request->unit_id,
            'price'  => $request->price,
            'description' => $request->description,
        ]);

        // Add Product Taxes
        if ($request->has('taxes')) {
            foreach ($request->taxes as $tax) {
                $product->taxes()->create([
                    'tax_type_id' => $tax
                ]);
            }
        }

        session()->flash('alert-success', __('messages.product_added'));
        return redirect()->route('products');
    }

    /**
     * Display the Form for Editing Product
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $product = Product::findOrFail($request->product);

        return view('application.products.edit', [
            'product' => $product,
        ]); 
    }

    /**
     * Update the Product in Database
     *
     * @param \App\Http\Requests\Application\Product\Update $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(Update $request)
    {
        $product = Product::findOrFail($request->product);

        // Update the Expense
        $product->update([
            'name' => $request->name,
            'unit_id' => $request->unit_id,
            'price'  => $request->price,
            'description' => $request->description,
        ]);

        // Remove old Product Taxes
        $product->taxes()->delete();

        // Update Product Taxes
        if ($request->has('taxes')) {
            foreach ($request->taxes as $tax) {
                $product->taxes()->create([
                    'tax_type_id' => $tax
                ]);
            }
        }

        session()->flash('alert-success', __('messages.product_updated'));
        return redirect()->route('products');
    }

    /**
     * Delete the Product
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        $product = Product::findOrFail($request->product);

        // If the product already in use in Invoice Items
        // then return back and flash an alert message
        if ($product->invoice_items()->exists() && $product->invoice_items()->count() > 0) {
            session()->flash('alert-success', __('messages.product_cant_deleted_invoice'));
            return redirect()->route('products.edit', $request->product);
        }

        // If the product already in use in Estimate Items
        // then return back and flash an alert message
        if ($product->estimate_items()->exists() && $product->estimate_items()->count() > 0) {
            session()->flash('alert-success', __('messages.product_cant_deleted_estimate'));
            return redirect()->route('products.edit', $request->product);
        }

        // Delete Product Taxes from Database
        if ($product->taxes()->exists() && $product->taxes()->count() > 0) {
            $product->taxes()->delete();
        }

        // Delete Product from Database
        $product->delete();
        
        session()->flash('alert-success', __('messages.product_deleted'));
        return redirect()->route('products');
    }
}
