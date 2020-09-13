<?php

namespace App\Http\Controllers\Application\Settings;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use App\Http\Requests\Application\Settings\PaymentType\Store;
use App\Http\Requests\Application\Settings\PaymentType\Update;

class PaymentTypeController extends Controller
{
    /**
     * Display the Form for Creating New Payment Type
     *
     * @param  \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $payment_type = new PaymentMethod();

        // Fill model with old input
        if (!empty($request->old())) {
            $payment_type->fill($request->old());
        }

        return view('application.settings.payment.types.create', [
            'payment_type' => $payment_type,
        ]);
    }
 
    /**
     * Store the Payment Method in Database
     *
     * @param \App\Http\Requests\Application\Settings\PaymentType\Store $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(Store $request)
    {
        $user = $request->user();
        $currentCompany = $user->currentCompany();

        // Create Payment Method and Store in Database
        PaymentMethod::create([
            'name' => $request->name,
            'company_id' => $currentCompany->id,
        ]);
 
        session()->flash('alert-success', __('messages.payment_type_category_added'));
        return redirect()->route('settings.payment');
    }

    /**
     * Display the Form for Editing Payment Type
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $payment_type = PaymentMethod::findOrFail($request->type);
 
        return view('application.settings.payment.types.edit', [
            'payment_type' => $payment_type,
        ]);
    }

    /**
     * Update the Payment Type
     *
     * @param \App\Http\Requests\Application\Settings\PaymentType\Update $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(Update $request)
    {
        $payment_type = PaymentMethod::findOrFail($request->type);
        
        // Update Payment Type in Database
        $payment_type->update([
            'name' => $request->name
        ]);
 
        session()->flash('alert-success', __('messages.payment_type_category_updated'));
        return redirect()->route('settings.payment');
    }

    /**
     * Delete the Payment Type
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        $payment_type = PaymentMethod::findOrFail($request->type);
         
        // Delete Payment Type from Database
        $payment_type->delete();

        session()->flash('alert-success', __('messages.payment_type_category_deleted'));
        return redirect()->route('settings.payment');
    }
}
