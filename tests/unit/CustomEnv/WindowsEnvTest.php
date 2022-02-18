<?php

namespace MAChitgarha\Phirs\Test\Unit\CustomEnv;

use MAChitgarha\Phirs\PlatformSpecific\WindowsDirectoryProvider;
use MAChitgarha\Phirs\Test\Unit\GlobalTraits;
use MAChitgarha\Phirs\Util\Platform;
use PHPUnit\Framework\TestCase;

class WindowsEnvTest extends TestCase
{
    use GlobalTraits\PlatformChecker;

    private static $provider;

    public static function setUpBeforeClass(): void
    {
        self::skipIfPlatformUnsupported(Platform::WINDOWS);

        self::$provider = new WindowsDirectoryProvider();
    }

    public function test(): void
    {
        foreach ([
            ['UserProfile', 'E:\\', 'getHomePath'],
            ['AppData', 'E:\\AppData', 'getDataPath'],
            ['LocalAppData', 'E:\\AppData\\Local', 'getLocalDataPath'],
            ['Temp', 'D:\\Temp', 'getTemporaryPath'],
        ] as [$envName, $envValue, $pathGetterMethod]) {

            \putenv("$envName=$envValue");

            $this->assertEquals(
                $envValue,
                self::$provider->$pathGetterMethod(),
            );
        }
    }
}
