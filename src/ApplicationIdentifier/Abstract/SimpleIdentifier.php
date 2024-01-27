<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\ApplicationIdentifier\Abstract;

abstract class SimpleIdentifier extends BaseIdentifier
{
    protected string $code;
    protected int $length;
    protected string $englishTitle;
    protected string $value;

    public function setValue(string $value): self
    {
        $this->setRawValue($value);

        $this->value = $value;

        return $this;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function getEnglishTitle(): string
    {
        return $this->englishTitle;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    // @return array<string, string>
}
