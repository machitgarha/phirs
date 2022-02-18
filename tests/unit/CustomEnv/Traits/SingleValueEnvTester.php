<?php

namespace MAChitgarha\Phirs\Test\Unit\CustomEnv\Traits;

/**
 * Tester for envs with a single string value.
 */
trait SingleValueEnvTester
{
    abstract private static function getProvider(): object;

    /**
     * Provide a list of environment variable name and value to change, along
     * with name of a path getter method to assert the env change was effective.
     */
    abstract public function singleValueEnvProvider(): array;

    /**
     * @dataProvider singleValueEnvProvider
     */
    public function testSingleValueEnv(
        string $envName,
        string $envValue,
        string $pathGetter
    ): void {
        \putenv("$envName=$envValue");

        $this->assertSame($envValue, self::getProvider()->$pathGetter());
    }
}
