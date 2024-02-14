<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\ApplicationIdentifier;

use Janisvepris\Gs1Decoder\ApplicationIdentifier\Abstract\SimpleIdentifier;

class CountryOfOrigin extends SimpleIdentifier
{
    public const CODE = '422';

    protected string $code = self::CODE;
    protected int $length = 3;
    protected string $englishTitle = 'Country of origin of a trade item';
}
