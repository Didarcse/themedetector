<?php

declare(strict_types=1);

namespace App\Core;

use InvalidArgumentException;

/**
 * Reads configuration values from the process environment and superglobals.
 *
 * Dotenv's immutable repository writes to the $_ENV and $_SERVER
 * superglobals, while FPM and container runtimes commonly expose values
 * through getenv(). This helper checks all three locations so configuration
 * behaves consistently regardless of how the value was supplied.
 */
final class Environment
{
    /**
     * Read an environment value.
     *
     * Empty values are treated as missing so callers can apply defaults.
     *
     * @param string $name The environment variable name.
     *
     * @return string|null The value, or null when unset or empty.
     */
    public static function get(string $name): ?string
    {
        $value = getenv($name);

        if (is_string($value) && $value !== '') {
            return $value;
        }

        if (isset($_ENV[$name]) && is_string($_ENV[$name]) && $_ENV[$name] !== '') {
            return $_ENV[$name];
        }

        if (isset($_SERVER[$name]) && is_string($_SERVER[$name]) && $_SERVER[$name] !== '') {
            return $_SERVER[$name];
        }

        return null;
    }

    /**
     * Read an integer environment value.
     *
     * @param string $name    The environment variable name.
     * @param int    $default The value returned when the variable is missing.
     *
     * @return int The configured integer.
     *
     * @throws InvalidArgumentException When the value is not an integer.
     */
    public static function int(string $name, int $default): int
    {
        $value = self::get($name);

        if ($value === null) {
            return $default;
        }

        $integer = filter_var($value, FILTER_VALIDATE_INT);

        if ($integer === false) {
            throw new InvalidArgumentException(
                sprintf('Environment variable "%s" must be an integer.', $name),
            );
        }

        return (int) $integer;
    }
}
