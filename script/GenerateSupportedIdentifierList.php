<?php

declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';

use Janisvepris\Gs1Decoder\ApplicationIdentifier\Contract\ApplicationIdentifierInterface;
use Janisvepris\Gs1Decoder\Util\AiFinder;

const OUTPUT_FILE = __DIR__.'/../SupporterdIdentifiers.md';

$aiClasses = AiFinder::all();

$lines = [];
foreach ($aiClasses as $aiClass) {
    /** @var ApplicationIdentifierInterface $identifier */
    $identifier = new $aiClass();

    $lines[] = sprintf(
        "- `%s`\t%s\n",
        $identifier->getCode(),
        $identifier->getEnglishTitle(),
    );
}

sort($lines);

$content = "Supported application identifiers\n\n".implode('', $lines);

$file = fopen(OUTPUT_FILE, 'w');

if ($file === false) {
    throw new RuntimeException('Failed to open file for writing');
}

fwrite($file, $content);
fclose($file);
