<?php

namespace App\Models;

use App\Traits\HasTax;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasTax;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice_id',
        'product_id',
        'description',
        'company_id',
        'quantity',
        'price',
        'discount_type',
        'discount_val',
        'total',
    ];

    /**
     * Automatically cast attributes to given types
     * 
     * @var array
     */
    protected $casts = [
        'price' => 'integer',
        'total' => 'integer',
        'quantity' => 'float',
        'discount_val' => 'integer',
    ];

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
     * Define Relation with Product Model
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the Total Percentage of Invoice Item Taxes
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
     * Scope a query to only include Invoice Items of a given company.
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
