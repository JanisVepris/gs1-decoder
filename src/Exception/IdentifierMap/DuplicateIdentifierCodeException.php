<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\Exception\IdentifierMap;

use Janisvepris\Gs1Decoder\Exception\Gs1DecoderException;

class DuplicateIdentifierCodeException extends Gs1DecoderException
{
    public function __construct(string $identifierCode)
    {
        parent::__construct(sprintf('Identifier code "%s" already exists in map.', $identifierCode));
    }
}
