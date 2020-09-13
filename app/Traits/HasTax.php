<?php

namespace App\Traits;

use App\Models\Tax;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasTax
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function taxes(): MorphMany
    {
        return $this->morphMany(Tax::class, 'taxable');
    }

    /** 
     * Check wheater model has tax for given tax type
     * 
     * @return boolean
     */
    public function hasTax($tax_type_id) {
        return $this->taxes()->where('tax_type_id', $tax_type_id)->exists();
    }
} 