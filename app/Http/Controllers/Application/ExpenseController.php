<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Http\Requests\Application\Expense\Store;
use App\Http\Requests\Application\Expense\Update;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ExpenseController extends Controller
{
    /**
     * Display Expenses Page
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $currentCompany = $user->currentCompany();
 
        // Get Expenses by Company
        $expenses = QueryBuilder::for(Expense::findByCompany($currentCompany->id))
            ->allowedFilters([
                AllowedFilter::exact('expense_category_id'),
                AllowedFilter::scope('from'),
                AllowedFilter::scope('to'),
            ])
            ->oldest()
            ->paginate()
            ->appends(request()->query());

        return view('application.expenses.index', [
            'expenses' => $expenses
        ]); 
    }

    /**
     * Display the Form for Creating New Expense
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = $request->user();
        $currentCompany = $user->currentCompany();

        $expense = new Expense();

        // Fill model with old input
        if (!empty($request->old())) {
            $expense->fill($request->old());
        }

        // Vendors list for select2 options
        $vendors = Vendor::findByCompany($currentCompany->id)->get();

        return view('application.expenses.create', [
            'expense' => $expense,
            'vendors' => $vendors
        ]); 
    }

    /**
     * Store the Expense in Database
     *
     * @param \App\Http\Requests\Application\Expense\Store $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(Store $request)
    {
        $user = $request->user();
        $currentCompany = $user->currentCompany();

        // Create Expense and Store in Database
        $expense = Expense::create([
            'expense_category_id' => $request->expense_category_id,
            'amount' => $request->amount,
            'company_id' => $currentCompany->id,
            'vendor_id' => $request->vendor_id,
            'expense_date' => $request->expense_date,
            'notes' => $request->notes,
        ]);

        // Upload Receipt File
        if ($request->has('receipt')) {
            $expense->clearMediaCollection('receipt');
            $expense->addMediaFromRequest('receipt')->toMediaCollection('receipt');
        }

        session()->flash('alert-success', __('messages.expense_added'));
        return redirect()->route('expenses');
    }

    /**
     * Display the Form for Editing Expense
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $user = $request->user();
        $currentCompany = $user->currentCompany();

        $expense = Expense::findOrFail($request->expense);

        // Vendors list for select2 options
        $vendors = Vendor::findByCompany($currentCompany->id)->get();

        return view('application.expenses.edit', [
            'expense' => $expense,
            'vendors' => $vendors,
        ]);
    }

    /**
     * Update the Expense in Database
     *
     * @param \App\Http\Requests\Application\Expense\Update $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(Update $request)
    {
        $expense = Expense::findOrFail($request->expense);
        
        // Update the Expense
        $expense->update([
            'expense_category_id' => $request->expense_category_id,
            'amount' => $request->amount,
            'vendor_id' => $request->vendor_id,
            'expense_date' => $request->expense_date,
            'notes' => $request->notes,
        ]);

        // Upload Receipt File
        if ($request->has('receipt')) {
            $expense->clearMediaCollection('receipt');
            $expense->addMediaFromRequest('receipt')->toMediaCollection('receipt');
        }

        session()->flash('alert-success', __('messages.expense_updated'));
        return redirect()->route('expenses.edit', $expense->id);
    }

    /**
     * Download the Receipt file of Expense
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return media
     */
    public function download_receipt(Request $request)
    {
        $expense = Expense::findOrFail($request->expense);

        // Get receipt
        $receipt = $expense->getFirstMedia('receipt');
       
        // Return the file if the receipt file is exist
        return $receipt
            ? response()->download($receipt->getPath(), $receipt->file_name)
            : null;
    }

    /**
     * Delete the Expense
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        $expense = Expense::findOrFail($request->expense);

        // Delete Expense from Database
        $expense->delete();

        session()->flash('alert-success', __('messages.expense_deleted'));
        return redirect()->route('expenses');
    }
}
