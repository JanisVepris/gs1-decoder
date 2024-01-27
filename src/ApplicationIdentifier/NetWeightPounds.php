<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\ApplicationIdentifier;

use Janisvepris\Gs1Decoder\ApplicationIdentifier\Abstract\DecimalIdentifier;

class NetWeightPounds extends DecimalIdentifier
{
    public const CODE = '320';
    protected string $code = self::CODE;
    protected string $englishTitle = 'Net weight, Pounds';
    protected int $length = 6;
}
