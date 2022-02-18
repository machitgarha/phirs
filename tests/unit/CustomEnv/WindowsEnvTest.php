<?php

namespace MAChitgarha\Phirs\Test\Unit\CustomEnv;

use MAChitgarha\Phirs\PlatformSpecific\WindowsDirectoryProvider;
use MAChitgarha\Phirs\Test\Unit\GlobalTraits;
use MAChitgarha\Phirs\Util\Platform;
use PHPUnit\Framework\TestCase;

class WindowsEnvTest extends TestCase
{
    use Traits\SingleValueEnvTester;
    use GlobalTraits\ProviderGetter;
    use GlobalTraits\PlatformChecker;

    private static $provider;

    public static function setUpBeforeClass(): void
    {
        self::skipIfPlatformUnsupported(Platform::WINDOWS);

        self::$provider = new WindowsDirectoryProvider();
    }

    public function singleValueEnvProvider(): array
    {
        return [
            ['UserProfile', 'E:', 'getHomePath'],
            ['AppData', 'E:\\AppData', 'getDataPath'],
            ['LocalAppData', 'E:\\AppData\\Local', 'getLocalDataPath'],
            ['Temp', 'D:\\Temp', 'getTemporaryPath'],
        ];
    }
}
