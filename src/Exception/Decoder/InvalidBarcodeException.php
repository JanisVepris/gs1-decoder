<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\Exception\Decoder;

use Janisvepris\Gs1Decoder\Exception\Gs1DecoderException;

class InvalidBarcodeException extends Gs1DecoderException
{
    public static function notEnoughCharacters(string $identifierCode): self
    {
        return new self('Not enough characters to parse identifier: '.$identifierCode);
    }
}
