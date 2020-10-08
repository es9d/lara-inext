<?php

namespace App\Models;

use App\Traits\HasTax;
use App\Traits\UUIDTrait;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Invoice extends Model
{
    use HasTax;
    use UUIDTrait;

    // Invoice Statuses
    const STATUS_DRAFT = 'DRAFT';
    const STATUS_SENT = 'SENT';
    const STATUS_VIEWED = 'VIEWED';
    const STATUS_OVERDUE = 'OVERDUE';
    const STATUS_COMPLETED = 'COMPLETED';

    // Invoice Paid Statuses
    const STATUS_UNPAID = 'UNPAID';
    const STATUS_PARTIALLY_PAID = 'PARTIALLY_PAID';
    const STATUS_PAID = 'PAID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice_date',
        'due_date',
        'invoice_number',
        'reference_number',
        'customer_id',
        'company_id',
        'status',
        'paid_status',
        'discount_type',
        'discount_val',
        'sub_total',
        'total',
        'due_amount',
        'tax_per_item',
        'discount_per_item',
        'notes',
        'private_notes',
        'sent',
        'viewed',
        'mailed_at'
    ];

    /**
     * Automatically cast date attributes to Carbon
     * 
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'invoice_date',
        'due_date',
        'mailed_at'
    ];

    /**
     * Automatically cast attributes to given types
     * 
     * @var array
     */
    protected $casts = [
        'total' => 'integer',
        'tax' => 'integer',
        'sub_total' => 'integer',
        'discount' => 'float',
        'discount_val' => 'integer',
        'tax_per_item' => 'boolean',
        'discount_per_item' => 'boolean',
    ];

    /**
     * Define Relation with InvoiceItem Model
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    /**
     * Define Relation with Payment Model
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
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
     * Define Relation with Company Model
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the Total Percentage of Invoice Taxes
     * 
     * @return int
     */
    public function getTotalPercentageOfTaxes()
    {
        $total = 0;
        foreach ($this->taxes as $tax) {
            $total += $tax->tax_type->percent;
        }

        return (int) $total;
    }

    /**
     * Get Previous Status of Invoice
     * 
     * @return string
     */
    public function getPreviousStatus()
    {
        if ($this->due_date < Carbon::now()) {
            return self::STATUS_OVERDUE;
        } elseif ($this->viewed) {
            return self::STATUS_VIEWED;
        } elseif ($this->sent) {
            return self::STATUS_SENT;
        } else {
            return self::STATUS_DRAFT;
        }
    }

    /**
     * Customized strpos helper function for excluding prefix 
     * from estimate number
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
     * Helper function for getting the next Estimate Number
     * by searching the database and increase 1
     * 
     * @param string $prefix
     * 
     * @return string
     */
    public static function getNextInvoiceNumber($prefix)
    {
        // Get the last created order
        $lastOrder = Invoice::where('invoice_number', 'LIKE', $prefix . '-%')
                    ->orderBy('created_at', 'desc')
                    ->first();


        if (!$lastOrder) {
            // We get here if there is no order at all
            // If there is no number set it to 0, which will be 1 at the end.
            $number = 0;
        } else {
            $number = explode("-",$lastOrder->invoice_number);
            $number = $number[1];
        }
        // If we have ORD000001 in the database then we only want the number
        // So the substr returns this 000001

        // Add the string in front and higher up the number.
        // the %06d part makes sure that there are always 6 numbers in the string.
        // so it adds the missing zero's when needed.

        return sprintf('%06d', intval($number) + 1);
    }

    /**
     * Set invoice_num attribute
     *
     * @return int
     */
    public function getInvoiceNumAttribute()
    {
        $position = $this->strposX($this->invoice_number, "-", 1) + 1;
        return substr($this->invoice_number, $position);
    }

    /**
     * Set invoice_prefix attribute
     * 
     * @return string
     */
    public function getInvoicePrefixAttribute ()
    {
        return $this->id 
            ? explode("-", $this->invoice_number)[0]
            : CompanySetting::getSetting('invoice_prefix', $this->company_id);
    }

    /**
     * Set currency attribute from customer
     *
     * @return App\Model\Currency
     */
    public function getCurrencyAttribute($value)
    {
        return $this->customer->currency;
    }

    /**
     * Set currency_code attribute from customer
     *
     * @return string
     */
    public function getCurrencyCodeAttribute($value)
    {
        return $this->customer->currency->code;
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
     * Set formatted_updated_at attribute by custom date format
     * from Company Settings
     *
     * @return string
     */
    public function getFormattedUpdatedAtAttribute($value)
    {
        $dateFormat = CompanySetting::getSetting('date_format', $this->company_id);
        return Carbon::parse($this->updated_at)->format($dateFormat);
    }

    /**
     * Set formatted_due_date attribute by custom date format
     * from Company Settings
     *
     * @return string
     */
    public function getFormattedDueDateAttribute($value)
    {
        $dateFormat = CompanySetting::getSetting('date_format', $this->company_id);
        return Carbon::parse($this->due_date)->format($dateFormat);
    }

    /**
     * Set formatted_invoice_date attribute by custom date format
     * from Company Settings
     *
     * @return string
     */
    public function getFormattedInvoiceDateAttribute($value)
    {
        $dateFormat = CompanySetting::getSetting('date_format', $this->company_id);
        return Carbon::parse($this->invoice_date)->format($dateFormat);
    }

    /**
     * Scope a query to only include Invoices of a given company.
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
     * Scope a query to only include Invoices of a given customer.
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
     * Scope a query to only return draft Invoices
     *
     * @param \Illuminate\Database\Eloquent\Builder  $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDrafts($query)
    {
        $query->where('status', self::STATUS_DRAFT);
    }

    /**
     * Scope a query to only return active Invoices
     *
     * @param \Illuminate\Database\Eloquent\Builder  $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        $active_stats = [
            self::STATUS_SENT,
            self::STATUS_VIEWED,
            self::STATUS_OVERDUE, 
            self::STATUS_COMPLETED, 
        ];
        $query->whereIn('status', $active_stats);
    }

    /**
     * Scope a query to only return non draft Invoices
     *
     * @param \Illuminate\Database\Eloquent\Builder  $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNonDraft($query)
    {
        $query->where('status', '!=', self::STATUS_DRAFT);
    }

    /**
     * Scope a query to only return unpaid Invoices
     *
     * @param \Illuminate\Database\Eloquent\Builder  $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUnpaid($query)
    {
        $query->where('paid_status', '<>', self::STATUS_PAID);
    }

    /**
     * Scope a query to only return Invoices which has invoice_date
     * greater or equal then given date
     *
     * @param \Illuminate\Database\Eloquent\Builder  $query
     * @param Date $from
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFrom($query, $from)
    {
        $query->where('invoice_date', '>=', $from);
    }

    /**
     * Scope a query to only return Invoices which has invoice_date
     * less or equal then given date
     *
     * @param \Illuminate\Database\Eloquent\Builder  $query
     * @param Date $to
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTo($query, $to)
    {
        $query->where('invoice_date', '<=', $to);
    }
}
