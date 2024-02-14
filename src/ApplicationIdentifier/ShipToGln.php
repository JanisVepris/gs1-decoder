<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\ApplicationIdentifier;

use Janisvepris\Gs1Decoder\ApplicationIdentifier\Abstract\SimpleIdentifier;

class ShipToGln extends SimpleIdentifier
{
    public const CODE = '410';

    protected string $code = self::CODE;
    protected int $length = 13;
    protected string $englishTitle = 'Ship to / Deliver to Global Location Number (GLN)';
}
