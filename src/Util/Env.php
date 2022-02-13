<?php

namespace MAChitgarha\Phirs\Util;

class Env
{
    public static function get(string $name): ?string
    {
        return getenv($name) ?: null;
    }

    /**
     * Split the value of environment variable by colons, and return as array.
     */
    public static function getColonedArray(string $name): ?array
    {
        $rawValue = getenv($name);

        if (empty($rawValue)) {
            return null;
        }
        return explode(':', $rawValue);
    }
}
