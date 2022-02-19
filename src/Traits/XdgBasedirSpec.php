<?php

namespace MAChitgarha\Phirs\Traits;

use MAChitgarha\Phirs\Exception\PathNotFoundException;
use MAChitgarha\Phirs\Util\Env;
use MAChitgarha\Phirs\Util\Path;

/**
 * @todo Make sure paths are absolute (non-relative), to match the spec better.
 */
trait XdgBasedirSpec
{
    use UnixLikeHomePathProvider;
    use HomeChildPathProvider;

    private function getEnvOrHomeChildPath(
        string $envName,
        array $childPaths
    ): string {
        /*
         * Let's decide based on what happens. If the dedicated environment var
         * is set, everything is good, otherwise, we refer to the fallback path.
         * Here, if home directory is found, we have no problem, but else, we
         * should tell in the exception that the environment variable is not
         * set, plus the home directory cannot be found.
         *
         * So, obviously, the whole expression will not be null, so we don't
         * need to check it with something like Util::returnNonNull().
         */
        try {
            return Env::get($envName) ??
                $this->getHomeChildPath(...$childPaths);
        } catch (PathNotFoundException $e) {
            throw new PathNotFoundException(
                'requested directory',
                "env $envName not set and {$e->getMessage()}"
            );
        }
    }

    public function getConfigPath(): string
    {
        return $this->getEnvOrHomeChildPath('XDG_CONFIG_HOME', ['.config']);
    }

    public function getCachePath(): string
    {
        return $this->getEnvOrHomeChildPath('XDG_CACHE_HOME', ['.cache']);
    }

    public function getDataPath(): string
    {
        return $this->getEnvOrHomeChildPath(
            'XDG_DATA_HOME',
            ['.local', 'share']
        );
    }

    public function getStatePath(): string
    {
        return $this->getEnvOrHomeChildPath(
            'XDG_STATE_HOME',
            ['.local', 'state'],
        );
    }

    public function getExecutablePath(): string
    {
        return $this->getHomeChildPath('.local', 'bin');
    }

    public function getRuntimePath(): string
    {
        return Path::returnNonEmpty(
            Env::get('XDG_RUNTIME_DIR'),
            'runtime directory'
        );
    }

    public function getConfigPathSet(): array
    {
        return Env::getColonedArray('XDG_CONFIG_DIRS') ??
            ['/etc/xdg'];
    }

    public function getDataPathSet(): array
    {
        return Env::getColonedArray('XDG_DATA_DIRS') ??
            ['/usr/local/share', '/usr/share'];
    }
}
