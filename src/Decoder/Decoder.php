<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\Decoder;

use Janisvepris\Gs1Decoder\ApplicationIdentifier\Contract\ApplicationIdentifierInterface;
use Janisvepris\Gs1Decoder\ApplicationIdentifier\Contract\DecimalIdentifierInterface;
use Janisvepris\Gs1Decoder\ApplicationIdentifier\Contract\VariableLengthIdentifierInterface;
use Janisvepris\Gs1Decoder\Barcode\Barcode;
use Janisvepris\Gs1Decoder\Exception\Decoder\NotEnoughCharactersException;
use Janisvepris\Gs1Decoder\Exception\Gs1DecoderException;
use Janisvepris\Gs1Decoder\IdentifierMap\Contract\IdentifierMapInterface;
use Janisvepris\Gs1Decoder\IdentifierMap\IdentifierMap;
use Janisvepris\Gs1Decoder\Util\Str;

class Decoder
{
    private IdentifierMapInterface $identifierMap;
    private string $delimiter = '[FNC1]';

    public function __construct(?IdentifierMapInterface $identifierMap = null)
    {
        $this->identifierMap = $identifierMap ?? new IdentifierMap();
    }

    public function decode(string $barcode): Barcode
    {
        $rawBarcode = $barcode;

        $parsedBarcode = new Barcode($rawBarcode);

        while (strlen($barcode) > 0) {
            $identifier = $this->findNextIdentifier($barcode);

            if ($identifier === null) {
                break;
            }

            if ($identifier instanceof DecimalIdentifierInterface) {
                if (strlen($barcode) === 0) {
                    break;
                }

                $decimalPosition = (int) Str::shift($barcode);
                $identifier->setDecimalPosition($decimalPosition);
            }

            try {
                $value = $this->getIdentifierValue($identifier, $barcode);

                if ($value === '') {
                    continue;
                }

                $identifier->setValue($value);

                $parsedBarcode->addIdentifier($identifier);
            } catch (NotEnoughCharactersException) {
                break;
            } catch (Gs1DecoderException) {
                continue;
            }
        }

        return $parsedBarcode;
    }

    public function getIdentifierMap(): IdentifierMapInterface
    {
        return $this->identifierMap;
    }

    public function setIdentifierMap(IdentifierMapInterface $identifierMap): void
    {
        $this->identifierMap = $identifierMap;
    }

    public function getDelimiter(): string
    {
        return $this->delimiter;
    }

    public function setDelimiter(string $delimiter): Decoder
    {
        $this->delimiter = $delimiter;

        return $this;
    }

    private function findNextIdentifier(string &$barcode): ?ApplicationIdentifierInterface
    {
        $identifierCode = null;

        while (strlen($barcode) > 0) {
            $identifierCode .= Str::shift($barcode);

            if ($this->identifierMap->hasIdentifierClass($identifierCode)) {
                $identifierClass = $this->identifierMap->getIdentifierClass($identifierCode);

                return new $identifierClass();
            }
        }

        return null;
    }

    private function getIdentifierValue(ApplicationIdentifierInterface $identifier, string &$barcode): string
    {
        $content = '';

        if ($identifier instanceof VariableLengthIdentifierInterface
            && strlen($barcode) < $identifier->getMinLength()) {
            throw NotEnoughCharactersException::notEnoughCharacters($identifier->getCode());
        }
        if (!$identifier instanceof VariableLengthIdentifierInterface
            && strlen($barcode) < $identifier->getLength()) {
            throw NotEnoughCharactersException::notEnoughCharacters($identifier->getCode());
        }

        while (strlen($barcode) > 0) {
            if (str_starts_with($barcode, $this->delimiter)) {
                Str::shift($barcode, strlen($this->delimiter));

                return $content;
            }

            if (strlen($content) >= $identifier->getLength()) {
                return $content;
            }

            $content .= Str::shift($barcode);
        }

        return $content;
    }
}
