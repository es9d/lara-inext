<?php

namespace App\Http\Controllers\CustomerPortal;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Invoice;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display Customer Dashboard Page
     * 
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $currentCustomer = Customer::findByUid($request->customer);
        $company = $currentCustomer->company;

        // Dashboard Stats 
        $invoicesCount = $currentCustomer->invoices()->active()->count();
        $estimatesCount = $currentCustomer->estimates()->nonDraft()->count();
        $paymentsCount = $currentCustomer->payments()->count();

        // Financial Year Starts-Ends
        $financialYearStarts = $company->getSetting('financial_month_starts');
        $financialYearEnds = $company->getSetting('financial_month_ends');

        // Create Carbon Instances from Financial Year
        $dateStarts = Carbon::now()->month($financialYearStarts)->startOfMonth();
        $dateEnds = Carbon::now()->month($financialYearEnds)->endOfMonth();

        // if the date ends is smaller than date start, add one year to date ends
        if($dateEnds->lt($dateStarts)){
            $dateEnds->addYear(1)->endOfMonth();
        }

        // Create Period from given dates
        $period = CarbonPeriod::since($dateStarts)->months(1)->until($dateEnds);

        // Arrays for Invoices Chart
        $invoices_stats_label = [];
        $invoices_stats = [];

        // Iterate over the Date Period 
        foreach ($period as $date) {
            // Add month as label
            $month = $date->format('M');
            array_push($invoices_stats_label, $month);

            // Add Invoice amount for current month
            $invoice = Invoice::findByCompany($company->id)
                ->get(['total', 'invoice_date'])
                ->whereBetween('invoice_date', [$date->format('Y-m-d'), $date->endOfMonth()->format('Y-m-d')])
                ->sum('total');
            array_push($invoices_stats, $invoice/100);
        }
 
        return view('customer_portal.dashboard.index', [
            'invoicesCount' => $invoicesCount,
            'estimatesCount' => $estimatesCount,
            'paymentsCount' => $paymentsCount,
            'invoices_stats_label' => $invoices_stats_label,
            'invoices_stats' => $invoices_stats,
            'currency_code' => $company->currency->code,
        ]); 
    }
}
