<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\Test\Unit\Util;

use Janisvepris\Gs1Decoder\ApplicationIdentifier\Contract\ApplicationIdentifierInterface;
use Janisvepris\Gs1Decoder\ApplicationIdentifier\Gtin;
use Janisvepris\Gs1Decoder\Util\AiFinder;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class AiFinderTest extends TestCase
{
    public function testClassDiscovery(): void
    {
        $aiClasses = AiFinder::all();

        static::assertGreaterThan(0, count($aiClasses));
        static::assertContains(Gtin::class, $aiClasses);

        foreach ($aiClasses as $aiClass) {
            static::assertTrue(
                class_exists($aiClass),
                sprintf('Class "%s" does not exist', $aiClass),
            );

            static::assertTrue(
                is_subclass_of($aiClass, ApplicationIdentifierInterface::class),
                sprintf('Class "%s" is not a subclass of "%s"', $aiClass, ApplicationIdentifierInterface::class),
            );

            $reflection = new ReflectionClass($aiClass);

            static::assertTrue(
                $reflection->isInstantiable(),
                sprintf('Class "%s" is not instantiable', $aiClass),
            );
            static::assertFalse(
                $reflection->isAbstract(),
                sprintf('Class "%s" is abstract', $aiClass),
            );
            static::assertFalse(
                $reflection->isInterface(),
                sprintf('Class "%s" is an interface', $aiClass),
            );
        }
    }
}
