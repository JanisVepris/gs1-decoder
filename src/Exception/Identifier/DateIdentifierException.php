<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\Exception\Identifier;

use Janisvepris\Gs1Decoder\Exception\Gs1DecoderException;

class DateIdentifierException extends Gs1DecoderException
{
    public static function couldNotParseDateIdentifier(string $identifierCode, string $rawValue): self
    {
        return new self('Could not parse date identifier: '.$identifierCode.' with value: '.$rawValue);
    }
}
