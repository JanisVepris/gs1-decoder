<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\ApplicationIdentifier;

use Janisvepris\Gs1Decoder\ApplicationIdentifier\Abstract\DateIdentifier;

class SellByDate extends DateIdentifier
{
    public const CODE = '16';
    protected string $code = self::CODE;
    protected string $englishTitle = 'Sell by date';
}
