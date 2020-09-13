<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Http\Requests\Application\Vendor\Store;
use App\Http\Requests\Application\Vendor\Update;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class VendorController extends Controller
{
    /**
     * Display Vendors Page
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $currentCompany = $user->currentCompany();
 
        // Get Vendors by Company and Filters
        $vendors = QueryBuilder::for(Vendor::findByCompany($currentCompany->id))
            ->allowedFilters([
                AllowedFilter::partial('display_name'),
                AllowedFilter::partial('contact_name'),
            ])
            ->oldest()
            ->paginate()
            ->appends(request()->query());

        return view('application.vendors.index', [
            'vendors' => $vendors
        ]);
    }

    /**
     * Display the Form for Creating New Vendor
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $vendor = new Vendor();

        // Fill model with old input
        if (!empty($request->old())) {
            $vendor->fill($request->old());
        }

        return view('application.vendors.create', [
            'vendor' => $vendor,
        ]);
    }

    /**
     * Store the Vendor in Database
     *
     * @param \App\Http\Requests\Application\Vendor\Store $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(Store $request)
    {
        $user = $request->user();
        $currentCompany = $user->currentCompany();

        // Create Vendor and Store in Database
        $vendor = Vendor::create([
            'company_id' => $currentCompany->id,
            'display_name' => $request->display_name,
            'contact_name' => $request->contact_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'website' => $request->website,
        ]);
 
        // Set Vendor's Billing Address 
        $vendor->address('billing', $request->input('billing'));

        session()->flash('alert-success', __('messages.vendor_added'));
        return redirect()->route('vendors.details', $vendor->id);
    } 

    /**
     * Display the Vendor Details Page
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function details(Request $request)
    {
        $vendor = Vendor::findOrFail($request->vendor);

        // Get Expenses by Vendor
        $expenses = $vendor->expenses()->orderBy('created_at')->paginate(50);

        return view('application.vendors.details', [
            'vendor' => $vendor,
            'expenses' => $expenses,
        ]);
    }

    /**
     * Display the Form for Editing Vendor
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $vendor = Vendor::findOrFail($request->vendor);

        return view('application.vendors.edit', [
            'vendor' => $vendor,
        ]);
    }

    /**
     * Update the Vendor in Database
     *
     * @param \App\Http\Requests\Application\Vendor\Update $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(Update $request)
    {
        $vendor = Vendor::findOrFail($request->vendor);
        
        // Update Vendor in Database
        $vendor->update([
            'display_name' => $request->display_name,
            'contact_name' => $request->contact_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'website' => $request->website,
        ]);

        // Update Vendor's billing address
        $vendor->updateAddress('billing', $request->input('billing'));

        session()->flash('alert-success', __('messages.vendor_updated'));
        return redirect()->route('vendors.details', $vendor->id);
    }

    /**
     * Delete the Vendor
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        $vendor = Vendor::findOrFail($request->vendor);

        // Delete Vendor's Expenses from Database
        if ($vendor->expenses()->exists()) {
            $vendor->expenses()->delete();
        }

        // Delete Vendor's Addresses from Database
        if ($vendor->addresses()->exists()) {
            $vendor->addresses()->delete();
        }

        // Delete Vendor from Database
        $vendor->delete();

        session()->flash('alert-success', __('messages.vendor_deleted'));
        return redirect()->route('vendors');
    }
}
