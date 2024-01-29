<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\ApplicationIdentifier;

use Janisvepris\Gs1Decoder\ApplicationIdentifier\Abstract\DateIdentifier;

class DueDate extends DateIdentifier
{
    public const CODE = '12';
    protected string $code = self::CODE;
    protected string $englishTitle = 'Due date';
}
