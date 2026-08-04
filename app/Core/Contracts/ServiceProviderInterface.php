<?php

declare(strict_types=1);

namespace App\Core\Contracts;

use App\Core\Container;

/**
 * Contract for every service provider in the Kernel Framework.
 *
 * A service provider is responsible for registering related services into
 * the dependency injection container. Service providers enable modular
 * framework bootstrapping by grouping service registrations into cohesive
 * units.
 *
 * The interface defines only the registration contract.
 *
 * Responsibilities:
 *
 * - Register related services into the container.
 *
 * Design philosophy:
 *
 * - Dependency Injection and Inversion of Control: providers wire services
 *   into the container; consumers never construct them directly.
 * - Single Responsibility Principle: a provider groups related service
 *   registrations and nothing else.
 * - Open/Closed Principle: framework bootstrapping grows by adding
 *   providers, never by modifying existing ones.
 * - Stateless and side-effect free.
 * - Designed for implementation.
 */
interface ServiceProviderInterface
{
    /**
     * Register related services with the given container.
     *
     * @param Container $container The application dependency injection
     *                             container receiving the registrations.
     *
     * @return void
     */
    public function register(Container $container): void;
}
