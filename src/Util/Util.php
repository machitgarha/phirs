<?php

namespace MAChitgarha\Phirs\Util;

use Exception;

class Util
{
    /**
     * Return a value if not null, otherwise throws an exception.
     *
     * @return mixed The value will not be null.
     * @todo Make the default exception class a custom one.
     */
    public static function returnNonNull(
        $value,
        string $exceptionMessage,
        string $exceptionClass = Exception::class
    ) {
        if ($value !== null) {
            return $value;
        }
        throw new $exceptionClass($exceptionMessage);
    }
}
