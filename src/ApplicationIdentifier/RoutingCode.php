<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\ApplicationIdentifier;

use Janisvepris\Gs1Decoder\ApplicationIdentifier\Abstract\VariableLengthIdentifier;

class RoutingCode extends VariableLengthIdentifier
{
    public const CODE = '403';

    protected string $code = self::CODE;
    protected int $minLength = 1;
    protected int $maxLength = 30;
    protected string $englishTitle = 'Routing code (Route)';
}
