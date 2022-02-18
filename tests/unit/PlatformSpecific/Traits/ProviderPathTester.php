<?php

namespace MAChitgarha\Phirs\Test\Unit\PlatformSpecific\Traits;

trait ProviderPathTester
{
    abstract private static function getProvider(): object;

    /**
     * Returns the names of path getter methods of the provider.
     * @return array An array of function names (i.e. strings).
     */
    abstract private static function getPathGetterMethods(): array;

    // PHPUnit TestCase methods
    abstract public static function assertNotEmpty($path): void;
    abstract public static function assertDirectoryExists(string $path): void;
    abstract public static function assertIsReadable(string $path): void;
    abstract public static function assertIsWritable(string $path): void;

    // Custom-defined
    abstract public static function assertIsAbsolute(string $path): void;


    /**
     * Test if the provider's path getter methods return a good path.
     *
     * A good path must be non-empty, existing, readable, writable, and
     * absolute. We suppose the tests are done in a clean and standard
     * environments, so the conditions must be met. However, Phirs by default
     * does not check these in its logic.
     */
    public function testProviderPaths(): void
    {
        $provider = self::getProvider();

        foreach (self::getPathGetterMethods() as $pathGetter) {
            $path = $provider->$pathGetter();

            $this->assertNotEmpty($path);
            $this->assertDirectoryExists($path);
            $this->assertIsReadable($path);
            $this->assertIsWritable($path);
            $this->assertIsAbsolute($path);
        }
    }
}
