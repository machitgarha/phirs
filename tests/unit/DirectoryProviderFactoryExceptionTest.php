<?php

namespace MAChitgarha\Phirs\Test\Unit;

use MAChitgarha\Phirs\DirectoryProviderFactory;
use MAChitgarha\Phirs\PlatformSpecific\LinuxDirectoryProvider;
use MAChitgarha\Phirs\Type\CommonDirectoryProvider;
use MAChitgarha\Phirs\Util\Platform;
use MAChitgarha\Phirs\Exception\Exception;
use PHPUnit\Framework\TestCase;

/**
 * ---
 *
 * NOTE: Provider at the end of a method name mean data provider, not directory
 * provider. In other words, it belongs to PHPUnit semantics, not the library's.
 */
class DirectoryProviderFactoryExceptionTest extends TestCase
{
    protected function setUp(): void
    {
        $this->expectException(Exception::class);
    }

    /**
     * @dataProvider undefinedTypeProvider
     * @dataProvider unregisteredTypeProvider
     */
    public function testCreatingWithInvalidType(string $type): void
    {
        DirectoryProviderFactory::create($type, Platform::autoDetect());
    }

    /**
     * @dataProvider undefinedTypeProvider
     */
    public function testMappingWithInvalidType(string $type): void
    {
        DirectoryProviderFactory::map(
            $type,
            Platform::LINUX,
            LinuxDirectoryProvider::class
        );
    }

    /**
     * @dataProvider unmappedStandardTypePlatformProvider
     */
    public function testCreatingStandardWithUnmappedPlatform(
        string $platform
    ): void {
        DirectoryProviderFactory::createStandard($platform);
    }

    /**
     * @dataProvider undefinedProviderClassProvider
     */
    public function testMappingStandardWithInvalidProvider(
        string $provider
    ): void {
        DirectoryProviderFactory::mapStandard(Platform::WINDOWS, $provider);
    }

    /**
     * @dataProvider unimplementedStandardTypeProviderClassProvider
     */
    public function testMappingStandardWithInvalidProviderType(
        string $provider
    ): void {
        DirectoryProviderFactory::mapStandard(Platform::BSD, $provider);
    }

    public function undefinedTypeProvider(): array
    {
        return [
            [TestCase::class],
            ['StandardDirectoryProvider'],
        ];
    }

    public function unregisteredTypeProvider(): array
    {
        return [
            [\DateTimeInterface::class],
        ];
    }

    public function unmappedStandardTypePlatformProvider(): array
    {
        return [
            [Platform::UNKNOWN],
            [\strtolower(Platform::BSD)],
        ];
    }

    public function undefinedProviderClassProvider(): array
    {
        return [
            [Provider::class],
            ['LinuxDirectoryProvider'],
        ];
    }

    public function unimplementedStandardTypeProviderClassProvider(): array
    {
        return [
            [\stdClass::class],
            [\get_class(new class implements CommonDirectoryProvider {
                use \MAChitgarha\Phirs\Traits\HomeBased\CommonPathProvider;

                public function getHomeChildPath(string ...$childPaths): string
                {
                    // Just for testing, has no special meaning
                    return '/home/test';
                }
            })],
        ];
    }
}
