<?php

namespace MAChitgarha\Phirs\PlatformSpecific;

use MAChitgarha\Phirs\Definitions;
use MAChitgarha\Phirs\Traits;

/**
 * Provider for Darwin-based OSes, such as MacOS and iOS.
 */
class DarwinDirectoryProvider implements Definitions\StandardDirectoryProvider
{
    use Traits\UnixLikeHomePathProvider;
    use Traits\HomeBased\CommonPathProvider;
    use Traits\HomeBased\DesktopPathProvider;
    use Traits\HomeBased\MoviesPathProvider {
        MoviesPathProvider::getVideosPath insteadof CommonPathProvider;
    }
    use Traits\HomeBased\PublicPathProvider;

    private function getHomeLibraryChildPath(string ...$childPaths): string
    {
        return $this->getHomeChildPath('Library', ...$childPaths);
    }

    public function getCachePath(): string
    {
        return $this->getHomeLibraryChildPath('Caches');
    }

    private function getApplicationSupportPath(): string
    {
        return $this->getHomeLibraryChildPath('Application Support');
    }

    public function getConfigPath(): string
    {
        return $this->getApplicationSupportPath();
    }

    public function getDataPath(): string
    {
        return $this->getApplicationSupportPath();
    }

    public function getFontsPath(): string
    {
        return $this->getHomeLibraryChildPath('Fonts');
    }

    public function getPreferencesPath(): string
    {
        return $this->getHomeLibraryChildPath('Preferences');
    }
}
