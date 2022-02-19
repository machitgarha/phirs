<?php

namespace MAChitgarha\Phirs\Test\Unit\CustomEnv\Traits;

/**
 * Saves environment variable values and restore it after the ends.
 */
trait EnvRestorer
{
    /**
     * Returns the name of environment variables changing during the test.
     * @var string[]
     */
    abstract public static function getChangingEnvNames(): array;

    private static array $envValues = [];

    public static function saveEnvValues(): void
    {
        foreach (self::getChangingEnvNames() as $envName) {
            self::$envValues[$envName] = \getenv($envName);
        }
    }

    public static function restoreEnvValues(): void
    {
        foreach (self::getChangingEnvNames() as $envName) {
            $value = self::$envValues[$envName];
            \putenv("$envName=$value");
        }
    }
}
