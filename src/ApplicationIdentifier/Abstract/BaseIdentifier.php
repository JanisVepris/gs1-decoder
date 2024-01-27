<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\ApplicationIdentifier\Abstract;

use Janisvepris\Gs1Decoder\ApplicationIdentifier\Contract\ApplicationIdentifierInterface;

abstract class BaseIdentifier implements ApplicationIdentifierInterface
{
    protected string $code;
    protected string $englishTitle;
    protected string $rawValue;

    public function getRawValue(): string
    {
        return $this->rawValue;
    }

    public function getEnglishTitle(): string
    {
        return $this->englishTitle;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function toArray(): array
    {
        return [
            'code' => $this->getCode(),
            'value' => $this->getValue(),
            'rawValue' => $this->getRawValue(),
            'englishTitle' => $this->getEnglishTitle(),
        ];
    }

    protected function setRawValue(string $rawValue): self
    {
        $this->rawValue = $rawValue;

        return $this;
    }
}
