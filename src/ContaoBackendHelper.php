<?php

declare(strict_types=1);

namespace Oveleon\ContaoBackendHelper;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ContaoBackendHelper extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
