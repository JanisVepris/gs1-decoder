<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\IdentifierMap;

use Janisvepris\Gs1Decoder\ApplicationIdentifier;
use Janisvepris\Gs1Decoder\IdentifierMap\Abstract\AbstractIdentifierMap;

final class IdentifierMap extends AbstractIdentifierMap
{
    /** @param null|array<int|string, string> $map */
    public function __construct(?array $map = null)
    {
        $this->map = $map ?? [
            ApplicationIdentifier\Sscc::CODE => ApplicationIdentifier\Sscc::class,
            ApplicationIdentifier\Gtin::CODE => ApplicationIdentifier\Gtin::class,
            ApplicationIdentifier\GtinTradeItems::CODE => ApplicationIdentifier\GtinTradeItems::class,

            ApplicationIdentifier\BatchOrLotNumber::CODE => ApplicationIdentifier\BatchOrLotNumber::class,
            ApplicationIdentifier\ProductionDate::CODE => ApplicationIdentifier\ProductionDate::class,
            ApplicationIdentifier\DueDate::CODE => ApplicationIdentifier\DueDate::class,
            ApplicationIdentifier\ExpirationDate::CODE => ApplicationIdentifier\ExpirationDate::class,

            ApplicationIdentifier\SerialNumber::CODE => ApplicationIdentifier\SerialNumber::class,

            ApplicationIdentifier\NetWeightKg::CODE => ApplicationIdentifier\NetWeightKg::class,
            ApplicationIdentifier\NetWeightPounds::CODE => ApplicationIdentifier\NetWeightPounds::class,
        ];
    }
}
