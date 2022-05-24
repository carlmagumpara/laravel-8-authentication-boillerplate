<?php

namespace App\Helpers;

class Utils
{
    public static function generateRandomNumbersByRange(int $start = 0, int $end = 20)
    {
        $numbers = range($start, $end);
        shuffle($numbers);
        return array_slice($numbers, 0, 1)[0];
    }

    public static function arrayExclude($array, array $excludeKeys)
    {
        foreach($excludeKeys as $key){
            unset($array[$key]);
        }
        return $array;
    }

    public static function ordinal($number)
    {
        $ends = array('th','st','nd','rd','th','th','th','th','th','th');
        if ((($number % 100) >= 11) && (($number%100) <= 13))
            return $number. 'th';
        else
            return $number. $ends[$number % 10];
    }
}
