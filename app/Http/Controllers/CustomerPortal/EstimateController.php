<?php

namespace App\Http\Controllers\CustomerPortal;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Estimate;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class EstimateController extends Controller
{
    /**
     * Display Customer Estimates Page
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $currentCustomer = Customer::findByUid($request->customer);

        // Get Estimates by Customer
        $query = $currentCustomer->estimates()->nonDraft()->orderBy('estimate_number')->getQuery();

        // Apply filters
        $estimates = QueryBuilder::for($query)
            ->allowedFilters([
                AllowedFilter::partial('estimate_number'),
                AllowedFilter::scope('from'),
                AllowedFilter::scope('to'),
            ])
            ->paginate()
            ->appends(request()->query());

        return view('customer_portal.estimates.index', [
            'estimates' => $estimates,
        ]);
    }

    /**
     * Display Estimate Details Page
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $estimate = Estimate::findByUid($request->estimate);

        return view('customer_portal.estimates.details', [
            'estimate' => $estimate,
        ]);
    }

    /**
     * Change Status of the Estimate by Given Status
     * Accepted or Rejected
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function mark(Request $request)
    {
        $currentCustomer = Customer::findByUid($request->customer);
        $estimate = Estimate::findByUid($request->estimate);

        // Mark the Estimate by given status
        if ($request->status && $request->status == 'accepted') {
            $estimate->status = Estimate::STATUS_ACCEPTED;
            session()->flash('alert-success', __('messages.estimate_accepted'));
        } else if ($request->status && $request->status == 'rejected') {
            $estimate->status = Estimate::STATUS_REJECTED;
            session()->flash('alert-success', __('messages.estimate_rejected'));
        }

        // Save the status
        $estimate->save();

        return redirect()->route('customer_portal.estimates.details', [$currentCustomer->uid ,$estimate->uid]);
    }
}
