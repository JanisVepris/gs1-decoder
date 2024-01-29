<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\ApplicationIdentifier;

use Janisvepris\Gs1Decoder\ApplicationIdentifier\Abstract\DateIdentifier;

class PackagingDate extends DateIdentifier
{
    public const CODE = '13';
    protected string $code = self::CODE;
    protected string $englishTitle = 'Packaging date';
}
