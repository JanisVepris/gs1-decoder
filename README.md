# GS1 Barcode decoder

A simple library that decodes GS1 barcodes.

## Instalation

```bash
composer require janisvepris/gs1-decoder
```

## Usage

### Decode GS1 barcode
```php
<?php

use JanisVepris\GS1Decoder\Decoder;
use Janisvepris\Gs1Decoder\ApplicationIdentifier\Gtin;

$barcode = '0112345678901234[FNC1]2140928049820384[FNC1]';
$decoder = new Decoder();

$decoded = $decoder->decode($barcode);
$decoded->hasIdentifier(Gtin::CODE);
$decoded->getIdentifier(Gtin::CODE)->getValue();
```

### Custom application identifier code -> class map
Normally, the decoder gets initialized with a default identifier class map which includes all the identifiers that ship with this package.
You can override it with your own.
```php
<?php

use JanisVepris\GS1Decoder\Decoder;
use Janisvepris\Gs1Decoder\ApplicationIdentifier\Gtin;
use Janisvepris\Gs1Decoder\IdentifierMap;

$barcode = '0112345678901234';

$decoder = new Decoder(new IdentifierMap([
    '01' => Gtin::class,
]));

// or

$decoder = new Decoder();
$decoder->setIdentifierMap(new IdentifierMap([
    '01' => Gtin::class,
]));

$decoded = $decoder->decode($barcode);
```

### Define your own application identifier class
Multiple abstract identifier classes are available for extension:
- `SimpleIdentifier` - `string` value, set length
- `DateIdentifier` - `DateTime` value, set length
- `DecimalIdentifier` - `float` value, set length
- `VariableLengthIdentifier` - `string` value, variable length (min-max)

You can define your own as long as they implement `ApplicationIdentifierInterface`.

```php
<?php

use JanisVepris\GS1Decoder\Decoder;

class MyGtinIdentifier extends SimpleIdentifier
{
    protected $code = '01';
    protected int $length = 99;
    protected string $englishTitle = 'My awesome title';
}

// Replace the default identifier class map with your own 
$decoder = new Decoder([
    '01' => MyGtinIdentifier::class,
]);

// or add your own identifier class to the default map
$decoder = new Decoder();
$decoder->getIdentifierMap()
    ->addIdentifierClass('01', MyGtinIdentifier::class)
```
