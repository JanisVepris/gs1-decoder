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
            ApplicationIdentifier\GtinMadeToOrder::CODE => ApplicationIdentifier\GtinMadeToOrder::class,
            ApplicationIdentifier\BatchOrLotNumber::CODE => ApplicationIdentifier\BatchOrLotNumber::class,

            ApplicationIdentifier\ProductionDate::CODE => ApplicationIdentifier\ProductionDate::class,
            ApplicationIdentifier\DueDate::CODE => ApplicationIdentifier\DueDate::class,
            ApplicationIdentifier\PackagingDate::CODE => ApplicationIdentifier\PackagingDate::class,
            ApplicationIdentifier\BestBeforeDate::CODE => ApplicationIdentifier\BestBeforeDate::class,
            ApplicationIdentifier\SellByDate::CODE => ApplicationIdentifier\SellByDate::class,
            ApplicationIdentifier\ExpirationDate::CODE => ApplicationIdentifier\ExpirationDate::class,

            ApplicationIdentifier\InternalProductVariant::CODE => ApplicationIdentifier\InternalProductVariant::class,
            ApplicationIdentifier\SerialNumber::CODE => ApplicationIdentifier\SerialNumber::class,
            ApplicationIdentifier\ConsumerProductVariant::CODE => ApplicationIdentifier\ConsumerProductVariant::class,

            ApplicationIdentifier\NetWeightKg::CODE => ApplicationIdentifier\NetWeightKg::class,
            ApplicationIdentifier\NetWeightPounds::CODE => ApplicationIdentifier\NetWeightPounds::class,
            ApplicationIdentifier\GrossWeightKg::CODE => ApplicationIdentifier\GrossWeightKg::class,
            ApplicationIdentifier\GrossWeightPounds::CODE => ApplicationIdentifier\GrossWeightPounds::class,

            ApplicationIdentifier\OrderNumber::CODE => ApplicationIdentifier\OrderNumber::class,
            ApplicationIdentifier\Gsin::CODE => ApplicationIdentifier\Gsin::class,
            ApplicationIdentifier\RoutingCode::CODE => ApplicationIdentifier\RoutingCode::class,

            ApplicationIdentifier\ShipToGln::CODE => ApplicationIdentifier\ShipToGln::class,
            ApplicationIdentifier\BillToGln::CODE => ApplicationIdentifier\BillToGln::class,
            ApplicationIdentifier\PurchasedFromGln::CODE => ApplicationIdentifier\PurchasedFromGln::class,
            ApplicationIdentifier\ShipForGln::CODE => ApplicationIdentifier\ShipForGln::class,
            ApplicationIdentifier\PhysicalLocationGln::CODE => ApplicationIdentifier\PhysicalLocationGln::class,
            ApplicationIdentifier\InvoicingPartyGln::CODE => ApplicationIdentifier\InvoicingPartyGln::class,
            ApplicationIdentifier\ProductionOrServiceGln::CODE => ApplicationIdentifier\ProductionOrServiceGln::class,
            ApplicationIdentifier\PartyGln::CODE => ApplicationIdentifier\PartyGln::class,

            ApplicationIdentifier\CountryOfOrigin::CODE => ApplicationIdentifier\CountryOfOrigin::class,
            ApplicationIdentifier\CountryOfInitialProcessing::CODE => ApplicationIdentifier\CountryOfInitialProcessing::class,
            ApplicationIdentifier\CountryOfProcessing::CODE => ApplicationIdentifier\CountryOfProcessing::class,
            ApplicationIdentifier\CountryOfDisassembly::CODE => ApplicationIdentifier\CountryOfDisassembly::class,
        ];
    }
}
