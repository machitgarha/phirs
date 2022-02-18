<?php

namespace MAChitgarha\Phirs\Test\Unit\PlatformSpecific;

use MAChitgarha\Phirs\PlatformSpecific\WindowsDirectoryProvider;
use MAChitgarha\Phirs\Util\Platform;
use PHPUnit\Framework\TestCase;

class WindowsDirectoryProviderTest extends TestCase
{
    use Traits\ProviderPathTester;
    use Traits\ProviderGetter;
    use Traits\IsAbsoluteAsserter;

    private static WindowsDirectoryProvider $provider;

    private static function getPathGetterMethods(): array
    {
        return [
            'getHomePath',

            'getCachePath',
            'getConfigPath',
            'getDataPath',
            'getLocalDataPath',
            'getTemporaryPath',

            'getDesktopPath',
            'getDocumentsPath',
            'getDownloadsPath',
            'getMusicPath',
            'getPicturesPath',
            'getPublicPath',
            'getTemplatesPath',
            'getVideosPath',
        ];
    }

    public static function setUpBeforeClass(): void
    {
        if (Platform::autoDetect() !== Platform::WINDOWS) {
            self::markTestSkipped('Not a Windows platform');
        }

        self::$provider = new WindowsDirectoryProvider();
    }
}
