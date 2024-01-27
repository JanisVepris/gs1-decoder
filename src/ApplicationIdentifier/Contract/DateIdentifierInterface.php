<?php

declare(strict_types=1);

namespace Janisvepris\Gs1Decoder\ApplicationIdentifier\Contract;

use DateTime;

interface DateIdentifierInterface extends ApplicationIdentifierInterface
{
    public function getValue(): DateTime;
}
