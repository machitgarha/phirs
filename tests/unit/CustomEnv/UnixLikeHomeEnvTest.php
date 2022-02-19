<?php

namespace MAChitgarha\Phirs\Test\Unit\CustomEnv;

use MAChitgarha\Phirs\Test\Unit\GlobalTraits;
use MAChitgarha\Phirs\Util\Platform;
use PHPUnit\Framework\TestCase;

class UnixLikeHomeEnvTest extends TestCase
{
    use Traits\SingleValueEnvTester;
    use Traits\EnvRestorer;
    use GlobalTraits\ProviderGetter;
    use GlobalTraits\PlatformChecker;

    private static $provider;

    public static function setUpBeforeClass(): void
    {
        self::skipIfPlatformUnsupported([
            Platform::LINUX,
            Platform::DARWIN,
            Platform::BSD,
            Platform::SOLARIS,
        ]);

        self::saveEnvValues();

        self::$provider = new class {
            // Using full name resolution not to conflict with other Traits\
            use \MAChitgarha\Phirs\Traits\UnixLikeHomePathProvider;
        };
    }

    public static function singleValueEnvProvider(): array
    {
        return [
            ['HOME', '/tmp/home/test', 'getHomePath'],
        ];
    }

    public static function getChangingEnvNames(): array
    {
        return \array_column(self::singleValueEnvProvider(), 0);
    }

    public static function tearDownAfterClass(): void
    {
        self::restoreEnvValues();
    }
}
