<?php

declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';

use Janisvepris\Gs1Decoder\ApplicationIdentifier\Contract\ApplicationIdentifierInterface;
use Janisvepris\Gs1Decoder\Util\AiFinder;

const OUTPUT_FILE = __DIR__.'/../docs/SupportedIdentifiers.md';

$aiClasses = AiFinder::all();

$content = <<<'CONTENT'
# Supported application identifiers

| Code | Title |
| --- | --- |

CONTENT;

$rows = [];
foreach ($aiClasses as $aiClass) {
    /** @var ApplicationIdentifierInterface $identifier */
    $identifier = new $aiClass();

    $rows[] = [
        'code' => $identifier->getCode(),
        'title' => $identifier->getEnglishTitle(),
    ];
}

usort($rows, static function (array $a, array $b) {
    return $a['code'] <=> $b['code'];
});

foreach ($rows as $row) {
    $content .= sprintf(
        '| %s | %s |%s',
        $row['code'],
        $row['title'],
        PHP_EOL,
    );
}

$file = fopen(OUTPUT_FILE, 'w');

if ($file === false) {
    throw new RuntimeException('Failed to open file for writing');
}

fwrite($file, $content);
fclose($file);
