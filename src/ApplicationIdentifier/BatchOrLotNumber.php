<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\ApplicationIdentifier;

use Janisvepris\Gs1Decoder\ApplicationIdentifier\Abstract\VariableLengthIdentifier;

class BatchOrLotNumber extends VariableLengthIdentifier
{
    public const CODE = '10';

    protected string $code = self::CODE;
    protected int $minLength = 1;
    protected int $maxLength = 20;
    protected string $englishTitle = 'Batch or lot number';

    public function getLength(): int
    {
        return $this->getMaxLength();
    }
}
