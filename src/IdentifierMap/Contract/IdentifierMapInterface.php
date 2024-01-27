<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\IdentifierMap\Contract;

interface IdentifierMapInterface
{
    public function addIdentifierClass(string $identifierCode, string $identifierClass): self;

    public function getIdentifierClass(string $identifierCode): ?string;

    public function removeIdentifierClass(string $identifierCode): self;

    public function hasIdentifierClass(string $identifierCode): bool;

    public function getElementCount(): int;
}
