<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\ApplicationIdentifier;

use Janisvepris\Gs1Decoder\ApplicationIdentifier\Abstract\SimpleIdentifier;

class PurchasedFromGln extends SimpleIdentifier
{
    public const CODE = '412';

    protected string $code = self::CODE;
    protected int $length = 13;
    protected string $englishTitle = 'Purchased from Global Location Number (GLN)';
}
