<?php

namespace MAChitgarha\Phirs\PlatformSpecific;

use MAChitgarha\Phirs\Interfaces;
use MAChitgarha\Phirs\Traits;
use MAChitgarha\Phirs\Util\Env;
use MAChitgarha\Phirs\Util\Util;
use Symfony\Component\Filesystem\Path;

class WindowsDirectoryProvider implements Interfaces\StandardDirectoryProvider
{
    use Traits\HomeBased\CommonPathProvider;
    use Traits\HomeBased\DesktopPathProvider;
    use Traits\HomeBased\PublicPathProvider;
    use Traits\HomeBased\TemplatesPathProvider;

    public function getHomePath(): string
    {
        return Util::returnNonNull(
            Env::get('UserProfile') ?? $this->getHomeDriveHomePath(),
            'Cannot detect home folder',
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
                    Path::join($carry, $item),
            // Prevent from halting at the very beginning
            ''
        );
    }

    public function getDataPath(): string
    {
        return Util::returnNonNull(
            Env::get('AppData'),
            'Cannot find roaming application data folder path'
        );
    }

    public function getLocalDataPath(): string
    {
        return Util::returnNonNull(
            Env::get('LocalAppData'),
            'Could not find local application data folder path'
        );
    }

    public function getCachePath(): string
    {
        return $this->getLocalDataPath();
    }

    public function getConfigPath(): string
    {
        return $this->getDataPath();
    }
}
