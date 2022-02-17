<?php

namespace MAChitgarha\Phirs\Util;

use MAChitgarha\Phirs\Exception\PathNotFoundException;

class Path
{
    /**
     * Checks if a path is not empty.
     *
     * @param string $pathName Name of the directory the path belongs to.
     */
    public static function returnNonEmpty(
        ?string $path,
        string $pathName
    ): string {
        if ($path === null || $path === '') {
            throw new PathNotFoundException($pathName);
        }
        return $path;
    }
}
