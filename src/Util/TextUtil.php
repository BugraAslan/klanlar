<?php

namespace App\Util;

class TextUtil
{
    public static function generateActivationCode()
    {
        $chars = array_merge(range('A', 'Z'), range(1, 9));
        shuffle($chars);

        return substr(implode('', $chars), 0, 6);
    }
}