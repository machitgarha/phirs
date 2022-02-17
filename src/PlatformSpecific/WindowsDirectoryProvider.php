<?php

namespace MAChitgarha\Phirs\PlatformSpecific;

use MAChitgarha\Phirs\Type;
use MAChitgarha\Phirs\Traits;
use MAChitgarha\Phirs\Util\Env;
use MAChitgarha\Phirs\Util\Path;
use Symfony\Component\Filesystem\Path as SymfonyPath;

class WindowsDirectoryProvider implements Type\StandardDirectoryProvider
{
    use Traits\HomeChildPathProvider;
    use Traits\HomeBased\CommonPathProvider;
    use Traits\HomeBased\DesktopPathProvider;
    use Traits\HomeBased\PublicPathProvider;
    use Traits\HomeBased\TemplatesPathProvider;

    public function getHomePath(): string
    {
        return Path::returnNonEmpty(
            Env::get('UserProfile') ?? $this->getHomeDriveHomePath(),
            'home folder',
        );
    }

    private function getHomeDriveHomePath(): ?string
    {
        return \array_reduce(
            [
                Env::get('HomeDrive'),
                Env::get('HomePath'),
            ],
            fn(?string $carry, ?string $item) =>
                is_null($carry) || is_null($item) ? null :
                    SymfonyPath::join($carry, $item),
            // Prevent from halting at the very beginning
            ''
        );
    }

    public function getDataPath(): string
    {
        return Path::returnNonEmpty(
            Env::get('AppData'),
            'AppData folder'
        );
    }

    private function getLocalDataPathNullable(): ?string
    {
        return Env::get('LocalAppData');
    }

    public function getLocalDataPath(): string
    {
        return Path::returnNonEmpty(
            $this->getLocalDataPathNullable(),
            'LocalAppData folder',
        );
    }

    private function getTemporaryPathNullable(): ?string
    {
        return Env::get('Temp');
    }

    public function getTemporaryPath(): string
    {
        return Path::returnNonEmpty(
            $this->getTemporaryPathNullable(),
            'temporary folder',
        );
    }

    public function getCachePath(): string
    {
        return Path::returnNonEmpty(
            $this->getLocalDataPathNullable() ??
                $this->getTemporaryPathNullable(),
            'cache folder (any of LocalAppData or temporary folders)'
        );
    }

    public function getConfigPath(): string
    {
        return $this->getDataPath();
    }
}
