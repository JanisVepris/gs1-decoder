<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\Test\Unit\IdentifierMap;

use Janisvepris\Gs1Decoder\ApplicationIdentifier\Contract\ApplicationIdentifierInterface;
use Janisvepris\Gs1Decoder\Exception\IdentifierMap\DuplicateIdentifierCodeException;
use Janisvepris\Gs1Decoder\IdentifierMap\IdentifierMap;
use Janisvepris\Gs1Decoder\Util\AiFinder;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class IdentifierMapTest extends TestCase
{
    public function testAllIdentifiersAreInDefaultMap(): void
    {
        $identifierClasses = array_filter(
            AiFinder::all(),
            fn (string $classString) => !is_subclass_of($classString, MockObject::class),
        );

        $subject = new IdentifierMap();

        foreach ($identifierClasses as $identifierClass) {
            /** @var ApplicationIdentifierInterface $identifier */
            $identifier = new $identifierClass();

            static::assertTrue(
                $subject->hasIdentifierClass($identifier->getCode()),
                sprintf('Identifier class "%s" is not in default map', $identifierClass),
            );
        }

        static::assertSame(count($identifierClasses), $subject->getElementCount());
    }

    public function testInitializeWithCustomMap(): void
    {
        $subject = new IdentifierMap([
            '333' => 'Class\\String',
        ]);

        static::assertSame(1, $subject->getElementCount());
        static::assertTrue($subject->hasIdentifierClass('333'));
    }

    public function testAddIdentifierClass(): void
    {
        $subject = new IdentifierMap([]);

        $subject->addIdentifierClass('11', 'Class\\String');

        static::assertSame(1, $subject->getElementCount());
        static::assertTrue($subject->hasIdentifierClass('11'));

        $subject->addIdentifierClass('22', 'Class\\String');

        static::assertSame(2, $subject->getElementCount());
        static::assertTrue($subject->hasIdentifierClass('22'));
    }

    public function testGetIdentifierClass(): void
    {
        $subject = new IdentifierMap([
            '11' => 'Class\\String1',
            '22' => 'Class\\String2',
        ]);

        $result = $subject->getIdentifierClass('11');

        static::assertSame('Class\\String1', $result);

        $result = $subject->getIdentifierClass('22');

        static::assertSame('Class\\String2', $result);
    }

    public function testRemoveIdentifierClass(): void
    {
        $subject = new IdentifierMap([
            '11' => 'Class\\String1',
            '22' => 'Class\\String2',
        ]);

        $subject->removeIdentifierClass('11');

        static::assertSame(1, $subject->getElementCount());
        static::assertFalse($subject->hasIdentifierClass('11'));

        $subject->removeIdentifierClass('22');

        static::assertSame(0, $subject->getElementCount());
        static::assertFalse($subject->hasIdentifierClass('22'));
    }

    public function testHasIdentifierClassMethod(): void
    {
        $map = [
            '11' => 'Class\\String',
            '22' => 'Class\\String',
            '33' => 'Class\\String',
        ];

        $subject = new IdentifierMap($map);

        static::assertTrue($subject->hasIdentifierClass('11'));
        static::assertTrue($subject->hasIdentifierClass('22'));
        static::assertTrue($subject->hasIdentifierClass('33'));
        static::assertFalse($subject->hasIdentifierClass('44'));
        static::assertFalse($subject->hasIdentifierClass('55'));
    }

    public function testGetElementCount(): void
    {
        $map = [
            '11' => 'Class\\String',
            '22' => 'Class\\String',
            '33' => 'Class\\String',
        ];

        $subject = new IdentifierMap($map);

        static::assertSame(3, $subject->getElementCount());

        $subject->addIdentifierClass('44', 'Class\\String');

        static::assertSame(4, $subject->getElementCount());
    }

    public function testThrowOnDuplicateIdentifierCode(): void
    {
        $subject = new IdentifierMap([]);

        static::expectException(DuplicateIdentifierCodeException::class);

        $subject->addIdentifierClass('11', 'Class\\String');
        $subject->addIdentifierClass('11', 'Class\\String2');
    }
}
