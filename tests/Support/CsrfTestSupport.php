<?php

declare(strict_types=1);

namespace Tests\Support;

use App\Core\Container;
use App\Logging\SecurityEventLogger;
use App\Security\CsrfGuard;
use App\Security\CsrfTokenManager;

/**
 * Registers an in-memory CSRF manager and guard for integration tests.
 */
final class CsrfTestSupport
{
    public static function register(
        Container $container,
        ?SecurityEventLogger $eventLogger = null,
    ): CsrfTokenManager {
        $manager = new CsrfTokenManager(new InMemoryCsrfTokenStore());

        $container->set(CsrfTokenManager::class, $manager);
        $container->set(CsrfGuard::class, new CsrfGuard($manager, $eventLogger));

        return $manager;
    }
}
