<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\Test\Unit\Util;

use Janisvepris\Gs1Decoder\Util\Str;
use PHPUnit\Framework\TestCase;

class StrTest extends TestCase
{
    public function testShiftDefaultLength(): void
    {
        $string = 'test string';

        $result = Str::shift($string);

        static::assertSame('t', $result);
        static::assertSame('est string', $string);
    }

    public function testShiftCustomLength(): void
    {
        $string = 'test string';

        $result = Str::shift($string, 4);

        static::assertSame('test', $result);
        static::assertSame(' string', $string);
    }

    public function testShiftEmptyString(): void
    {
        $string = '';

        $result = Str::shift($string);

        static::assertSame('', $result);
        static::assertSame('', $string);
    }
}
