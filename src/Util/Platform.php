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

    public static function autoDetect(): string
    {
        if (static::isLinux()) {
            return static::LINUX;
        }
        if (static::isDarwin()) {
            return static::MAC_OS;
        }
        if (static::isWindows()) {
            return static::WINDOWS;
        }
        if (static::isBsd()) {
            return static::BSD;
        }
        if (static::isSolaris()) {
            return static::SOLARIS;
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
