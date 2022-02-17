<?php

namespace MAChitgarha\Phirs\Exception;

class PathNotFoundException extends Exception
{
    /**
     * @param string $pathName Name of the path that cannot be found.
     * @param string $extra Extra description in parentheses.
     */
    public function __construct(string $pathName, string $extra = '')
    {
        parent::__construct(
            "Cannot find or detect $pathName path" .
            ($extra ? " ($extra)" : '')
        );
    }
}
