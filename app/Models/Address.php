<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'model', 
        'role', 
        'name',
        'address_1',
        'address_2',
        'country_id',
        'city',
        'state',
        'zip',
        'phone',
        'lat',
        'lng'
    ];

    /**
     * Define Relation with Addressable Model
     * 
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function model()
    {
        return $this->morphTo();
    }

    /**
     * Define Relation with Country Model
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Change the role of the current address model.
     *
     * @param string $role
     *
     * @return bool
     */
    public function role(string $role)
    {
        return $this->update(compact('role'));
    }
}
