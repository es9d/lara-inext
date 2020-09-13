<?php

namespace App\Models;

use App\Traits\UUIDTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use UUIDTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'customer_id',
        'invoice_id',
        'payment_method_id',
        'transaction_reference',
        'payment_date',
        'payment_number',
        'amount',
        'notes',
        'private_notes',
    ]; 

    /**
     * Automatically cast date attributes to Carbon
     * 
     * @var array
     */
    protected $dates = [
        'created_at', 
        'updated_at', 
        'payment_date'
    ];

    /**
     * Define Relation with Company Model
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Define Relation with Invoice Model
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    /**
     * Define Relation with Customer Model
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Define Relation with PaymentMethod Model
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    /**
     * Customized strpos helper function for excluding prefix 
     * from payment number
     * 
     * @param string $haystack
     * @param string $needle
     * @param int $number
     * 
     * @return string
     */
    private function strposX($haystack, $needle, $number)
    {
        if ($number == '1') {
            return strpos($haystack, $needle);
        } elseif ($number > '1') {
            return strpos(
                $haystack,
                $needle,
                $this->strposX($haystack, $needle, $number - 1) + strlen($needle)
            );
        } else {
            return error_log('Error: Value for parameter $number is out of range');
        }
    }

    /**
     * Helper function for getting the next Payment Number
     * by searching the database and increase 1
     * 
     * @param string $prefix
     * 
     * @return string
     */
    public static function getNextPaymentNumber($prefix)
    {
        // Get the last created order
        $payment = Payment::where('payment_number', 'LIKE', $prefix . '-%')
                    ->orderBy('created_at', 'desc')
                    ->first();
        if (!$payment) {
            // We get here if there is no order at all
            // If there is no number set it to 0, which will be 1 at the end.
            $number = 0;
        } else {
            $number = explode("-", $payment->payment_number);
            $number = $number[1];
        }
        // If we have ORD000001 in the database then we only want the number
        // So the substr returns this 000001

        // Add the string in front and higher up the number.
        // the %05d part makes sure that there are always 6 numbers in the string.
        // so it adds the missing zero's when needed.

        return sprintf('%06d', intval($number) + 1);
    }

    /**
     * Set payment_num attribute
     *
     * @return int
     */
    public function getPaymentNumAttribute()
    {
        $position = $this->strposX($this->payment_number, "-", 1) + 1;
        return substr($this->payment_number, $position);
    }

    /**
     * Set payment_prefix attribute
     * 
     * @return string
     */
    public function getPaymentPrefixAttribute ()
    {
        return $this->id 
            ? explode("-", $this->payment_number)[0]
            : CompanySetting::getSetting('payment_prefix', $this->company_id);
    }

    /**
     * Set formatted_created_at attribute by custom date format
     * from Company Settings
     *
     * @return string
     */
    public function getFormattedCreatedAtAttribute($value)
    {
        $dateFormat = CompanySetting::getSetting('date_format', $this->company_id);
        return Carbon::parse($this->created_at)->format($dateFormat);
    }

    /**
     * Set formatted_payment_date attribute by custom date format
     * from Company Settings
     *
     * @return string
     */
    public function getFormattedPaymentDateAttribute($value)
    {
        $dateFormat = CompanySetting::getSetting('date_format', $this->company_id);
        return Carbon::parse($this->payment_date)->format($dateFormat);
    }

    /**
     * Get currency_code attribute
     * 
     * @return string
     */
    public function getCurrencyCodeAttribute($value)
    {
        return $this->customer
            ? $this->customer->currency->code
            : $this->company->currency->code;
    }

    /**
     * Scope a query to only include Payments of a given company.
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

    /**
     * Scope a query to only include Payments of a given customer.
     *
     * @param \Illuminate\Database\Eloquent\Builder  $query
     * @param int $customer_id
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFindByCustomer($query, $customer_id)
    {
        $query->where('customer_id', $customer_id);
    }

    /**
     * Scope a query to only return Payments which has payment_date
     * greater or equal then given date
     *
     * @param \Illuminate\Database\Eloquent\Builder  $query
     * @param Date $from
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFrom($query, $from)
    {
        $query->where('payment_date', '>=', $from);
    }

    /**
     * Scope a query to only return Payments which has payment_date
     * less or equal then given date
     *
     * @param \Illuminate\Database\Eloquent\Builder  $query
     * @param Date $to
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTo($query, $to)
    {
        $query->where('payment_date', '<=', $to);
    }
}
