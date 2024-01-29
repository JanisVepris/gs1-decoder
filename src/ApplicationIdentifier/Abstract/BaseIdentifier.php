<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\ApplicationIdentifier\Abstract;

use DateTime;
use DateTimeInterface;
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
        $value = $this->getValue();

        if ($value instanceof DateTime) {
            $value = $value->format(DateTimeInterface::ATOM);
        }

        return [
            'code' => $this->getCode(),
            'value' => $value,
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
