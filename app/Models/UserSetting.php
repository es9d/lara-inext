<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 
        'option', 
        'value'
    ];

    /**
     * Default User Settings
     * 
     * @var array
     */
    public static $defaultSettings = [
        'notification_invoice_sent' => true,
        'notification_invoice_viewed' => true,
        'notification_invoice_paid' => true,
        'notification_estimate_sent' => true,
        'notification_estimate_viewed' => true,
        'notification_estimate_approved_or_rejected' => true,
        'locale'=>'en',
    ];
 
    /**
     * Define Relation with User Model
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Set New or Update Existing User Settings.
     *
     * @param string $key
     * @param string $setting
     * @param string $user_id
     *
     * @return void
     */
    public static function setSetting($key, $setting, $user_id): void
    {
        $old = self::whereOption($key)->findByUser($user_id)->first();

        if ($old) {
            $old->value = $setting;
            $old->save();
            return;
        }

        $set = new UserSetting();
        $set->option = $key;
        $set->value = $setting;
        $set->user_id = $user_id;
        $set->save();
    }

    /**
     * Get Default User Setting.
     *
     * @param string $key
     *
     * @return string|null
     */
    public static function getDefaultSetting($key)
    {
        $setting = self::$defaultSettings[$key];

        if ($setting) {
            return $setting;
        } else {
            return null;
        }
    }
    
    /**
     * Get User Setting || User Default Settings
     *
     * @param string $key
     * @param string $user_id
     *
     * @return string|null
     */
    public static function getSetting($key, $user_id)
    {
        $setting = static::whereOption($key)->findByUser($user_id)->first();

        if ($setting) {
            return $setting->value;
        } else {
            return self::getDefaultSetting($key);
        }
    }

    /**
     * Scope a query to only include settings of a given user.
     *
     * @param \Illuminate\Database\Eloquent\Builder  $query
     * @param int $user_id
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFindByUser($query, $user_id)
    {
        $query->where('user_id', $user_id);
    }
}
