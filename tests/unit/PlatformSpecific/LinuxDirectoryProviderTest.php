<?php

namespace MAChitgarha\Phirs\Test\Unit\PlatformSpecific;

use MAChitgarha\Phirs\PlatformSpecific\LinuxDirectoryProvider;
use MAChitgarha\Phirs\Test\Unit\GlobalTraits;
use MAChitgarha\Phirs\Util\Platform;
use PHPUnit\Framework\TestCase;

class LinuxDirectoryProviderTest extends TestCase
{
    use Traits\ProviderPathTester;
    use Traits\ProviderGetter;
    use Traits\IsAbsoluteAsserter;
    use GlobalTraits\PlatformChecker;

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
        self::skipIfPlatformUnsupported(Platform::LINUX);

        self::$provider = new LinuxDirectoryProvider();
    }

    // TODO: Test get*PathSet() as well
}
