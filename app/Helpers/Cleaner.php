<?php

namespace App\Helpers;

class Cleaner
{
    public static function filter($value)
    {
        if(is_array($value))
        {
            foreach($value as $key => $str)
            {
                $data[$key] = htmlspecialchars(strip_tags(stripslashes(trim($str))));
            }
            return $data;
        } else return htmlspecialchars(strip_tags(stripslashes(trim($value))));
    }
}
