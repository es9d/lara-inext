<?php

namespace App\Http\Controllers\CustomerPortal;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Customer;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PaymentController extends Controller
{
    /**
     * Display Customer Payments Page
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $currentCustomer = Customer::findByUid($request->customer);

        // Get Payments by Customer
        $query = $currentCustomer->payments()->orderBy('payment_number')->getQuery();

        // Apply Filters
        $payments = QueryBuilder::for($query)
            ->allowedFilters([
                AllowedFilter::partial('payment_number'),
                AllowedFilter::exact('payment_method_id'),
                AllowedFilter::scope('from'),
                AllowedFilter::scope('to'),
            ])
            ->paginate()
            ->appends(request()->query());

        return view('customer_portal.payments.index', [
            'payments' => $payments,
        ]);
    }

    /**
     * Display Payment Details Page
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $payment = Payment::findByUid($request->payment);

        return view('customer_portal.payments.details', [
            'payment' => $payment,
        ]);
    }
}
