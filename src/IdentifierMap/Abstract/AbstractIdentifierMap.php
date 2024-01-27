<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\IdentifierMap\Abstract;

use Janisvepris\Gs1Decoder\Exception\IdentifierMap\DuplicateIdentifierCodeException;
use Janisvepris\Gs1Decoder\IdentifierMap\Contract\IdentifierMapInterface;

abstract class AbstractIdentifierMap implements IdentifierMapInterface
{
    /** @var array<int|string, string> */
    protected array $map = [];

    public function addIdentifierClass(string $identifierCode, string $identifierClass): self
    {
        if ($this->hasIdentifierClass($identifierCode)) {
            throw new DuplicateIdentifierCodeException($identifierCode);
        }

        $this->map[$identifierCode] = $identifierClass;

        return $this;
    }

    public function getIdentifierClass(string $identifierCode): ?string
    {
        return $this->map[$identifierCode] ?? null;
    }

    public function removeIdentifierClass(string $identifierCode): self
    {
        unset($this->map[$identifierCode]);

        return $this;
    }

    public function hasIdentifierClass(string $identifierCode): bool
    {
        return array_key_exists($identifierCode, $this->map);
    }

    public function getElementCount(): int
    {
        return count($this->map);
    }
}
