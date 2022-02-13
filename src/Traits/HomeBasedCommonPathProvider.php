<?php

namespace MAChitgarha\Phirs\Traits;

/**
 * Providing paths by appending related common directory name to home path.
 */
trait HomeBasedCommonPathProvider
{
    abstract public function getHomeChildPath(string ...$childPaths): ?string;

    public function getDocumentsPath(): ?string
    {
        return $this->getHomeChildPath('Documents');
    }

    public function getDownloadsPath(): ?string
    {
        return $this->getHomeChildPath('Downloads');
    }

    public function getMusicPath(): ?string
    {
        return $this->getHomeChildPath('Music');
    }

    public function getPicturesPath(): ?string
    {
        return $this->getHomeChildPath('Pictures');
    }

    public function getVideosPath(): ?string
    {
        return $this->getHomeChildPath('Videos');
    }
}
