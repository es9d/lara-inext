<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tax_type_id',
    ];

    /**
     * Define Relation with TaxType Model
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tax_type()
    {
        return $this->belongsTo(TaxType::class);
    }

    /**
     * Define Relation with Taxable Morph Model
     * 
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function taxable()
    {
        return $this->morphTo();
    }    
}
