<?php

use App\Helpers\Initials;
use App\Models\Currency;
use App\Models\Country;
use App\Models\ExpenseCategory;
use App\Models\PaymentMethod;
use App\Models\ProductUnit;
use App\Models\TaxType;
use App\Services\DateFormats;
use App\Services\TimeZones;

if (! function_exists('initials')) {
    /**
     * Get the initials of given name
     *
     * @param string $string
     *
     * @return string
     */
    function initials($string)
    {
        return Initials::generate($string);
    }
}

if (! function_exists('get_countries_select2_array')) {
    /**
     * get_countries_select2_array
     *
     * @return collect
     */
    function get_countries_select2_array()
    {
        return Country::getSelect2Array();
    }
}

if (! function_exists('get_currencies_select2_array')) {
    /**
     * get_currencies_select2_array
     *
     * @return collect
     */
    function get_currencies_select2_array()
    {
        return Currency::getSelect2Array();
    }
}

if (! function_exists('get_product_units_select2_array')) {
    /**
     * get_product_units_select2_array
     *
     * @return collect
     */
    function get_product_units_select2_array($company_id)
    {
        return ProductUnit::getSelect2Array($company_id);
    }
}

if (! function_exists('get_tax_types_select2_array')) {
    /**
     * get_tax_types_select2_array
     *
     * @return collect
     */
    function get_tax_types_select2_array($company_id)
    {
        return TaxType::getSelect2Array($company_id);
    }
}

if (! function_exists('get_payment_methods_select2_array')) {
    /**
     * get_payment_methods_select2_array
     *
     * @return collect
     */
    function get_payment_methods_select2_array($company_id)
    {
        return PaymentMethod::getSelect2Array($company_id);
    }
}

if (! function_exists('get_expense_categories_select2_array')) {
    /**
     * get_expense_categories_select2_array
     *
     * @return collect
     */
    function get_expense_categories_select2_array($company_id)
    {
        return ExpenseCategory::getSelect2Array($company_id);
    }
}


if (! function_exists('get_timezones_select2_array')) {
    /**
     * get_timezones_select2_array
     *
     * @return collect
     */
    function get_timezones_select2_array()
    {
        return TimeZones::getSelect2Array();
    }
}

if (! function_exists('get_date_formats_select2_array')) {
    /**
     * get_date_formats_select2_array
     *
     * @return collect
     */
    function get_date_formats_select2_array()
    {
        return DateFormats::getSelect2Array();
    }
}

if (! function_exists('get_languages_select2_array')) {
    /**
     * get_languages_select2_array
     *
     * @return array
     */
    function get_languages_select2_array()
    {
        return [
            ['id' => 'en', 'text' => __('messages.english')],
        ];
    }
}

if (! function_exists('get_months_select2_array')) {
    /**
     * get_months_select2_array
     *
     * @return array
     */
    function get_months_select2_array()
    {
        return [
            ['id' => 1, 'text' => __('messages.january')],
            ['id' => 2, 'text' => __('messages.february')],
            ['id' => 3, 'text' => __('messages.march')],
            ['id' => 4, 'text' => __('messages.april')],
            ['id' => 5, 'text' => __('messages.may')],
            ['id' => 6, 'text' => __('messages.june')],
            ['id' => 7, 'text' => __('messages.july')],
            ['id' => 8, 'text' => __('messages.august')],
            ['id' => 9, 'text' => __('messages.september')],
            ['id' => 10, 'text' => __('messages.november')],
            ['id' => 11, 'text' => __('messages.october')],
            ['id' => 12, 'text' => __('messages.december')],
        ];
    }
}
