<?php

namespace MAChitgarha\Phirs\Traits\HomeBased;

trait DesktopPathProvider
{
    abstract public function getHomeChildPath(string ...$childPaths): string;

    public function getDesktopPath(): string
    {
        return $this->getHomeChildPath('Desktop');
    }
}
