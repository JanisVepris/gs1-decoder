<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\ApplicationIdentifier\Abstract;

use DateTime;
use Janisvepris\Gs1Decoder\ApplicationIdentifier\Contract\DateIdentifierInterface;
use Janisvepris\Gs1Decoder\Exception\Identifier\DateIdentifierException;

abstract class DateIdentifier extends BaseIdentifier implements DateIdentifierInterface
{
    protected DateTime $value;

    public function getValue(): DateTime
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->setRawValue($value);

        $endOfMonth = false;

        if (str_ends_with($value, '00')) {
            $value = substr($value, 0, -2).'01';
            $endOfMonth = true;
        }

        $value = DateTime::createFromFormat('ymd', $value);

        if (false === $value) {
            throw DateIdentifierException::couldNotParseDateIdentifier($this->getCode(), $this->getRawValue());
        }

        if ($endOfMonth) {
            $value->modify('last day of this month');
        }

        $value->setTime(24 - 1, 60 - 1, 60 - 1, 1000000 - 1);

        $this->value = $value;

        return $this;
    }

    public function getLength(): int
    {
        return 6;
    }
}
