<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\Test\Integration\Decoder;

use DateTime;
use Janisvepris\Gs1Decoder\ApplicationIdentifier\Abstract\DateIdentifier;
use Janisvepris\Gs1Decoder\ApplicationIdentifier\BestBeforeDate;
use Janisvepris\Gs1Decoder\ApplicationIdentifier\ExpirationDate;
use Janisvepris\Gs1Decoder\ApplicationIdentifier\Gtin;
use Janisvepris\Gs1Decoder\ApplicationIdentifier\GtinTradeItems;
use Janisvepris\Gs1Decoder\ApplicationIdentifier\NetWeightKg;
use Janisvepris\Gs1Decoder\ApplicationIdentifier\SerialNumber;
use Janisvepris\Gs1Decoder\ApplicationIdentifier\Sscc;
use Janisvepris\Gs1Decoder\Decoder\Decoder;
use PHPUnit\Framework\TestCase;

class DecoderTest extends TestCase
{
    public function testNoIdentifiers(): void
    {
        $subject = new Decoder();

        $input = '299000000000000000000';

        $result = $subject->decode($input);

        static::assertSame($input, $result->getRawValue());
        static::assertSame(0, $result->getIdentifierCount());
    }

    public function testSimpleIdentifier(): void
    {
        $subject = new Decoder();

        $gtin = '12345678901234';
        $input = '01'.$gtin;

        $result = $subject->decode($input);

        static::assertSame($input, $result->getRawValue());
        static::assertSame(1, $result->getIdentifierCount());
        static::assertTrue($result->hasIdentifier(Gtin::CODE));
    }

    public function testMultipleIdentifiersOfAllTypes(): void
    {
        $subject = new Decoder();

        $gtin = Gtin::CODE.'12345678901234';
        $netWeight = NetWeightKg::CODE.'1999999';
        $serialNumber = SerialNumber::CODE.'13128738[FNC1]';
        $expirationDate = ExpirationDate::CODE.'210124';

        $input = $gtin.$netWeight.$serialNumber.$expirationDate;

        $result = $subject->decode($input);

        static::assertSame($input, $result->getRawValue());
        static::assertSame(4, $result->getIdentifierCount());

        static::assertTrue($result->hasIdentifier(Gtin::CODE));
        $gtinIdentifier = $result->getIdentifier(Gtin::CODE);
        static::assertNotNull($gtinIdentifier);
        static::assertSame('12345678901234', $gtinIdentifier->getValue());

        static::assertTrue($result->hasIdentifier(NetWeightKg::CODE));
        $netWeightKgIdentifier = $result->getIdentifier(NetWeightKg::CODE);
        static::assertNotNull($netWeightKgIdentifier);
        static::assertSame(99999.9, $netWeightKgIdentifier->getValue());

        static::assertTrue($result->hasIdentifier(SerialNumber::CODE));
        $serialNumberIdentifier = $result->getIdentifier(SerialNumber::CODE);
        static::assertNotNull($serialNumberIdentifier);
        static::assertSame('13128738', $serialNumberIdentifier->getValue());

        static::assertTrue($result->hasIdentifier(ExpirationDate::CODE));
        $expirationDateIdentifier = $result->getIdentifier(ExpirationDate::CODE);
        static::assertNotNull($expirationDateIdentifier);
        static::assertInstanceOf(DateIdentifier::class, $expirationDateIdentifier);
        static::assertInstanceOf(DateTime::class, $expirationDateIdentifier->getValue());
    }

    /** @dataProvider dpTestVariableLengthIdentifier */
    public function testVariableLengthIdentifier(string $input, string $expected): void
    {
        $subject = new Decoder();

        $result = $subject->decode($input);

        $serialNumberIdentifier = $result->getIdentifier(SerialNumber::CODE);

        static::assertNotNull($serialNumberIdentifier);
        static::assertSame($expected, $serialNumberIdentifier->getValue());
    }

    /** @return array<string, array<string, string>> */
    public static function dpTestVariableLengthIdentifier(): array
    {
        return [
            'Short with delimiter' => [
                'input' => SerialNumber::CODE.'13128738[FNC1]555555555555555555550[FNC1]',
                'expected' => '13128738',
            ],
            'Short without delimiter' => [
                'input' => SerialNumber::CODE.'237846',
                'expected' => '237846',
            ],
            'Long with delimiter' => [
                'input' => SerialNumber::CODE.'11111111111111111111[FNC1]479182749',
                'expected' => '11111111111111111111',
            ],
            'Long without delimiter' => [
                'input' => SerialNumber::CODE.'11111111111111111111',
                'expected' => '11111111111111111111',
            ],
        ];
    }

    /** @dataProvider dpTestDateIdentifier */
    public function testDateIdentifier(string $input, DateTime $expected): void
    {
        $subject = new Decoder();

        $result = $subject->decode($input);

        $expirationDateIdentifier = $result->getIdentifier(ExpirationDate::CODE);

        static::assertNotNull($expirationDateIdentifier);
        static::assertInstanceOf(DateIdentifier::class, $expirationDateIdentifier);

        static::assertSame($expected->getTimestamp(), $expirationDateIdentifier->getValue()->getTimestamp());
    }

    /** @return array<string, array<string, DateTime|false|string>> */
    public static function dpTestDateIdentifier(): array
    {
        return [
            'Full date 1' => [
                'input' => ExpirationDate::CODE.'210124',
                'expected' => DateTime::createFromFormat('Y-m-d H:i:s', '2021-01-24 23:59:59'),
            ],
            'Full date 2' => [
                'input' => ExpirationDate::CODE.'241219',
                'expected' => DateTime::createFromFormat('Y-m-d H:i:s', '2024-12-19 23:59:59'),
            ],
            'End of month date 1' => [
                'input' => ExpirationDate::CODE.'241200',
                'expected' => DateTime::createFromFormat('Y-m-d H:i:s', '2024-12-31 23:59:59'),
            ],
            'End of month date 2' => [
                'input' => ExpirationDate::CODE.'210100',
                'expected' => DateTime::createFromFormat('Y-m-d H:i:s', '2021-01-31 23:59:59'),
            ],
        ];
    }

    public function testIdentifierIgnoredWhenNotEnoughCharacters(): void
    {
        $subject = new Decoder();

        $input = GtinTradeItems::CODE.'98410843114508'.
            BestBeforeDate::CODE.'250827'.
            NetWeightKg::CODE.'3007426'.
            Sscc::CODE.'123';

        $result = $subject->decode($input);

        static::assertSame($input, $result->getRawValue());
        static::assertSame(3, $result->getIdentifierCount());
        static::assertTrue($result->hasIdentifier(GtinTradeItems::CODE));
        static::assertTrue($result->hasIdentifier(NetWeightKg::CODE));
        static::assertTrue($result->hasIdentifier(BestBeforeDate::CODE));
        static::assertFalse($result->hasIdentifier(Sscc::CODE));
    }

    public function testDecimalIdentifierIgnoredIfNoDecimalPointPosition(): void
    {
        $subject = new Decoder();

        $input = Gtin::CODE.'98410843114508'.NetWeightKg::CODE;

        $result = $subject->decode($input);

        static::assertSame($input, $result->getRawValue());
        static::assertSame(1, $result->getIdentifierCount());
        static::assertTrue($result->hasIdentifier(Gtin::CODE));
        static::assertFalse($result->hasIdentifier(NetWeightKg::CODE));
    }

    public function testIdentifierIgnoredIfNoValue(): void
    {
        $subject = new Decoder();

        $input = Gtin::CODE.'98410843114508'.GtinTradeItems::CODE;

        $result = $subject->decode($input);

        static::assertSame($input, $result->getRawValue());
        static::assertSame(1, $result->getIdentifierCount());
        static::assertTrue($result->hasIdentifier(Gtin::CODE));
        static::assertFalse($result->hasIdentifier(GtinTradeItems::CODE));
    }

    public function testInvalidDateIsIgnored(): void
    {
        $subject = new Decoder();

        $input = Gtin::CODE.'98410843114508'.
            BestBeforeDate::CODE.'SI9DRA'.
            NetWeightKg::CODE.'3007426';

        $result = $subject->decode($input);

        static::assertSame($input, $result->getRawValue());
        static::assertSame(2, $result->getIdentifierCount());
        static::assertTrue($result->hasIdentifier(Gtin::CODE));
        static::assertTrue($result->hasIdentifier(NetWeightKg::CODE));
        static::assertFalse($result->hasIdentifier(BestBeforeDate::CODE));
    }
}
