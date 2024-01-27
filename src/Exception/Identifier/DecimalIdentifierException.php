<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\Exception\Identifier;

use Janisvepris\Gs1Decoder\Exception\Gs1DecoderException;

class DecimalIdentifierException extends Gs1DecoderException
{
    public static function valueWithoutDecimalPosition(): self
    {
        return new self('Decimal point position must be set before setting decimal identifier value.');
    }

    public static function noDecimalPositionValue(): self
    {
        return new self('Cannot retriece decimal point position. No value has been set.');
    }
}
