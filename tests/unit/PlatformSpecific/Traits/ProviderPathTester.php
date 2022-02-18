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
    abstract public static function assertIsReadable(string $path): void;
    abstract public static function assertIsWritable(string $path): void;

    // Custom-defined
    abstract public static function assertIsAbsolute(string $path): void;

    /**
     * Test if the provider's path getter methods return a good path.
     *
     * A proper path must be non-empty, absolute, readable and writable. We
     * We suppose the tests are done in a clean and standard environments, so
     * the conditions must be met. Note that, however, Phirs by default does
     * not check these in its logic.
     */
    public function testProviderPaths(): void
    {
        $provider = self::getProvider();

        foreach (self::getPathGetterMethods() as $pathGetter) {
            $path = $provider->$pathGetter();

            $this->assertNotEmpty($path);
            $this->assertIsAbsolute($path);

            $this->makeDirectoryIfNotExists($path);
            $this->assertIsReadable($path);
            $this->assertIsWritable($path);
        }
    }

    private function makeDirectoryIfNotExists(string $path): void
    {
        if (!\is_dir($path) && !\mkdir($path, 0700, true)) {
            throw new \Exception("Cannot make directory '$path'");
        }
    }
}
