<?php

namespace MAChitgarha\Phirs\Test\Unit\CustomEnv\Traits;

/**
 * Tester for envs with a colon-separated array of values.
 */
trait ColonedArrayEnvTester
{
    abstract private static function getProvider(): object;

    /**
     * Just like SingleValueEnvTester::singleValueEnvProvider(), but the value
     * of an environment variable must be an array.
     */
    abstract public function colonedArrayEnvProvider(): array;

    /**
     * @dataProvider colonedArrayEnvProvider
     */
    public function testColonedArrayEnv(
        string $envName,
        array $envValue,
        string $pathGetter
    ): void {
        \putenv("$envName=" . \join(':', $envValue));

        $this->assertSame($envValue, self::getProvider()->$pathGetter());
    }
}
