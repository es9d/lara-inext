<?php

namespace App\Models;

use App\Traits\HasAddresses;
use App\Traits\UUIDTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customer extends Model
{
    use HasAddresses;
    use UUIDTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'display_name',
        'contact_name',
        'email',
        'phone',
        'website',
        'currency_id',
        'is_same_billandship',
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
     * Define Relation with Currency Model
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    /**
     * Define Relation with Estimate Model
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function estimates()
    {
        return $this->hasMany(Estimate::class);
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
     * Define Relation with Invoice Model
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    /**
     * Get invoice_due_amount attribute
     * 
     * @return int
     */
    public function getInvoiceDueAmountAttribute()
    {
        return $this->invoices()->sum('due_amount');
    }

    /**
     * Scope a query to only include Customers of a given company.
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
     * Scope a query to only include Customers who has unpaid invoice
     *
     * @param \Illuminate\Database\Eloquent\Builder  $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeHasUnpaid($query)
    {
        $query->whereHas('invoices', function ($q) {
            $q->where('due_amount', '>', 0);
        });
    }
}
