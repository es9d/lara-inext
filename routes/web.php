<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'HomeController@index')->middleware('installed')->name('home');
Auth::routes();
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
// PDF Views
Route::get('/viewer/invoice/{invoice}/pdf', 'Application\PDFController@invoice')->name('pdf.invoice');
Route::get('/viewer/estimate/{estimate}/pdf', 'Application\PDFController@estimate')->name('pdf.estimate');
Route::get('/viewer/payment/{payment}/pdf', 'Application\PDFController@payment')->name('pdf.payment');

// Customer Portal Routes
Route::group(['namespace' => 'CustomerPortal', 'prefix' => '/portal/{customer}', 'middleware' => ['installed', 'customer_portal']], function () {
    // Dashboard
    Route::get('/', 'DashboardController@index');
    Route::get('/dashboard', 'DashboardController@index')->name('customer_portal.dashboard');

    // Invoices
    Route::get('/invoices', 'InvoiceController@index')->name('customer_portal.invoices');
    Route::get('/invoices/{invoice}', 'InvoiceController@show')->name('customer_portal.invoices.details');

    // PaypalExpress Checkout
    Route::post('/invoices/{invoice}/paypal/payment', 'Checkout\PaypalExpressController@payment')->name('customer_portal.invoices.paypal.payment');
    Route::get('/invoices/{invoice}/paypal/completed', 'Checkout\PaypalExpressController@completed')->name('customer_portal.invoices.paypal.completed');
    Route::get('/invoices/{invoice}/paypal/cancelled', 'Checkout\PaypalExpressController@cancelled')->name('customer_portal.invoices.paypal.cancelled');

    // Razorpay Checkout
    Route::get('/invoices/{invoice}/razorpay/checkout', 'Checkout\RazorpayController@checkout')->name('customer_portal.invoices.razorpay.checkout');
    Route::post('/invoices/{invoice}/razorpay/callback', 'Checkout\RazorpayController@callback')->name('customer_portal.invoices.razorpay.callback');

    // Stripe Checkout
    Route::get('/invoices/{invoice}/stripe/checkout', 'Checkout\StripeController@checkout')->name('customer_portal.invoices.stripe.checkout');
    Route::post('/invoices/{invoice}/stripe/payment', 'Checkout\StripeController@payment')->name('customer_portal.invoices.stripe.payment');
    Route::get('/invoices/{invoice}/stripe/completed', 'Checkout\StripeController@completed')->name('customer_portal.invoices.stripe.completed');

    // Estimates
    Route::get('/estimates', 'EstimateController@index')->name('customer_portal.estimates');
    Route::get('/estimates/{estimate}', 'EstimateController@show')->name('customer_portal.estimates.details');
    Route::get('/estimates/{estimate}/mark/{status?}', 'EstimateController@mark')->name('customer_portal.estimates.mark');

    // Payment
    Route::get('/payments', 'PaymentController@index')->name('customer_portal.payments');
    Route::get('/payments/{payment}', 'PaymentController@show')->name('customer_portal.payments.details');
});

// Application Routes
Route::group(['namespace' => 'Application', 'middleware' => ['installed', 'auth', 'dashboard','locale']], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    // Customers
    Route::get('/customers', 'CustomerController@index')->name('customers');
    Route::get('/customers/create', 'CustomerController@create')->name('customers.create');
    Route::post('/customers/create', 'CustomerController@store')->name('customers.store');
    Route::get('/customers/{customer}/details', 'CustomerController@details')->name('customers.details');
    Route::get('/customers/{customer}/edit', 'CustomerController@edit')->name('customers.edit');
    Route::post('/customers/{customer}/edit', 'CustomerController@update')->name('customers.update');
    Route::get('/customers/{customer}/delete', 'CustomerController@delete')->name('customers.delete');

    // Products & Services
    Route::get('/products', 'ProductController@index')->name('products');
    Route::get('/products/create', 'ProductController@create')->name('products.create');
    Route::post('/products/create', 'ProductController@store')->name('products.store');
    Route::get('/products/{product}/edit', 'ProductController@edit')->name('products.edit');
    Route::post('/products/{product}/edit', 'ProductController@update')->name('products.update');
    Route::get('/products/{product}/delete', 'ProductController@delete')->name('products.delete');

    // Invoices
    Route::get('/invoices/create', 'InvoiceController@create')->name('invoices.create');
    Route::post('/invoices/create', 'InvoiceController@store')->name('invoices.store');
    Route::get('/invoices/{invoice}/details', 'InvoiceController@show')->name('invoices.details');
    Route::get('/invoices/{invoice}/edit', 'InvoiceController@edit')->name('invoices.edit');
    Route::post('/invoices/{invoice}/edit', 'InvoiceController@update')->name('invoices.update');
    Route::get('/invoices/{invoice}/delete', 'InvoiceController@delete')->name('invoices.delete');
    Route::get('/invoices/{invoice}/send', 'InvoiceController@send')->name('invoices.send');
    Route::get('/invoices/{invoice}/mark/{status?}', 'InvoiceController@mark')->name('invoices.mark');
    Route::get('/invoices/{tab?}', 'InvoiceController@index')->name('invoices');

    // Estimates
    Route::get('/estimates/create', 'EstimateController@create')->name('estimates.create');
    Route::post('/estimates/create', 'EstimateController@store')->name('estimates.store');
    Route::get('/estimates/{estimate}/details', 'EstimateController@show')->name('estimates.details');
    Route::get('/estimates/{estimate}/edit', 'EstimateController@edit')->name('estimates.edit');
    Route::post('/estimates/{estimate}/edit', 'EstimateController@update')->name('estimates.update');
    Route::get('/estimates/{estimate}/delete', 'EstimateController@delete')->name('estimates.delete');
    Route::get('/estimates/{estimate}/send', 'EstimateController@send')->name('estimates.send');
    Route::get('/estimates/{estimate}/mark/{status?}', 'EstimateController@mark')->name('estimates.mark');
    Route::get('/estimates/{tab?}', 'EstimateController@index')->name('estimates');

    // Payments
    Route::get('/payments', 'PaymentController@index')->name('payments');
    Route::get('/payments/create', 'PaymentController@create')->name('payments.create');
    Route::post('/payments/create', 'PaymentController@store')->name('payments.store');
    Route::get('/payments/{payment}/edit', 'PaymentController@edit')->name('payments.edit');
    Route::post('/payments/{payment}/edit', 'PaymentController@update')->name('payments.update');
    Route::get('/payments/{payment}/delete', 'PaymentController@delete')->name('payments.delete');

    // Expenses
    Route::get('/expenses', 'ExpenseController@index')->name('expenses');
    Route::get('/expenses/create', 'ExpenseController@create')->name('expenses.create');
    Route::post('/expenses/create', 'ExpenseController@store')->name('expenses.store');
    Route::get('/expenses/{expense}/edit', 'ExpenseController@edit')->name('expenses.edit');
    Route::post('/expenses/{expense}/edit', 'ExpenseController@update')->name('expenses.update');
    Route::get('/expenses/{expense}/receipt', 'ExpenseController@download_receipt')->name('expenses.download_receipt');
    Route::get('/expenses/{expense}/delete', 'ExpenseController@delete')->name('expenses.delete');

    // Vendors
    Route::get('/vendors', 'VendorController@index')->name('vendors');
    Route::get('/vendors/create', 'VendorController@create')->name('vendors.create');
    Route::post('/vendors/create', 'VendorController@store')->name('vendors.store');
    Route::get('/vendors/{vendor}/details', 'VendorController@details')->name('vendors.details');
    Route::get('/vendors/{vendor}/edit', 'VendorController@edit')->name('vendors.edit');
    Route::post('/vendors/{vendor}/edit', 'VendorController@update')->name('vendors.update');
    Route::get('/vendors/{vendor}/delete', 'VendorController@delete')->name('vendors.delete');

    // Setting Routes
    Route::group(['namespace' => 'Settings', 'prefix' => 'settings'], function () {
        // Settings>Account Settings
        Route::get('/account', 'AccountController@index')->name('settings.account');
        Route::post('/account', 'AccountController@update')->name('settings.account.update');

        // Settings>Notification Settings
        Route::get('/notifications', 'NotificationController@index')->name('settings.notifications');
        Route::post('/notifications', 'NotificationController@update')->name('settings.notifications.update');

        // Settings>Company Settings
        Route::get('/company', 'CompanyController@index')->name('settings.company');
        Route::post('/company', 'CompanyController@update')->name('settings.company.update');

        // Settings>Preferences
        Route::get('/preferences', 'PreferenceController@index')->name('settings.preferences');
        Route::post('/preferences', 'PreferenceController@update')->name('settings.preferences.update');

        // Settings>Invoice Settings
        Route::get('/invoice', 'InvoiceController@index')->name('settings.invoice');
        Route::post('/invoice', 'InvoiceController@update')->name('settings.invoice.update');

        // Settings>Estimate Settings
        Route::get('/estimate', 'EstimateController@index')->name('settings.estimate');
        Route::post('/estimate', 'EstimateController@update')->name('settings.estimate.update');

        // Settings>Payment Settings
        Route::get('/payment', 'PaymentController@index')->name('settings.payment');
        Route::post('/payment', 'PaymentController@update')->name('settings.payment.update');
        Route::get('/payment/type/create', 'PaymentTypeController@create')->name('settings.payment.type.create');
        Route::post('/payment/type/create', 'PaymentTypeController@store')->name('settings.payment.type.store');
        Route::get('/payment/type/{type}/edit', 'PaymentTypeController@edit')->name('settings.payment.type.edit');
        Route::post('/payment/type/{type}/edit', 'PaymentTypeController@update')->name('settings.payment.type.update');
        Route::get('/payment/type/{type}/delete', 'PaymentTypeController@delete')->name('settings.payment.type.delete');
        Route::get('/payment/gateway/{gateway}/edit', 'PaymentGatewayController@edit')->name('settings.payment.gateway.edit');
        Route::post('/payment/gateway/{gateway}/edit', 'PaymentGatewayController@update')->name('settings.payment.gateway.update');

        // Settings>Product Settings
        Route::get('/product', 'ProductController@index')->name('settings.product');
        Route::post('/product', 'ProductController@update')->name('settings.product.update');
        Route::get('/product/unit/create', 'ProductUnitController@create')->name('settings.product.unit.create');
        Route::post('/product/unit/create', 'ProductUnitController@store')->name('settings.product.unit.store');
        Route::get('/product/unit/{product_unit}/edit', 'ProductUnitController@edit')->name('settings.product.unit.edit');
        Route::post('/product/unit/{product_unit}/edit', 'ProductUnitController@update')->name('settings.product.unit.update');
        Route::get('/product/unit/{product_unit}/delete', 'ProductUnitController@delete')->name('settings.product.unit.delete');

        // Settings>Tax Types
        Route::get('/tax-types', 'TaxTypeController@index')->name('settings.tax_types');
        Route::get('/tax-types/create', 'TaxTypeController@create')->name('settings.tax_types.create');
        Route::post('/tax-types/create', 'TaxTypeController@store')->name('settings.tax_types.store');
        Route::get('/tax-types/{tax_type}/edit', 'TaxTypeController@edit')->name('settings.tax_types.edit');
        Route::post('/tax-types/{tax_type}/edit', 'TaxTypeController@update')->name('settings.tax_types.update');
        Route::get('/tax-types/{tax_type}/delete', 'TaxTypeController@delete')->name('settings.tax_types.delete');

        // Settings>Expense Categories
        Route::get('/expense-categories', 'ExpenseCategoryController@index')->name('settings.expense_categories');
        Route::get('/expense-categories/create', 'ExpenseCategoryController@create')->name('settings.expense_categories.create');
        Route::post('/expense-categories/create', 'ExpenseCategoryController@store')->name('settings.expense_categories.store');
        Route::get('/expense-categories/{expense_category}/edit', 'ExpenseCategoryController@edit')->name('settings.expense_categories.edit');
        Route::post('/expense-categories/{expense_category}/edit', 'ExpenseCategoryController@update')->name('settings.expense_categories.update');
        Route::get('/expense-categories/{expense_category}/delete', 'ExpenseCategoryController@delete')->name('settings.expense_categories.delete');

        // Settings>Team
        Route::get('/team', 'TeamController@index')->name('settings.team');
        Route::get('/team/add-member', 'TeamController@createMember')->name('settings.team.createMember');
        Route::post('/team/add-member', 'TeamController@storeMember')->name('settings.team.storeMember');
        Route::get('/team/{member}/edit', 'TeamController@editMember')->name('settings.team.editMember');
        Route::post('/team/{member}/edit', 'TeamController@updateMember')->name('settings.team.updateMember');
        Route::get('/team/{member}/delete', 'TeamController@deleteMember')->name('settings.team.deleteMember');

        // Settings>Email Templates
        Route::get('/email-templates', 'EmailTemplateController@index')->name('settings.email_template');
        Route::post('/email-templates', 'EmailTemplateController@update')->name('settings.email_template.update');

    });

    // Ajax requests
    Route::get('/ajax/products', 'AjaxController@products')->name('ajax.products');
    Route::get('/ajax/customers', 'AjaxController@customers')->name('ajax.customers');
    Route::get('/ajax/invoices', 'AjaxController@invoices')->name('ajax.invoices');
});
