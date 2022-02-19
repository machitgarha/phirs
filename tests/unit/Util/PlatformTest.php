<?php

namespace MAChitgarha\Phirs\Test\Unit\Util;

use MAChitgarha\Phirs\Util\Platform;
use PHPUnit\Framework\TestCase;

class PlatformTest extends TestCase
{
    public function testOverrideDefaultDetector(): void
    {
        $myPlatform = new class extends Platform {
            protected static function getCustomDetectors(): array
            {
                return [self::UNKNOWN => fn() => true];
            }
        };

        $this->assertSame($myPlatform->autoDetect(), $myPlatform::UNKNOWN);
    }

    public function testDefaultDetectorAsFallback(): void
    {
        $currentPlatform = Platform::autoDetect();

        $myPlatform = new class extends Platform {
            protected static function getCustomDetectors(): array
            {
                global $currentPlatform;
                return [$currentPlatform => fn() => false];
            }
        };

        $this->assertSame($myPlatform->autoDetect(), $currentPlatform);
    }

    public function testCustomPlatform(): void
    {
        $myPlatform = new class extends Platform {
            public const MINIX = 'Minix';

            protected static function getCustomDetectors(): array
            {
                return [self::MINIX => fn() => true];
            }
        };

        $this->assertSame($myPlatform->autoDetect(), $myPlatform::MINIX);
    }
}
