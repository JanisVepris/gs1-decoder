<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\Test\Integration\Barcode;

use Janisvepris\Gs1Decoder\ApplicationIdentifier\ExpirationDate;
use Janisvepris\Gs1Decoder\ApplicationIdentifier\Gtin;
use Janisvepris\Gs1Decoder\ApplicationIdentifier\NetWeightKg;
use Janisvepris\Gs1Decoder\ApplicationIdentifier\SerialNumber;
use Janisvepris\Gs1Decoder\Decoder\Decoder;
use PHPUnit\Framework\TestCase;

class BarcodeTest extends TestCase
{
    public function testToArray(): void
    {
        $gtin = Gtin::CODE.'12345678901234';
        $netWeight = NetWeightKg::CODE.'1999999';
        $serialNumber = SerialNumber::CODE.'13128738[FNC1]';
        $expirationDate = ExpirationDate::CODE.'210124';

        $input = $gtin.$netWeight.$serialNumber.$expirationDate;

        $subject = (new Decoder())->decode($input);

        $result = $subject->toArray();

        static::assertArrayHasKey('barcode', $result);
        static::assertSame($input, $result['barcode']);

        static::assertArrayHasKey('identifiers', $result);
        static::assertCount(4, $result['identifiers']);
    }
}
