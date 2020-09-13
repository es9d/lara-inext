<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\Application\Customer\Store;
use App\Http\Requests\Application\Customer\Update;
use Spatie\Activitylog\Models\Activity;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class CustomerController extends Controller
{
    /**
     * Display Customers Page
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $currentCompany = $user->currentCompany();

        // Get Customers by Company and Filters
        $customers = QueryBuilder::for(Customer::findByCompany($currentCompany->id))
            ->allowedFilters([
                AllowedFilter::partial('display_name'),
                AllowedFilter::partial('contact_name'),
                AllowedFilter::scope('has_unpaid'),
            ])
            ->oldest()
            ->paginate()
            ->appends(request()->query());

        return view('application.customers.index', [
            'customers' => $customers
        ]);
    }

    /**
     * Display the Form for Creating New Customer
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customer = new Customer();
 
        return view('application.customers.create', [
            'customer' => $customer,
        ]);
    }

    /**
     * Store the Customer in Database
     *
     * @param \App\Http\Requests\Application\Customer\Store $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(Store $request)
    {
        $user = $request->user();
        $currentCompany = $user->currentCompany();
        
        // Create Customer and Store in Database
        $customer = Customer::create([
            'company_id' => $currentCompany->id,
            'display_name' => $request->display_name,
            'contact_name' => $request->contact_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'website' => $request->website,
            'currency_id' => $request->currency_id,
        ]);

        // Set Customer's billing and shipping addresses
        $customer->address('billing', $request->input('billing'));
        $customer->address('shipping', $request->input('shipping'));

        session()->flash('alert-success', __('messages.customer_added'));
        return redirect()->route('customers.details', $customer->id);
    } 

    /**
     * Display the Customer Details Page
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function details(Request $request)
    {
        $customer = Customer::findOrFail($request->customer);

        $invoices = $customer->invoices()->orderBy('invoice_number')->paginate(50);
        $estimates = $customer->estimates()->orderBy('estimate_number')->paginate(50);
        $payments = $customer->payments()->orderBy('payment_number')->paginate(50);
        $activities = Activity::where('subject_id', $customer->id)->get();
  
        return view('application.customers.details', [
            'customer' => $customer,
            'invoices' => $invoices,
            'estimates' => $estimates,
            'payments' => $payments,
            'activities' => $activities,
        ]);
    }

    /**
     * Display the Form for Editing Customer
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $customer = Customer::findOrFail($request->customer);
        
        // Fill model with old input
        if (!empty($request->old())) {
            $customer->fill($request->old());
        }

        return view('application.customers.edit', [
            'customer' => $customer,
        ]);
    }

    /**
     * Update the Customer in Database
     *
     * @param \App\Http\Requests\Application\Customer\Update $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(Update $request)
    {
        $customer = Customer::findOrFail($request->customer);

        // Update Customer in Database
        $customer->update([
            'display_name' => $request->display_name,
            'contact_name' => $request->contact_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'website' => $request->website,
            'currency_id' => $request->currency_id,
        ]);

        // Update Customer's billing and shipping addresses
        $customer->updateAddress('billing', $request->input('billing'));
        $customer->updateAddress('shipping', $request->input('shipping'));

        session()->flash('alert-success', __('messages.customer_updated'));
        return redirect()->route('customers.details', $customer->id);
    }

    /**
     * Delete the Customer
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        $customer = Customer::findOrFail($request->customer);

        // Delete Customer's Estimates from Database
        if ($customer->estimates()->exists()) {
            $customer->estimates()->delete();
        }

        // Delete Customer's Invoices from Database
        if ($customer->invoices()->exists()) {
            $customer->invoices()->delete();
        }

        // Delete Customer's Payments from Database
        if ($customer->payments()->exists()) {
            $customer->payments()->delete();
        }
 
        // Delete Customer's Addresses from Database
        if ($customer->addresses()->exists()) {
            $customer->addresses()->delete();
        }

        // Delete Customer from Database
        $customer->delete();

        session()->flash('alert-success', __('messages.customer_deleted'));
        return redirect()->route('customers');
    }
}
