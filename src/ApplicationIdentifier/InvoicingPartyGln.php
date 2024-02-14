<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\ApplicationIdentifier;

use Janisvepris\Gs1Decoder\ApplicationIdentifier\Abstract\SimpleIdentifier;

class InvoicingPartyGln extends SimpleIdentifier
{
    public const CODE = '415';

    protected string $code = self::CODE;
    protected int $length = 13;
    protected string $englishTitle = 'Global Location Number (GLN) of the invoicing party';
}
