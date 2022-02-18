<?php

namespace MAChitgarha\Phirs\Test\Unit\CustomEnv;

use MAChitgarha\Phirs\Test\Unit\GlobalTraits;
use MAChitgarha\Phirs\Util\Platform;
use PHPUnit\Framework\TestCase;

/**
 * Test changing various XDG_* environment variables for a provider using
 * XdgBasedirSpec trait.
 */
class XdgEnvTest extends TestCase
{
    use GlobalTraits\PlatformChecker;

    private static $provider;

    public static function setUpBeforeClass(): void
    {
        self::skipIfPlatformUnsupported(Platform::LINUX);

        self::$provider = new class {
            // Using full name resolution not to conflict with other Traits\
            use \MAChitgarha\Phirs\Traits\XdgBasedirSpec;
        };
    }

    public function testSingleValueEnvs(): void
    {
        foreach ([
            ['XDG_CONFIG_HOME', '/tmp/test/.config', 'getConfigPath'],
            ['XDG_CACHE_HOME', '/tmp/test/.cache', 'getCachePath'],
            ['XDG_DATA_HOME', '/tmp/test/.local/share', 'getDataPath'],
            ['XDG_STATE_HOME', '/tmp/test/.local/state', 'getStatePath'],
            ['XDG_RUNTIME_DIR', '/tmp/test/.runtime', 'getRuntimePath'],
        ] as [$envName, $envValue, $pathGetterMethod]) {

            \putenv("$envName=$envValue");

            $this->assertSame(
                $envValue,
                self::$provider->$pathGetterMethod(),
            );
        }
    }

    public function testMultiValueEnvs(): void
    {
        foreach ([
            ['XDG_CONFIG_DIRS', '/etc:/tmp/etc', 'getConfigPathSet'],
            ['XDG_DATA_DIRS', '/var/local/share:/tmp/share', 'getDataPathSet'],
        ] as [$envName, $envValue, $pathGetterMethod]) {

            \putenv("$envName=$envValue");

            $this->assertSame(
                $envValue,
                \join(':', self::$provider->$pathGetterMethod()),
            );
        }
    }
}
