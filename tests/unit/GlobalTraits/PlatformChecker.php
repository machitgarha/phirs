<?php

namespace MAChitgarha\Phirs\Test\Unit\GlobalTraits;

use MAChitgarha\Phirs\Util\Platform;

trait PlatformChecker
{
    abstract public static function markTestSkipped(string $message): void;

    /**
     * Skips the test if the current platform is not among supported platforms.
     */
    public static function skipIfPlatformUnsupported(
        string|array $supportedPlatforms
    ): void {
        $supportedPlatforms = (array)($supportedPlatforms);
        $currentPlatform = Platform::autoDetect();

        $toSkip = true;
        foreach ($supportedPlatforms as $supportedPlatform) {
            if ($currentPlatform === $supportedPlatform) {
                $toSkip = false;
                break;
            }
        }

        if ($toSkip) {
            self::markTestSkipped(
                'Current platform is not supported for the test, must be ' . (
                    count($supportedPlatforms) === 1 ? $supportedPlatforms[0] :
                        ('one of ' . join(',', $supportedPlatforms))
                )
            );
        }
    }
}
