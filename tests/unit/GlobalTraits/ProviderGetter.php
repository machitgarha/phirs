<?php

namespace MAChitgarha\Phirs\Test\Unit\GlobalTraits;

trait ProviderGetter
{
    private static function getProvider(): object
    {
        return self::$provider;
    }
}
