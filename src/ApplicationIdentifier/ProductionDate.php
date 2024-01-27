<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\ApplicationIdentifier;

use Janisvepris\Gs1Decoder\ApplicationIdentifier\Abstract\DateIdentifier;

class ProductionDate extends DateIdentifier
{
    public const CODE = '11';
    protected string $code = self::CODE;
    protected string $englishTitle = 'Production date';
}
