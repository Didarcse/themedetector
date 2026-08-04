<?php

declare(strict_types=1);

namespace App\Core\Exceptions;

use RuntimeException;

/**
 * Base exception for every dependency injection container failure in the
 * Kernel Framework.
 *
 * The exception represents failures occurring while registering, resolving,
 * or managing services within the dependency injection container. Every
 * container-related exception must extend this class, including
 * ServiceNotFoundException, CircularDependencyException,
 * InvalidServiceDefinitionException, and AutowiringException.
 *
 * Responsibilities:
 *
 * - Represent dependency injection container failures.
 * - Serve as the common parent exception for all container-related
 *   exceptions.
 *
 * Design philosophy:
 *
 * - Single Responsibility Principle: it represents container failures and
 *   nothing else.
 * - Base exception: it carries no state and provides no behaviour.
 * - Stateless and side-effect free.
 * - Designed for inheritance; the class is intentionally non-final.
 * - Future PSR-11 compatible.
 */
class ContainerException extends RuntimeException
{
}
