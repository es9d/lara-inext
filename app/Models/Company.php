<?php

namespace App\Models;

use App\Traits\HasAddresses;
use App\Traits\UUIDTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Company extends Model implements HasMedia
{
    use HasAddresses;
    use HasMediaTrait;
    use UUIDTrait;
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'owner_id',
    ]; 
    
    /**
     * Define Relation with User Model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('\App\Models\User', 'company_user', 'company_id', 'user_id')->withTimestamps();
    }

    /**
     * Define Relation with Addressable Model
     * This indicates the owner of the company
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Helper function to determine if a user is part
     * of this company
     *
     * @param User $user
     * 
     * @return bool
     */
    public function hasUser(User $user)
    {
        return $this->users()->where($user->getKeyName(), $user->getKey())->first() ? true : false;
    }

    /**
     * Define Relation with CompanySetting Model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function settings()
    {
        return $this->hasMany(CompanySetting::class);
    }

    /**
     * Get Company Specified setting
     *
     * @param string $key
     * 
     * @return string
     */
    public function getSetting($key)
    {
        return CompanySetting::getSetting($key, $this->id);
    }

    /**
     * Set Company Specified setting
     *
     * @param string $key
     * @param string $value
     * 
     * @return void
     */
    public function setSetting($key, $value)
    {
        return CompanySetting::setSetting($key, $value, $this->id);
    }

    /**
     * Get Currency Attribute
     * 
     * @return string
     */
    public function getCurrencyAttribute($value)
    {
        return Currency::find($this->getSetting('currency_id'));
    }

    /**
     * Check if Paypal Gateway is Active
     * 
     * @return boolean
     */
    public function isPaypalActive()
    {   
        if (
            $this->getSetting('paypal_active') 
            && $this->getSetting('paypal_username') != ''
            && $this->getSetting('paypal_password') != ''
            && $this->getSetting('paypal_signature') != ''
        ) 
            return true;
        else 
            return false;
    }

    /**
     * Check if Stripe Gateway is Active
     * 
     * @return boolean
     */
    public function isStripeActive()
    {
        if (
            $this->getSetting('stripe_active') 
            && $this->getSetting('stripe_secret_key') != ''
            && $this->getSetting('stripe_public_key') != ''
        ) 
            return true;
        else 
            return false;
    }

     /**
     * Check if Razorpay Gateway is Active
     * 
     * @return boolean
     */
    public function isRazorpayActive()
    {
        if (
            $this->getSetting('razorpay_active') 
            && $this->getSetting('razorpay_id') != ''
            && $this->getSetting('razorpay_secret_key') != ''
        ) 
            return true;
        else 
            return false;
    }

    /**
     * Define MediaCollection to SingleFile
     *
     * @return
     */
    public function registerMediaCollections()
    {
        $this->addMediaCollection('avatar')->singleFile();
    }

    /**
     * Return Default Company Avatar Url
     * 
     * @return string (url)
     */
    public function getDefaultAvatar()
    {
        return asset('assets/images/avatar/company.png');
    }

    /**
     * Get User's Company Url || Default Avatar
     * 
     * @return string (url)
     */
    public function getAvatarAttribute()
    {
        return $this->getFirstMedia('avatar')
            ? $this->getFirstMedia('avatar')->getFullUrl() 
            : $this->getDefaultAvatar();
    }
}
