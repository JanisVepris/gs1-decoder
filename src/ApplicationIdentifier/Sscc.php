<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\ApplicationIdentifier;

use Janisvepris\Gs1Decoder\ApplicationIdentifier\Abstract\SimpleIdentifier;

class Sscc extends SimpleIdentifier
{
    public const CODE = '00';

    protected string $code = self::CODE;
    protected int $length = 18;
    protected string $englishTitle = 'Serial Shipping Container Code (SSCC)';
}
