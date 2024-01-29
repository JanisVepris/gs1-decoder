<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\ApplicationIdentifier;

use Janisvepris\Gs1Decoder\ApplicationIdentifier\Abstract\DateIdentifier;

class BestBeforeDate extends DateIdentifier
{
    public const CODE = '15';
    protected string $code = self::CODE;
    protected string $englishTitle = 'Best before date';
}
