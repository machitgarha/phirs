<?php

namespace MAChitgarha\Phirs\Test\Unit\PlatformSpecific\Traits;

trait ProviderGetter
{
    private static function getProvider(): object
    {
        return self::$provider;
    }
}
