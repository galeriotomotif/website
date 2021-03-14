<?php

namespace App\Helpers;

class SlugHelper
{
    public static function make($string)
    {
        $string=strtolower($string);
        $string = preg_replace('/[^A-Za-z0-9\ ]/', "", $string);
        $string=explode(' ', $string);
        $string=array_filter($string);
        $string=implode(" ", $string);
        $string = str_replace(" ", '-', $string);

        return $string;
    }

}
