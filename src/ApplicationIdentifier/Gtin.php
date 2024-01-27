<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\ApplicationIdentifier;

use Janisvepris\Gs1Decoder\ApplicationIdentifier\Abstract\SimpleIdentifier;

class Gtin extends SimpleIdentifier
{
    public const CODE = '01';

    protected string $code = self::CODE;
    protected int $length = 14;
    protected string $englishTitle = 'Global Trade Item Number (GTIN)';
}
