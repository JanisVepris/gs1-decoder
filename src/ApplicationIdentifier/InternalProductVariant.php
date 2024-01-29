<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\ApplicationIdentifier;

use Janisvepris\Gs1Decoder\ApplicationIdentifier\Abstract\SimpleIdentifier;

class InternalProductVariant extends SimpleIdentifier
{
    public const CODE = '20';

    protected string $code = self::CODE;
    protected int $length = 2;
    protected string $englishTitle = 'Internal product variant';
}
