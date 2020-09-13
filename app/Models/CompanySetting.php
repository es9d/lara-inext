<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanySetting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'option',
        'value'
    ];

    /**
     * Default Company Settings
     *
     * @var array
     */
    public static $defaultSettings = [
        'language' => 'en',
        'date_format' => 'Y M d',
        'timezone' => 'Europe/London',
        'currency_id' => 1,
        'financial_month_starts' => '1',
        'financial_month_ends' => '12',
        'invoice_prefix' => 'INV',
        'estimate_prefix' => 'EST',
        'payment_prefix' => 'PAY',
        'tax_per_item' => false,
        'discount_per_item' => false,
        'invoice_color' => '#ff9900',
        'invoice_auto_archive' => false,
        'invoice_footer' => '',
        'estimate_color' => '#ff9900',
        'estimate_footer' => '',
        'estimate_auto_archive' => false,
        'payment_color' => '#ff9900',
        'payment_footer' => '',
        'payment_auto_archive' => false,
        'invoice_mail_subject' => 'Invoice {invoice.number} from {company.name}',
        'invoice_mail_content' => '<p>Dear {customer.display_name},</p><p><br></p><p>Please find the attached invoice from the link below. We appreciate your prompt payment.</p><p><br></p><p>{invoice.link}</p><p><br></p><p>If you have any question, feel free to contact us. </p><p><br></p><p>Thank you,</p><p>{company.name}.</p>',
        'estimate_mail_subject' => 'Estimate {estimate.number} from {company.name}',
        'estimate_mail_content' => '<p>Dear {customer.display_name},</p><p><br></p><p>Please find the attached estimate from the link below.</p><p><br></p><p>{estimate.link}</p><p><br></p><p>If you have any question, feel free to contact us. </p><p><br></p><p>Thank you,</p><p>{company.name}.</p>',
        'payment_mail_subject' => 'Payment Receipt {payment.number} from {company.name}',
        'payment_mail_content' => '<p>Dear {customer.display_name},</p><p><br></p><p>Thank you for the payment. </p><p>Please find the attached payment receipt from the link below.</p><p><br></p><p>{payment.link}</p><p><br></p><p>If you have any question, feel free to contact us. </p><p><br></p><p>Thank you,</p><p>{company.name}.</p>',
        'paypal_username' => '',
        'paypal_password' => '',
        'paypal_signature' => '',
        'paypal_test_mode' => false,
        'paypal_active' => false,
        'stripe_public_key' => '',
        'stripe_secret_key' => '',
        'stripe_test_mode' => false,
        'stripe_active' => false,
        'razorpay_id' => '',
        'razorpay_secret_key' => '',
        'razorpay_test_mode' => false,
        'razorpay_active' => false,
    ];

    /**
     * Define Relation with User Model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Set new or update existing Company Settings.
     *
     * @param string $key
     * @param string $setting
     * @param string $company_id
     *
     * @return void
     */
    public static function setSetting($key, $setting, $company_id): void
    {
        $old = self::whereOption($key)->findByCompany($company_id)->first();

        if ($old) {
            $old->value = $setting;
            $old->save();
            return;
        }

        $set = new CompanySetting();
        $set->option = $key;
        $set->value = $setting;
        $set->company_id = $company_id;
        $set->save();
    }

    /**
     * Get Default Company Setting.
     *
     * @param string $key
     *
     * @return string|null
     */
    public static function getDefaultSetting($key)
    {
        $setting = self::$defaultSettings[$key];

        if ($setting) {
            return $setting;
        } else {
            return null;
        }
    }

    /**
     * Get Company Setting.
     *
     * @param string $key
     * @param string $company_id
     *
     * @return string|null
     */
    public static function getSetting($key, $company_id)
    {
        $setting = static::whereOption($key)->findByCompany($company_id)->first();

        if ($setting) {
            return $setting->value;
        } else {
            return self::getDefaultSetting($key);
        }
    }

    /**
     * Scope a query to only include settings of a given company.
     *
     * @param \Illuminate\Database\Eloquent\Builder  $query
     * @param int $company_id
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFindByCompany($query, $company_id)
    {
        $query->where('company_id', $company_id);
    }
}
