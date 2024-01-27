<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\Test\Unit\Decoder;

use Janisvepris\Gs1Decoder\Decoder\Decoder;
use Janisvepris\Gs1Decoder\IdentifierMap\Contract\IdentifierMapInterface;
use PHPUnit\Framework\TestCase;

class DecoderTest extends TestCase
{
    public function testDefaultMap(): void
    {
        $subject = new Decoder();

        $result = $subject->getIdentifierMap();

        static::assertInstanceOf(IdentifierMapInterface::class, $result);
    }

    public function testGetIdentifierMap(): void
    {
        $map = static::createMock(IdentifierMapInterface::class);

        $subject = new Decoder($map);

        $result = $subject->getIdentifierMap();

        static::assertSame($map, $result);
    }

    public function testSetIdentifierMap(): void
    {
        $map = static::createMock(IdentifierMapInterface::class);

        $subject = new Decoder();
        $subject->setIdentifierMap($map);

        $result = $subject->getIdentifierMap();

        static::assertSame($map, $result);
    }

    public function testDefaultDelimiter(): void
    {
        $subject = new Decoder();

        static::assertSame('[FNC1]', $subject->getDelimiter());
    }

    public function testSetDelimiter(): void
    {
        $subject = new Decoder();
        $subject->setDelimiter('test');

        static::assertSame('test', $subject->getDelimiter());
    }
}
