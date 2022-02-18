<?php

namespace MAChitgarha\Phirs\Test\Unit\PlatformSpecific;

use MAChitgarha\Phirs\PlatformSpecific\LinuxDirectoryProvider;
use MAChitgarha\Phirs\Test\Unit\GlobalTraits;
use MAChitgarha\Phirs\Util\Platform;
use PHPUnit\Framework\TestCase;

class LinuxDirectoryProviderTest extends TestCase
{
    use Traits\ProviderPathTester;
    use GlobalTraits\ProviderGetter;
    use GlobalTraits\PlatformChecker;

    private static LinuxDirectoryProvider $provider;

    public static function setUpBeforeClass(): void
    {
        self::skipIfPlatformUnsupported(Platform::LINUX);

        self::$provider = new LinuxDirectoryProvider();
    }

    public static function pathGetterMethodNameProvider(): array
    {
        return [
            ['getHomePath'],

            ['getExecutablePath'],
            ['getCachePath'],
            ['getConfigPath'],
            ['getDataPath'],
            ['getStatePath'],
            ['getRuntimePath'],

            ['getDesktopPath'],
            ['getDocumentsPath'],
            ['getDownloadsPath'],
            ['getFontsPath'],
            ['getMusicPath'],
            ['getPicturesPath'],
            ['getPublicPath'],
            ['getTemplatesPath'],
            ['getVideosPath'],
        ];
    }

    // TODO: Test get*PathSet() as well
}
