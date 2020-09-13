<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /**
     * Define Relation with Address Model
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function address()
    {
        return $this->hasMany(Address::class);
    }

    /**
     * List Countries for Select2 Javascript Library
     * 
     * @return collect
     */
    public static function getSelect2Array() {
        return self::select('id', 'name AS text')->get();
    }
}
