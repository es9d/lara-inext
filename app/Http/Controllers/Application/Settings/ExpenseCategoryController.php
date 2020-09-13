<?php

namespace App\Http\Controllers\Application\Settings;

use App\Http\Controllers\Controller;
use App\Models\ExpenseCategory;
use Illuminate\Http\Request;
use App\Http\Requests\Application\Settings\ExpenseCategory\Store;
use App\Http\Requests\Application\Settings\ExpenseCategory\Update;

class ExpenseCategoryController extends Controller
{
    /**
     * Display Expense Category Settings Page
     * 
     * @param  \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $currentCompany = $user->currentCompany();

        // Get Expense Categories by Company
        $expense_categories = ExpenseCategory::findByCompany($currentCompany->id)->paginate(15);

        return view('application.settings.expense_category.index', [
            'expense_categories' => $expense_categories,
        ]);
    }
 
    /**
     * Display the Form for Creating New Expense Category
     *
     * @param  \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $expense_category = new ExpenseCategory();

        // Fill model with old input
        if (!empty($request->old())) {
            $expense_category->fill($request->old());
        }

        return view('application.settings.expense_category.create', [
            'expense_category' => $expense_category,
        ]);
    }
 
    /**
     * Store the Expense Category in Database
     *
     * @param \App\Http\Requests\Application\Settings\ExpenseCategory\Store $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(Store $request)
    {
        $user = $request->user();
        $currentCompany = $user->currentCompany();

        // Create Expense Category and Store in Database
        ExpenseCategory::create([
            'name' => $request->name,
            'company_id' => $currentCompany->id,
            'description' => $request->description,
        ]);
 
        session()->flash('alert-success', __('messages.expense_category_added'));
        return redirect()->route('settings.expense_categories');
    }

    /**
     * Display the Form for Editing Expense Category
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $expense_category = ExpenseCategory::findOrFail($request->expense_category);
 
        return view('application.settings.expense_category.edit', [
            'expense_category' => $expense_category,
        ]);
    }

    /**
     * Update the Expense Category
     *
     * @param \App\Http\Requests\Application\Settings\ExpenseCategory\Update $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(Update $request)
    {
        $expense_category = ExpenseCategory::findOrFail($request->expense_category);
        
        // Update Expense Category in Database
        $expense_category->update([
            'name' => $request->name,
            'description' => $request->description
        ]);
 
        session()->flash('alert-success', __('messages.expense_category_updated'));
        return redirect()->route('settings.expense_categories');
    }

    /**
     * Delete the Expense Category
     *
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        $expense_category = ExpenseCategory::findOrFail($request->expense_category);
        
        // Delete Expense Category from Database
        $expense_category->delete();

        session()->flash('alert-success', __('messages.expense_category_deleted'));
        return redirect()->route('settings.expense_categories');
    }
}
