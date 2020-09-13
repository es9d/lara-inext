<?php

namespace App\Http\Controllers\Application\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Application\Settings\Company\Update;

class CompanyController extends Controller
{
    /**
     * Display Company Settings Page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('application.settings.company.index');
    }
 
    /**
     * Update the Company
     *
     * @param \App\Http\Requests\Application\Settings\Company\Update $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(Update $request)
    {
        $user = $request->user();
        $currentCompany = $user->currentCompany();
        
        // Update Company
        $currentCompany->update($request->validated()); 

        // Update Company Address
        $address = $request->input('billing');
        $address['name'] = $currentCompany->name;
        $currentCompany->updateAddress('billing', $address);

        // Update Company Logo
        if ($request->has('avatar')) {
            $currentCompany->clearMediaCollection('avatar');
            $currentCompany->addMediaFromRequest('avatar')->toMediaCollection('avatar');
        }

        session()->flash('alert-success', __('messages.company_updated'));
        return redirect()->route('settings.company');
    }
}
