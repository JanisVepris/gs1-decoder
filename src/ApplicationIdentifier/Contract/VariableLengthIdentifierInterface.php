<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\ApplicationIdentifier\Contract;

interface VariableLengthIdentifierInterface
{
    public function getMaxLength(): int;

    public function getMinLength(): int;
}
