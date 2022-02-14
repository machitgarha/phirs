<?php

namespace MAChitgarha\Phirs\Util;

class ExceptionMessageFactory
{
    public static function buildCannotFindPath(string $pathName): string
    {
        return "Cannot find or detect path of $pathName";
    }
}
