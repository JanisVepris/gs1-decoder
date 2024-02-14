<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\ApplicationIdentifier;

use Janisvepris\Gs1Decoder\ApplicationIdentifier\Abstract\SimpleIdentifier;

class ProductionOrServiceGln extends SimpleIdentifier
{
    public const CODE = '416';

    protected string $code = self::CODE;
    protected int $length = 13;
    protected string $englishTitle = 'Global Location Number (GLN) of the production or service location';
}
