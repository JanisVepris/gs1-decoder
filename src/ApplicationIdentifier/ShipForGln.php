<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\ApplicationIdentifier;

use Janisvepris\Gs1Decoder\ApplicationIdentifier\Abstract\SimpleIdentifier;

class ShipForGln extends SimpleIdentifier
{
    public const CODE = '413';

    protected string $code = self::CODE;
    protected int $length = 13;
    protected string $englishTitle = 'Ship for / Deliver for - Forward to Global Location Number (GLN)';
}
