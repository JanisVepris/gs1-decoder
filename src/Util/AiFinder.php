<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\Util;

use Janisvepris\Gs1Decoder\ApplicationIdentifier\Contract\ApplicationIdentifierInterface;
use Janisvepris\Gs1Decoder\Exception\Gs1DecoderException;
use ReflectionClass;

class AiFinder
{
    private const APPLICATION_IDENTIFIER_DIR = __DIR__.'/../ApplicationIdentifier/';

    /** @return string[] */
    public static function all(): array
    {
        $aiClasses = [];

        $phpFiles = glob(self::APPLICATION_IDENTIFIER_DIR.'/*.php');

        if ($phpFiles === false) {
            throw new Gs1DecoderException('Failed to glob application identifier directory');
        }

        foreach ($phpFiles as $phpFile) {
            include_once $phpFile;
        }

        $declaredClasses = get_declared_classes();

        foreach ($declaredClasses as $className) {
            if (!is_subclass_of($className, ApplicationIdentifierInterface::class)) {
                continue;
            }

            $reflection = new ReflectionClass($className);

            if ($reflection->isAbstract() || $reflection->isInterface()) {
                continue;
            }

            $aiClasses[] = $className;
        }

        return $aiClasses;
    }
}
