<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaxType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'percent',
        'company_id',
        'description'
    ];

    /**
     * Automatically cast attributes to given types
     * 
     * @var array
     */
    protected $casts = [
        'percent' => 'float'
    ];

    /**
     * Define Relation with Tax Model
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function taxes()
    {
        return $this->hasMany(Tax::class);
    }

    /**
     * List Tax Types for Select2 Javascript Library
     * 
     * @return collect
     */
    public static function getSelect2Array($company_id) {
        // return
        return self::findByCompany($company_id)
            ->select('id', 'name AS text', 'percent')
            ->get();
    }

    /**
     * Scope a query to only include Tax Types of a given company.
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
