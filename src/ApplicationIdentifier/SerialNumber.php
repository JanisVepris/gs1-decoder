<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\ApplicationIdentifier;

use Janisvepris\Gs1Decoder\ApplicationIdentifier\Abstract\VariableLengthIdentifier;

class SerialNumber extends VariableLengthIdentifier
{
    public const CODE = '21';

    protected string $code = self::CODE;
    protected int $minLength = 1;
    protected int $maxLength = 20;

    protected string $englishTitle = 'Serial number';

    public function getLength(): int
    {
        return $this->getMaxLength();
    }
}
