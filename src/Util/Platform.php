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

    private static $mapper = [
        static::LINUX => fn() => static::isLinux(),
        static::DARWIN => fn() => static::isDarwin(),
        static::WINDOWS => fn() => static::isWindows(),
        static::BSD => fn() => static::isBsd(),
        static::SOLARIS => fn() => static::isSolaris(),
    ];

    public static function autoDetect(): string
    {
        foreach (self::$mapper as $platform => $isPlatform) {
            if ($isPlatform()) {
                return $platform;
            }
        }

        return static::UNKNOWN;
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
