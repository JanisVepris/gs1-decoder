<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\ApplicationIdentifier;

use Janisvepris\Gs1Decoder\ApplicationIdentifier\Abstract\SimpleIdentifier;

class GtinMadeToOrder extends SimpleIdentifier
{
    public const CODE = '03';

    protected string $code = self::CODE;
    protected int $length = 14;
    protected string $englishTitle = 'Identification of a Made-to-Order (MtO) trade item (GTIN)';
}
