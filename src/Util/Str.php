<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\Util;

final class Str
{
    public static function shift(string &$string, int $length = 1): string
    {
        $slice = substr($string, 0, $length);

        $string = substr($string, $length);

        return $slice;
    }
}
