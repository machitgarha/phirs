<?php

namespace MAChitgarha\Phirs\Interfaces;

interface HomeDirectoryProvider
{
    public function getHomePath(): string;

    /**
     * Return a child directory absolute path relative to user home path.
     *
     * The main purpose of this is to eliminate the need to check for the home
     * path be not null, otherwise return null (instead of a non-sense relative
     * path).
     *
     * @param string ...$paths The directory names to be appended to the home
     * path, in order.
     */
    public function getHomeChildPath(string ...$childPaths): string;
}
