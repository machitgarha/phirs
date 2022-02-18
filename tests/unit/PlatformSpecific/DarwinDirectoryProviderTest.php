<?php

namespace MAChitgarha\Phirs\Test\Unit\PlatformSpecific;

use MAChitgarha\Phirs\PlatformSpecific\DarwinDirectoryProvider;
use MAChitgarha\Phirs\Test\Unit\GlobalTraits;
use MAChitgarha\Phirs\Util\Platform;
use PHPUnit\Framework\TestCase;

class DarwinDirectoryProviderTest extends TestCase
{
    use Traits\ProviderPathTester;
    use Traits\ProviderGetter;
    use GlobalTraits\PlatformChecker;

    private static DarwinDirectoryProvider $provider;

    public static function setUpBeforeClass(): void
    {
        self::skipIfPlatformUnsupported(Platform::DARWIN);

        self::$provider = new DarwinDirectoryProvider();
    }

    public static function pathGetterMethodNameProvider(): array
    {
        return [
            ['getHomePath'],

            ['getApplicationSupportPath'],
            ['getCachePath'],
            ['getConfigPath'],
            ['getDataPath'],
            ['getPreferencesPath'],

            ['getDesktopPath'],
            ['getDocumentsPath'],
            ['getDownloadsPath'],
            ['getFontsPath'],
            ['getMoviesPath'],
            ['getMusicPath'],
            ['getPicturesPath'],
            ['getPublicPath'],
            ['getVideosPath'],
        ];
    }
}
