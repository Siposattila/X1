<?php

namespace App\Helper;

class UniqueIdHelper
{
    public static function uniqueId(int $length = 5): string
    {
        return substr(md5(date("Y.m.d. H:i:s").strval(rand(PHP_INT_MIN, PHP_INT_MAX))), $length/2, $length);
    }
}
