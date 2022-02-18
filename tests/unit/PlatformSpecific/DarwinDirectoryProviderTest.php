<?php

namespace MAChitgarha\Phirs\Test\Unit\PlatformSpecific;

use MAChitgarha\Phirs\PlatformSpecific\DarwinDirectoryProvider;
use MAChitgarha\Phirs\Util\Platform;
use PHPUnit\Framework\TestCase;

class DarwinDirectoryProviderTest extends TestCase
{
    use Traits\ProviderPathTester;
    use Traits\ProviderGetter;
    use Traits\IsAbsoluteAsserter;

    private static DarwinDirectoryProvider $provider;

    private static function getPathGetterMethods(): array
    {
        return [
            'getHomePath',

            'getApplicationSupportPath',
            'getCachePath',
            'getConfigPath',
            'getDataPath',
            'getPreferencesPath',

            'getDesktopPath',
            'getDocumentsPath',
            'getDownloadsPath',
            'getFontsPath',
            'getMoviesPath',
            'getMusicPath',
            'getPicturesPath',
            'getPublicPath',
            'getVideosPath',
        ];
    }

    public static function setUpBeforeClass(): void
    {
        if (Platform::autoDetect() !== Platform::DARWIN) {
            self::markTestSkipped('Not a Darwin platform');
        }

        self::$provider = new DarwinDirectoryProvider();
    }
}
