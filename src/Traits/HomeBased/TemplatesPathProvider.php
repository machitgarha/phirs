<?php

namespace MAChitgarha\Phirs\Traits\HomeBased;

trait TemplatesPathProvider
{
    abstract public function getHomeChildPath(string ...$childPaths): string;

    public function getTemplatesPath(): string
    {
        return $this->getHomeChildPath('Templates');
    }
}
