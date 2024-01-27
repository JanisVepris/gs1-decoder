<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\ApplicationIdentifier\Abstract;

use Janisvepris\Gs1Decoder\ApplicationIdentifier\Contract\VariableLengthIdentifierInterface;

abstract class VariableLengthIdentifier extends BaseIdentifier implements VariableLengthIdentifierInterface
{
    protected string $code;
    protected int $minLength;
    protected int $maxLength;
    protected string $value;

    public function getValue(): string
    {
        return $this->value;
    }

    public function getMaxLength(): int
    {
        return $this->maxLength;
    }

    public function getMinLength(): int
    {
        return $this->minLength;
    }

    public function setValue(string $value): self
    {
        $this->setRawValue($value);

        $this->value = $value;

        return $this;
    }
}
