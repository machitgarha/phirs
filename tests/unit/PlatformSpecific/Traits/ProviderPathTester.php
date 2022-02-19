<?php

namespace MAChitgarha\Phirs\Test\Unit\PlatformSpecific\Traits;

use Symfony\Component\Filesystem\Path;

trait ProviderPathTester
{
    abstract private static function getProvider(): object;

    /**
     * Provide the names of path getter methods of the directory provider.
     *
     * Do not confuse the term provider in the end with providers in Phirs. This
     * is a PHPUnit data provider.
     */
    abstract public static function pathGetterMethodNameProvider(): array;

    // PHPUnit TestCase methods
    abstract public static function assertNotEmpty($path): void;
    abstract public static function assertIsReadable(string $path): void;
    abstract public static function assertIsWritable(string $path): void;
    abstract public static function assertTrue($value): void;

    private static function assertIsAbsolute(string $path): void
    {
        self::assertTrue(Path::isAbsolute($path));
    }

    /**
     * Test if the provider's path getter methods return a good path.
     *
     * A proper path must be non-empty, absolute, readable and writable. We
     * We suppose the tests are done in a clean and standard environments, so
     * the conditions must be met. Note that, however, Phirs by default does
     * not check these in its logic.
     *
     * @dataProvider pathGetterMethodNameProvider
     */
    public function testProviderPath(string $pathGetter): void
    {
        $path = self::getProvider()->$pathGetter();

        $this->assertNotEmpty($path);
        $this->assertIsAbsolute($path);

        $this->makeDirectoryIfNotExists($path);

        $this->assertIsReadable($path);
        $this->assertIsWritable($path);
    }

    private function makeDirectoryIfNotExists(string $path): void
    {
        if (!\is_dir($path) && !\mkdir($path, 0700, true)) {
            throw new \Exception("Cannot make directory '$path'");
        }

        // For the paths on Windows platform to be writable
        \chmod($path, 0777);
    }
}
