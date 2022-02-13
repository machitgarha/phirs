<?php

namespace MAChitgarha\Phirs\Traits;

use MAChitgarha\Phirs\Util\Env;

/**
 * @todo Make sure paths are absolute (non-relative), to match the spec better.
 */
trait XdgBasedirSpec
{
    use UnixLikeHomePathProvider;

    public function getDataPath(): ?string
    {
        return Env::get('XDG_DATA_HOME') ??
            $this->getHomeChildPath('.local', 'share');
    }

    public function getConfigPath(): ?string
    {
        return Env::get('XDG_CONFIG_HOME') ??
            $this->getHomeChildPath('.config');
    }

    public function getCachePath(): ?string
    {
        return Env::get('XDG_CACHE_DIRS') ??
            $this->getHomeChildPath('.cache');
    }

    public function getStatePath(): ?string
    {
        return Env::get('XDG_STATE_HOME') ??
            $this->getHomeChildPath('.local', 'state');
    }

    public function getExecutablePath(): ?string
    {
        return $this->getHomeChildPath('.local', 'bin');
    }

    public function getRuntimePath(): ?string
    {
        return Env::get('XDG_RUNTIME_DIR');
    }

    public function getDataPathSet(): ?array
    {
        return Env::getColonedArray('XDG_DATA_DIRS') ??
            ['/usr/local/share/', '/usr/share/'];
    }

    public function getConfigPathSet(): ?array
    {
        return Env::getColonedArray('XDG_CONFIG_DIRS') ??
            ['/etc/xdg'];
    }
}
