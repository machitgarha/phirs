<?php

namespace MAChitgarha\Phirs\Traits\HomeBased;

trait PublicPathProvider
{
    abstract public function getHomeChildPath(string ...$childPaths): string;

    public function getPublicPath(): string
    {
        return $this->getHomeChildPath('Public');
    }
}
