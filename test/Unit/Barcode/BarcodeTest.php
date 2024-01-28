<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\Test\Unit\Barcode;

use Janisvepris\Gs1Decoder\ApplicationIdentifier\Contract\ApplicationIdentifierInterface;
use Janisvepris\Gs1Decoder\Barcode\Barcode;
use PHPUnit\Framework\TestCase;

class BarcodeTest extends TestCase
{
    public function testGetRawValue(): void
    {
        $barcodeValue = '1234567890128';

        $subject = new Barcode($barcodeValue);

        static::assertSame($barcodeValue, $subject->getRawValue());
    }

    public function testAddIdentifier(): void
    {
        $subject = new Barcode('1234567890128');

        $mockIdentifier = static::createMock(ApplicationIdentifierInterface::class);
        $mockIdentifier->method('getCode')->willReturn('01');

        $subject->addIdentifier($mockIdentifier);

        static::assertTrue($subject->hasIdentifier('01'));
    }

    public function testGetIdentifier(): void
    {
        $subject = new Barcode('1234567890128');

        $mockIdentifier = static::createMock(ApplicationIdentifierInterface::class);
        $mockIdentifier->method('getCode')->willReturn('01');

        $subject->addIdentifier($mockIdentifier);

        static::assertSame($mockIdentifier, $subject->getIdentifier('01'));
    }

    public function testHasIdentifier(): void
    {
        $subject = new Barcode('1234567890128');

        $mockIdentifier = static::createMock(ApplicationIdentifierInterface::class);
        $mockIdentifier->method('getCode')->willReturn('01');

        static::assertFalse($subject->hasIdentifier('01'));

        $subject->addIdentifier($mockIdentifier);

        static::assertTrue($subject->hasIdentifier('01'));
        static::assertFalse($subject->hasIdentifier('02'));
    }

    public function testGetAllIdentifiers(): void
    {
        $barcode = new Barcode('1234567890128');

        $mockIdentifier1 = static::createMock(ApplicationIdentifierInterface::class);
        $mockIdentifier1->method('getCode')->willReturn('01');
        $mockIdentifier2 = static::createMock(ApplicationIdentifierInterface::class);
        $mockIdentifier2->method('getCode')->willReturn('02');
        $mockIdentifier3 = static::createMock(ApplicationIdentifierInterface::class);
        $mockIdentifier3->method('getCode')->willReturn('03');

        $barcode
            ->addIdentifier($mockIdentifier1)
            ->addIdentifier($mockIdentifier2)
            ->addIdentifier($mockIdentifier3)
        ;

        static::assertEquals([
            $mockIdentifier1,
            $mockIdentifier2,
            $mockIdentifier3,
        ], $barcode->getAllIdentifiers());
    }
}
