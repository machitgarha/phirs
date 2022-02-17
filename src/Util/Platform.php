<?php

namespace MAChitgarha\Phirs\Util;

class Platform
{
    public const LINUX = 'Linux';
    public const DARWIN = 'Darwin';
    public const WINDOWS = 'Windows';
    public const BSD = 'BSD';
    public const SOLARIS = 'Solaris';
    public const UNKNOWN = 'Unknown';

    private static array $detectors = [
        self::LINUX => fn() => self::isLinux(),
        self::DARWIN => fn() => self::isDarwin(),
        self::WINDOWS => fn() => self::isWindows(),
        self::BSD => fn() => self::isBsd(),
        self::SOLARIS => fn() => self::isSolaris(),
    ];

    /**
     * Custom-defined mappings of platforms (keys) to detectors (values).
     *
     * These detectors will run _before_ the defaults. This way, you can
     * specialize an available platform as a new platform, or prepend rules for
     * detecting a platform.
     */
    protected static array $customDetectors = [];

    public static function autoDetect(): string
    {
        foreach (
            static::$customDetectors + self::$detectors
                as $platform => $detector
        ) {
            if ($detector()) {
                return $platform;
            }
        }

        return self::UNKNOWN;
    }

    private static function isLinux(): bool
    {
        return PHP_OS_FAMILY === 'Linux';
    }

    private static function isDarwin(): bool
    {
        return PHP_OS_FAMILY === 'Darwin';
    }

    private static function isWindows(): bool
    {
        return PHP_OS_FAMILY === 'Windows';
    }

    private static function isBsd(): bool
    {
        return PHP_OS_FAMILY === 'BSD';
    }

    private static function isSolaris(): bool
    {
        return PHP_OS_FAMILY === 'Solaris';
    }
}
