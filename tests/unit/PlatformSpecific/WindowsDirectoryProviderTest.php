<?php

namespace MAChitgarha\Phirs\Test\Unit\PlatformSpecific;

use MAChitgarha\Phirs\PlatformSpecific\WindowsDirectoryProvider;
use MAChitgarha\Phirs\Test\Unit\GlobalTraits;
use MAChitgarha\Phirs\Util\Platform;
use PHPUnit\Framework\TestCase;

class WindowsDirectoryProviderTest extends TestCase
{
    use Traits\ProviderPathTester;
    use GlobalTraits\ProviderGetter;
    use GlobalTraits\PlatformChecker;

    private static WindowsDirectoryProvider $provider;

    public static function setUpBeforeClass(): void
    {
        self::skipIfPlatformUnsupported(Platform::WINDOWS);

        self::$provider = new WindowsDirectoryProvider();
    }

    public static function pathGetterMethodNameProvider(): array
    {
        return [
            ['getHomePath'],

            ['getCachePath'],
            ['getConfigPath'],
            ['getDataPath'],
            ['getLocalDataPath'],
            ['getTemporaryPath'],

            ['getDesktopPath'],
            ['getDocumentsPath'],
            ['getDownloadsPath'],
            ['getMusicPath'],
            ['getPicturesPath'],
            ['getPublicPath'],
            ['getTemplatesPath'],
            ['getVideosPath'],
        ];
    }
}
