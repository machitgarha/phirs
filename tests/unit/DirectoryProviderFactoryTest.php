<?php

namespace MAChitgarha\Phirs\Test\Unit\Util;

use MAChitgarha\Phirs\DirectoryProviderFactory;
use MAChitgarha\Phirs\PlatformSpecific\{
    DarwinDirectoryProvider,
    LinuxDirectoryProvider,
    WindowsDirectoryProvider,
};
use MAChitgarha\Phirs\Type\StandardDirectoryProvider;
use MAChitgarha\Phirs\Util\Platform;
use PHPUnit\Framework\TestCase;

class DirectoryProviderFactoryTest extends TestCase
{
    /**
     * @dataProvider platformProvider
     */
    public function testCreateStandard(string $platform): void
    {
        $this->assertInstanceOf(
            StandardDirectoryProvider::class,
            DirectoryProviderFactory::createStandard($platform),
        );
    }

    /**
     * @dataProvider mapArgProvider
     * @depends testCreateStandard
     */
    public function testMap(
        string $type,
        string $platform,
        string $provider
    ): void {
        DirectoryProviderFactory::map($type, $platform, $provider);

        $this->assertInstanceOf(
            $provider,
            DirectoryProviderFactory::create($type, $platform),
        );
    }

    /**
     * @dataProvider mapManyArgProvider
     * @depends testMap
     */
    public function testMapMany(string $type, array $mapping): void
    {
        DirectoryProviderFactory::mapMany($type, $mapping);

        foreach ($mapping as $platform => $provider) {
            $this->assertInstanceOf(
                $provider,
                DirectoryProviderFactory::create($type, $platform),
            );
        }
    }

    /**
     * @dataProvider mapStandardArgProvider
     * @depends testMapMany
     */
    public function testMapStandard(string $platform, string $provider)
    {
        DirectoryProviderFactory::mapStandard($platform, $provider);

        $this->assertInstanceOf(
            $provider,
            DirectoryProviderFactory::createStandard($platform),
        );
    }

    public function platformProvider(): array
    {
        return [
            [Platform::autoDetect()],
            [Platform::LINUX],
            [Platform::DARWIN],
            [Platform::WINDOWS],
            [Platform::BSD],
            [Platform::SOLARIS],
        ];
    }

    public function mapArgProvider(): array
    {
        // Fake data
        return [
            [\Countable::class, Platform::LINUX, \ArrayObject::class],
            [\Countable::class, Platform::WINDOWS, \WeakMap::class],
            [\Countable::class, 'Unix', \WeakMap::class],
            [
                StandardDirectoryProvider::class,
                Platform::UNKNOWN,
                WindowsDirectoryProvider::class
            ],
            [
                StandardDirectoryProvider::class,
                'Redox',
                LinuxDirectoryProvider::class
            ],
        ];
    }

    public function mapManyArgProvider(): array
    {
        return [
            [\Traversable::class, [
                Platform::DARWIN => \ArrayObject::class,
                Platform::BSD => \ArrayIterator::class,
            ]],
            [StandardDirectoryProvider::class, [
                Platform::UNKNOWN => LinuxDirectoryProvider::class,
                'iOS' => DarwinDirectoryProvider::class,
            ]],
        ];
    }

    public function mapStandardArgProvider(): array
    {
        return [
            [Platform::SOLARIS, LinuxDirectoryProvider::class],
            [Platform::UNKNOWN, WindowsDirectoryProvider::class],
        ];
    }
}
