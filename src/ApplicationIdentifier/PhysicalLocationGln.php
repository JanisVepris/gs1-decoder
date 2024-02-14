<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\ApplicationIdentifier;

use Janisvepris\Gs1Decoder\ApplicationIdentifier\Abstract\SimpleIdentifier;

class PhysicalLocationGln extends SimpleIdentifier
{
    public const CODE = '414';

    protected string $code = self::CODE;
    protected int $length = 13;
    protected string $englishTitle = 'Identification of a physical location - Global Location Number (GLN)';
}
