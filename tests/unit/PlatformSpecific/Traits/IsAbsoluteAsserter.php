<?php

namespace MAChitgarha\Phirs\Test\Unit\PlatformSpecific\Traits;

use Symfony\Component\Filesystem\Path;

trait IsAbsoluteAsserter
{
    abstract public static function assertTrue($value): void;

    public static function assertIsAbsolute(string $path): void
    {
        self::assertTrue(Path::isAbsolute($path));
    }
}
