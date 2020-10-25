<?php

namespace App\Http\Controllers\Application\Settings;

use App\Http\Controllers\Controller;
use App\Models\ProductUnit;
use Illuminate\Http\Request;
use App\Http\Requests\Application\Settings\ProductUnit\Store;
use App\Http\Requests\Application\Settings\ProductUnit\Update;

class ProductUnitController extends Controller
{ 
    /**
     * Display the Form for Creating New Product Unit
     *
     * @param  \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $product_unit = new ProductUnit();

        // Fill model with old input
        if (!empty($request->old())) {
            $product_unit->fill($request->old());
        }

        return view('application.settings.product.unit.create', [
            'product_unit' => $product_unit,
        ]);
    }
 
    /**
     * Store the Product Unit in Database
     *
     * @param \App\Http\Requests\Application\Settings\ProductUnit\Store $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(Store $request)
    {
        $user = $request->user();
        $currentCompany = $user->currentCompany();

        // Create Product Unit and Store in Database
        ProductUnit::create([
            'name' => $request->name,
            'company_id' => $currentCompany->id,
        ]);
 
        session()->flash('alert-success', __('messages.product_unit_category_added'));
        return redirect()->route('settings.product');
    }

    /**
     * Display the Form for Editing Product Unit
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $product_unit = ProductUnit::findOrFail($request->product_unit);
 
        return view('application.settings.product.unit.edit', [
            'product_unit' => $product_unit,
        ]);
    }

    /**
     * Update the Product Unit
     *
     * @param \App\Http\Requests\Application\Settings\ProductUnit\Update $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(Update $request)
    {
        $product_unit = ProductUnit::findOrFail($request->product_unit);
        
        // Update Product Unit in Database
        $product_unit->update([
            'name' => $request->name
        ]);
 
        session()->flash('alert-success', __('messages.product_unit_category_updated'));
        return redirect()->route('settings.product');
    }

    /**
     * Delete the Product Unit
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        $product_unit = ProductUnit::findOrFail($request->product_unit);
        
        // If the product_unit already in use in Product
        // then return back and flash an alert message
        if($product_unit->products->count()){
            session()->flash('alert-success', __('messages.product_unit_cant_deleted_invoice'));
            return redirect()->route('settings.product.unit.edit', $product_unit);
        }
        // Delete Product Unit from Database
        $product_unit->delete();

        session()->flash('alert-success', __('messages.product_unit_category_deleted'));
        return redirect()->route('settings.product');
    }
}
