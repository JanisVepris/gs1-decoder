<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\ApplicationIdentifier\Abstract;

use Janisvepris\Gs1Decoder\ApplicationIdentifier\Contract\DecimalIdentifierInterface;
use Janisvepris\Gs1Decoder\Exception\Identifier\DecimalIdentifierException;

abstract class DecimalIdentifier extends BaseIdentifier implements DecimalIdentifierInterface
{
    protected float $value;
    protected int $length;
    protected int $decimalPosition;

    public function getRawValue(): string
    {
        return $this->rawValue;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        if (!isset($this->decimalPosition)) {
            throw DecimalIdentifierException::valueWithoutDecimalPosition();
        }

        $this->setRawValue($value);

        $this->value = ((float) $value) / (10 ** $this->decimalPosition);

        return $this;
    }

    public function setDecimalPosition(int $decimalPosition): self
    {
        $this->decimalPosition = $decimalPosition;

        return $this;
    }

    public function getDecimalPosition(): int
    {
        if (!isset($this->decimalPosition)) {
            throw DecimalIdentifierException::noDecimalPositionValue();
        }

        return $this->decimalPosition;
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function toArray(): array
    {
        return array_merge(parent::toArray(), [
            'decimalPosition' => $this->getDecimalPosition(),
        ]);
    }
}
