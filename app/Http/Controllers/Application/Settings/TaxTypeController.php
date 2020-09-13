<?php

namespace App\Http\Controllers\Application\Settings;

use App\Http\Controllers\Controller;
use App\Models\TaxType;
use Illuminate\Http\Request;
use App\Http\Requests\Application\Settings\TaxType\Store;
use App\Http\Requests\Application\Settings\TaxType\Update;

class TaxTypeController extends Controller
{
    /**
     * Display Tax Type Settings Page
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $currentCompany = $user->currentCompany();

        // Get Expense Categories by Company
        $tax_types = TaxType::findByCompany($currentCompany->id)->paginate(15);

        return view('application.settings.tax_type.index', [
            'tax_types' => $tax_types,
        ]);
    }
 
    /**
     * Display the Form for Creating New Tax Type
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $tax_type = new TaxType();

        // Fill model with old input
        if (!empty($request->old())) {
            $tax_type->fill($request->old());
        }

        return view('application.settings.tax_type.create', [
            'tax_type' => $tax_type,
        ]);
    }
 
    /**
     * Store the Tax Type in Database
     *
     * @param \App\Http\Requests\Application\Settings\TaxType\Store $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(Store $request)
    {
        $user = $request->user();
        $currentCompany = $user->currentCompany();

        // Create Tax Type and Store in Database
        TaxType::create([
            'name' => $request->name,
            'company_id' => $currentCompany->id,
            'percent' => $request->percent,
            'description' => $request->description,
        ]);
 
        session()->flash('alert-success', __('messages.tax_type_added'));
        return redirect()->route('settings.tax_types');
    }

    /**
     * Display the Form for Editing Tax Type
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $tax_type = TaxType::findOrFail($request->tax_type);
 
        return view('application.settings.tax_type.edit', [
            'tax_type' => $tax_type,
        ]);
    }

    /**
     * Update the Tax Type
     *
     * @param \App\Http\Requests\Application\Settings\TaxType\Update $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(Update $request)
    {
        $tax_type = TaxType::findOrFail($request->tax_type);
        
        // Update Tax Type in Database
        $tax_type->update([
            'name' => $request->name,
            'percent' => $request->percent,
            'description' => $request->description,
        ]);
 
        session()->flash('alert-success', __('messages.tax_type_updated'));
        return redirect()->route('settings.tax_types');
    }

    /**
     * Delete the Tax Type
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        $tax_type = TaxType::findOrFail($request->tax_type);
        
        // Check if the Tax is already in use
        if ($tax_type->taxes() && $tax_type->taxes()->count() > 0) {
            session()->flash('alert-error', __('messages.tax_type_is_in_use'));
            return redirect()->route('settings.tax_types');
        }

        // Delete Tax Type from Database
        $tax_type->delete();
         
        session()->flash('alert-success', __('messages.tax_type_deleted'));
        return redirect()->route('settings.tax_types');
    }
}
