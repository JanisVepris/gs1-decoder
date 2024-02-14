<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\ApplicationIdentifier;

use Janisvepris\Gs1Decoder\ApplicationIdentifier\Abstract\VariableLengthIdentifier;

class CountryOfInitialProcessing extends VariableLengthIdentifier
{
    public const CODE = '423';

    protected string $code = self::CODE;
    protected int $minLength = 3;
    protected int $maxLength = 15;
    protected string $englishTitle = 'Country of initial processing';
}
