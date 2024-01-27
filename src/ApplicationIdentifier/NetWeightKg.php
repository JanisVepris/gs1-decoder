<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\ApplicationIdentifier;

use Janisvepris\Gs1Decoder\ApplicationIdentifier\Abstract\DecimalIdentifier;

class NetWeightKg extends DecimalIdentifier
{
    public const CODE = '310';
    protected string $code = self::CODE;
    protected string $englishTitle = 'Net weight, KG';
    protected int $length = 6;
}
