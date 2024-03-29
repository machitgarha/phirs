<?php

namespace MAChitgarha\Phirs\Traits;

use Symfony\Component\Filesystem\Path;

/**
 * Generalized provider for HomeDirectoryProvider::getHomeChildPath().
 */
trait HomeChildPathProvider
{
    abstract public function getHomePath(): string;

    public function getHomeChildPath(string ...$childPaths): string
    {
        return Path::join($this->getHomePath(), ...$childPaths);
    }
}
