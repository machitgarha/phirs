<?php

namespace MAChitgarha\Phirs\Test\Unit\PlatformSpecific;

use MAChitgarha\Phirs\PlatformSpecific\LinuxDirectoryProvider;
use MAChitgarha\Phirs\Util\Platform;
use PHPUnit\Framework\TestCase;

class LinuxDirectoryProviderTest extends TestCase
{
    use Traits\ProviderPathTester;
    use Traits\ProviderGetter;
    use Traits\IsAbsoluteAsserter;

    private static LinuxDirectoryProvider $provider;

    private static function getPathGetterMethods(): array
    {
        return [
            'getHomePath',

            'getExecutablePath',
            'getCachePath',
            'getConfigPath',
            'getDataPath',
            'getStatePath',
            'getRuntimePath',

            'getDesktopPath',
            'getDocumentsPath',
            'getDownloadsPath',
            'getFontsPath',
            'getMusicPath',
            'getPicturesPath',
            'getPublicPath',
            'getTemplatesPath',
            'getVideosPath',
        ];
    }

    public static function setUpBeforeClass(): void
    {
        if (Platform::autoDetect() !== Platform::LINUX) {
            self::markTestSkipped('Not a Linux platform');
        }

        self::$provider = new LinuxDirectoryProvider();
    }

    // TODO: Test get*PathSet() as well
}
