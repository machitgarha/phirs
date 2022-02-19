<?php

namespace MAChitgarha\Phirs\Traits\HomeBased;

trait MoviesPathProvider
{
    abstract public function getHomeChildPath(string ...$childPaths): string;

    public function getMoviesPath(): string
    {
        return $this->getHomeChildPath('Movies');
    }

    public function getVideosPath(): string
    {
        return $this->getMoviesPath();
    }
}
