<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\ApplicationIdentifier\Contract;

use DateTime;

interface ApplicationIdentifierInterface
{
    public function getValue(): DateTime|float|string;

    public function getRawValue(): string;

    public function setValue(string $value): self;

    public function getEnglishTitle(): string;

    public function getCode(): string;

    public function getLength(): int;

    /**
     * @return array{
     *     code: string,
     *     value: float|string,
     *     rawValue: string,
     *     englishTitle: string,
     * }
     */
    public function toArray(): array;
}
