<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    /**
     * Set new or update existing System Settings.
     *
     * @param string $key
     * @param string $setting
     *
     * @return void
     */
    public static function setSetting($key, $setting)
    {
        $old = self::whereOption($key)->first();

        if ($old) {
            $old->value = $setting;
            $old->save();
            return;
        }

        $set = new SystemSetting();
        $set->option = $key;
        $set->value = $setting;
        $set->save();
    }
 
    /**
     * Get System Setting.
     *
     * @param string $key
     *
     * @return string|null
     */
    public static function getSetting($key)
    {
        $setting = static::whereOption($key)->first();

        if ($setting) {
            return $setting->value;
        } else {
            return null;
        }
    }
}
