<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    /**
     * Get Customers Ajax Request
     * 
     * @param \Illuminate\Http\Request $request
     * 
     * @return json
     */ 
    public function customers(Request $request)
    {
        $user = $request->user();
        $currentCompany = $user->currentCompany();

        $search = $request->search;

        if($search == ''){
            $customers = Customer::findByCompany($currentCompany->id)->limit(5)->get();
        }else{
            $customers = Customer::findByCompany($currentCompany->id)->where('display_name', 'like', '%' .$search . '%')->limit(5)->get();
        }

        $response = collect();
        foreach($customers as $customer){
            $response->push([
                "id" => $customer->id,
                "text" => $customer->display_name,
                "currency" => $customer->currency,
                "billing_address" => $customer->displayLongAddress('billing'),
                "shipping_address" => $customer->displayLongAddress('shipping'),
            ]);
        }

        return response()->json($response);
    }

    /**
     * Get Invoices Ajax Request
     * 
     * @param \Illuminate\Http\Request $request
     * 
     * @return json
     */ 
    public function invoices(Request $request)
    {
        $user = $request->user();
        $currentCompany = $user->currentCompany();
 
        $invoices = Invoice::findByCompany($currentCompany->id)
            ->findByCustomer($request->customer_id)
            ->unpaid()
            ->where('due_amount', '>', 0)
            ->select('id', 'invoice_number AS text', 'due_amount')
            ->get();

        return response()->json($invoices);
    }

    /**
     * Get Products Ajax Request
     * 
     * @param \Illuminate\Http\Request $request
     * 
     * @return json
     */ 
    public function products(Request $request)
    {
        $user = $request->user();
        $currentCompany = $user->currentCompany();

        $products = Product::findByCompany($currentCompany->id)
            ->select('id', 'name AS text', 'price')
            ->with('taxes')
            ->get();
 
        return response()->json($products);
    }
}
