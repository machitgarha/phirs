<?php

namespace MAChitgarha\Phirs\PlatformSpecific;

use MAChitgarha\Phirs\Type;
use MAChitgarha\Phirs\Traits;

/**
 * Provider for Darwin-based OSes, such as MacOS and iOS.
 */
class DarwinDirectoryProvider implements Type\StandardDirectoryProvider
{
    use Traits\UnixLikeHomePathProvider;
    use Traits\HomeChildPathProvider;
    use Traits\HomeBased\CommonPathProvider;
    use Traits\HomeBased\DesktopPathProvider;
    use Traits\HomeBased\PublicPathProvider;
    use Traits\HomeBased\MoviesPathProvider {
        Traits\HomeBased\MoviesPathProvider::getVideosPath insteadof
            // @phan-suppress-next-line PhanRequiredTraitNotAdded
            Traits\HomeBased\CommonPathProvider;
    }

    private function getHomeLibraryChildPath(string ...$childPaths): string
    {
        return $this->getHomeChildPath('Library', ...$childPaths);
    }

    public function getCachePath(): string
    {
        return $this->getHomeLibraryChildPath('Caches');
    }

    public function getApplicationSupportPath(): string
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
