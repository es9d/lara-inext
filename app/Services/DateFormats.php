<?php

namespace App\Services;

use Carbon\Carbon;

class DateFormats
{
    protected static $formats = [
        [
            "id" => '1',
            "carbon_format" => "Y M d",
            "moment_format" => "YYYY MMM DD"
        ],
        [
            "id" => '2',
            "carbon_format" => "d M Y",
            "moment_format" => "DD MMM YYYY"
        ],
        [
            "id" => '3',
            "carbon_format" => "d/m/Y",
            "moment_format" => "DD/MM/YYYY"
        ],
        [
            "id" => '4',
            "carbon_format" => "d.m.Y",
            "moment_format" => "DD.MM.YYYY"
        ],
        [
            "id" => '5',
            "carbon_format" => "d-m-Y",
            "moment_format" => "DD-MM-YYYY"
        ],
        [
            "id" => '6',
            "carbon_format" => "m/d/Y",
            "moment_format" => "MM/DD/YYYY"
        ],
        [
            "id" => '7',
            "carbon_format" => "Y/m/d",
            "moment_format" => " YYYY/MM/DD"
        ],
        [
            "id" => '8',
            "carbon_format" => "Y-m-d",
            "moment_format" => "YYYY-MM-DD"
        ],
    ];

    public static function getSelect2Array()
    {
        $dateFormats = collect();
        foreach (static::$formats as $format) {
            $dateFormats->push([
                'id' => $format['carbon_format'],
                'text' => Carbon::now()->format($format['carbon_format']),
            ]); 
        }
        return $dateFormats;
    }
}
