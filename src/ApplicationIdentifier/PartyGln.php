<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\ApplicationIdentifier;

use Janisvepris\Gs1Decoder\ApplicationIdentifier\Abstract\SimpleIdentifier;

class PartyGln extends SimpleIdentifier
{
    public const CODE = '417';

    protected string $code = self::CODE;
    protected int $length = 13;
    protected string $englishTitle = 'Party Global Location Number (GLN)';
}
