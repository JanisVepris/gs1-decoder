<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\Barcode;

use Janisvepris\Gs1Decoder\ApplicationIdentifier\Contract\ApplicationIdentifierInterface;

class Barcode
{
    /** @var array<string, ApplicationIdentifierInterface> */
    private array $applicationIdentifiers = [];

    public function __construct(
        private readonly string $rawBarcode,
    ) {}

    public function getRawValue(): string
    {
        return $this->rawBarcode;
    }

    public function addIdentifier(ApplicationIdentifierInterface $applicationIdentifier): self
    {
        $this->applicationIdentifiers[$applicationIdentifier->getCode()] = $applicationIdentifier;

        return $this;
    }

    public function getIdentifier(string $identifierCode): ?ApplicationIdentifierInterface
    {
        return $this->applicationIdentifiers[$identifierCode] ?? null;
    }

    public function hasIdentifier(string $identifierCode): bool
    {
        return array_key_exists($identifierCode, $this->applicationIdentifiers);
    }

    public function getIdentifierCount(): int
    {
        return count($this->applicationIdentifiers);
    }

    /** @return ApplicationIdentifierInterface[] */
    public function getAllIdentifiers(): array
    {
        return array_values($this->applicationIdentifiers);
    }

    /**
     * @return array{
     *     'barcode': string,
     *     'identifiers': array<string, mixed>,
     * }  */
    public function toArray(): array
    {
        return [
            'barcode' => $this->rawBarcode,
            'identifiers' => array_map(
                fn (ApplicationIdentifierInterface $identifier) => $identifier->toArray(),
                $this->getAllIdentifiers(),
            ),
        ];
    }
}
