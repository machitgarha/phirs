<?php

namespace MAChitgarha\Phirs\Traits;

trait TemplatesPathProvider
{
    abstract public function getHomeChildPath(string ...$childPaths): string;

    public function getTemplatesPath(): string
    {
        return $this->getHomeChildPath('Templates');
    }
}
