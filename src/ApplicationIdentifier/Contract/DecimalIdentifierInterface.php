<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\ApplicationIdentifier\Contract;

interface DecimalIdentifierInterface extends ApplicationIdentifierInterface
{
    public function getValue(): float;

    public function setDecimalPosition(int $decimalPosition): self;

    public function getDecimalPosition(): int;
}
