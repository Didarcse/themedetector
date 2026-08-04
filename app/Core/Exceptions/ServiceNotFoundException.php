<?php

declare(strict_types=1);

namespace App\Core\Exceptions;

/**
 * Thrown when a requested service identifier does not exist in the
 * dependency injection container.
 *
 * The exception is thrown exclusively by Container::get() when the
 * requested service has not been registered. It indicates a container
 * configuration or composition error rather than a runtime application
 * failure.
 *
 * Responsibilities:
 *
 * - Represent a missing service registration.
 * - Signal a wiring defect at composition root time.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: it represents a missing service
 *   registration and nothing else.
 * - Marker exception: it carries no state and provides no behaviour.
 * - Stateless and side-effect free.
 * - Designed to be thrown by the dependency injection container.
 * - Future PSR-11 compatible.
 */
final class ServiceNotFoundException extends ContainerException
{
}
