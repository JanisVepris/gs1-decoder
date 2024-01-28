<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\ApplicationIdentifier;

use Janisvepris\Gs1Decoder\ApplicationIdentifier\Abstract\DateIdentifier;

class ExpirationDate extends DateIdentifier
{
    public const CODE = '17';
    protected string $code = self::CODE;
    protected string $englishTitle = 'Expiration date';
}
