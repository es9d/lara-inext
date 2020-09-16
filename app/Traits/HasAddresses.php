<?php

namespace App\Traits;

use App\Models\Address;
use App\Service\AddressFormat\AddressFormat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasAddresses
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function addresses(): MorphMany
    {
        return $this->morphMany(Address::class, 'model');
    }

    /**
     * @param string $role
     * @param array $address
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function address(string $role, $address)
    {
        if (is_array($address) && $address['name'] != null && $address['country_id'] != null) {
            $address = $this->addresses()->create($address);
        }

        if ($address instanceof Model) {
            $address->role($role);
        }

        return $this->addresses()->whereRole($role)->first();
    }

    /**
     * @param string $role
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function updateAddress(string $role, $address = null)
    {
        return $this->hasAddress($role)
            ? $this->addresses()->whereRole($role)->update($address)
            : $this->address($role, $address);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function getAddressAttribute(): ?Model
    {
        return $this->hasAddress('main') 
            ? $this->addresses()->whereRole('main')->first()
            : new Address();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function getBillingAttribute(): ?Model
    {
        return $this->hasAddress('billing') 
            ? $this->addresses()->whereRole('billing')->first()
            : new Address();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function getShippingAttribute(): ?Model
    {
        return $this->hasAddress('shipping') 
            ? $this->addresses()->whereRole('shipping')->first()
            : new Address();
    }

    /**
     * @param string $role
     *
     * @return bool
     */
    public function hasAddress(string $role): bool
    {
        return !empty($this->address($role, null));
    }

    /**
     * @return string
     */
    public function displayShortAddress(string $role)
    { 
        $address = $this->addresses()->whereRole($role)->first();
        if(!$address){
            return '';
        }
        $attributes = $address->getAttributes();
        //when attributes is null
        if(!$attributes){
            return '';
        }
        $city = $address['city'] ?? '';
        $state = $address['state'] ? $address['state'] . ', ' : '';
        $country = $address['country']['name'];
        

        return "{$city} {$state}{$country}";
    }

    /**
     * @return string
     */
    public function displayLongAddress(string $role)
    {
        $address = $this->addresses()->whereRole($role)->first();
        //when address is null
        if(!$address){
            return '';
        }
        $attributes = $address->getAttributes();
        //when attributes is null
        if(!$attributes){
            return '';
        }
        //when attributes isn't null
        $address_1 = $attributes['address_1'] ?? '';
        $city = $attributes['city'] ?? '';
        $state = $attributes['state'] ? $attributes['state'].', ': '';
        $country = $address['country']['name'];

        return "{$address_1} {$city} {$state} {$country}";
    }
}