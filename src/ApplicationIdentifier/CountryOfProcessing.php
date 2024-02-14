<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\ApplicationIdentifier;

use Janisvepris\Gs1Decoder\ApplicationIdentifier\Abstract\SimpleIdentifier;

class CountryOfProcessing extends SimpleIdentifier
{
    public const CODE = '424';

    protected string $code = self::CODE;
    protected int $length = 3;
    protected string $englishTitle = 'Country of processing';
}
