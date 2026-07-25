<?php

declare(strict_types=1);

use App\Core\Container;

function app(): Container
{
    if (!isset($GLOBALS['app']) || !$GLOBALS['app'] instanceof Container) {
        throw new RuntimeException('Application container is not available.');
    }

    return $GLOBALS['app'];
}
