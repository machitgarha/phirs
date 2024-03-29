<?php

namespace MAChitgarha\Phirs\Test\Unit\CustomEnv;

use MAChitgarha\Phirs\Test\Unit\GlobalTraits;
use MAChitgarha\Phirs\Util\Platform;
use PHPUnit\Framework\TestCase;

/**
 * Test changing various XDG_* environment variables for a provider making use
 * of XdgBasedirSpec trait.
 */
class XdgEnvTest extends TestCase
{
    use Traits\SingleValueEnvTester;
    use Traits\ColonedArrayEnvTester;
    use Traits\EnvRestorer;
    use GlobalTraits\ProviderGetter;
    use GlobalTraits\PlatformChecker;

    private static $provider;

    public static function setUpBeforeClass(): void
    {
        self::skipIfPlatformUnsupported(Platform::LINUX);

        self::saveEnvValues();

        self::$provider = new class {
            // Using full name resolution not to conflict with other Traits\
            use \MAChitgarha\Phirs\Traits\XdgBasedirSpec;
        };
    }

    public static function singleValueEnvProvider(): array
    {
        return [
            ['XDG_CONFIG_HOME', '/tmp/test/.config', 'getConfigPath'],
            ['XDG_CACHE_HOME', '/tmp/test/.cache', 'getCachePath'],
            ['XDG_DATA_HOME', '/tmp/test/.local/share', 'getDataPath'],
            ['XDG_STATE_HOME', '/tmp/test/.local/state', 'getStatePath'],
            ['XDG_RUNTIME_DIR', '/tmp/test/.runtime', 'getRuntimePath'],
        ];
    }

    public static function colonedArrayEnvProvider(): array
    {
        return [
            ['XDG_CONFIG_DIRS', ['/etc', '/tmp/etc'], 'getConfigPathSet'],
            ['XDG_DATA_DIRS', ['/var/local/share', '/tmp'], 'getDataPathSet'],
        ];
    }

    public static function getChangingEnvNames(): array
    {
        return \array_column([
            ...self::singleValueEnvProvider(),
            ...self::colonedArrayEnvProvider()
        ], 0);
    }

    public static function tearDownAfterClass(): void
    {
        self::restoreEnvValues();
    }
}
