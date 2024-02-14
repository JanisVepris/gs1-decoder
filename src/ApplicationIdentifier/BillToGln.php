<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\ApplicationIdentifier;

use Janisvepris\Gs1Decoder\ApplicationIdentifier\Abstract\SimpleIdentifier;

class BillToGln extends SimpleIdentifier
{
    public const CODE = '411';

    protected string $code = self::CODE;
    protected int $length = 13;
    protected string $englishTitle = 'Bill to / Invoice to Global Location Number (GLN)';
}
