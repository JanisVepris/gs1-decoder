<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\ApplicationIdentifier;

use Janisvepris\Gs1Decoder\ApplicationIdentifier\Abstract\DecimalIdentifier;

class GrossWeightPounds extends DecimalIdentifier
{
    public const CODE = '340';
    protected string $code = self::CODE;
    protected string $englishTitle = 'Gross weight, Pounds';
    protected int $length = 6;
}
