<?php

namespace App\Models;

use App\Traits\HasTax;
use App\Traits\UUIDTrait;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Product extends Model
{
    use HasTax;
    use UUIDTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'unit_id',
        'price',
        'company_id',
        'description',
    ];

    /**
     * Automatically cast attributes to given types
     * 
     * @var array
     */
    protected $casts = [
        'price' => 'integer'
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
     * Define Relation with ProductUnit Model
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function unit()
    {
        return $this->belongsTo(ProductUnit::class);
    }

    /**
     * Define Relation with InvoiceItem Model
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invoice_items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    /**
     * Define Relation with EstimateItem Model
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function estimate_items()
    {
        return $this->hasMany(EstimateItem::class);
    }

    /**
     * Set currency_code attribute from company
     *
     * @return string
     */
    public function getCurrencyCodeAttribute($value)
    {
        return $this->company->currency->code;
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
     * Scope a query to only include Products of a given company.
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
