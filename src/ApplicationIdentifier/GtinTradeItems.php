<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\ApplicationIdentifier;

use Janisvepris\Gs1Decoder\ApplicationIdentifier\Abstract\SimpleIdentifier;

class GtinTradeItems extends SimpleIdentifier
{
    public const CODE = '02';

    protected string $code = self::CODE;
    protected int $length = 14;
    protected string $englishTitle = 'Global Trade Item Number (GTIN) of contained trade items';
}
