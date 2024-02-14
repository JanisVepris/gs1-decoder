<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\ApplicationIdentifier;

use Janisvepris\Gs1Decoder\ApplicationIdentifier\Abstract\DecimalIdentifier;

class GrossWeightKg extends DecimalIdentifier
{
    public const CODE = '330';
    protected string $code = self::CODE;
    protected string $englishTitle = 'Gross weight, KG';
    protected int $length = 6;
}
