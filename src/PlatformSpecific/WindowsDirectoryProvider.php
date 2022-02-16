<?php

namespace MAChitgarha\Phirs\PlatformSpecific;

use MAChitgarha\Phirs\Definitions;
use MAChitgarha\Phirs\Traits;
use MAChitgarha\Phirs\Util\Env;
use MAChitgarha\Phirs\Util\ExceptionMessageFactory;
use MAChitgarha\Phirs\Util\Util;
use Symfony\Component\Filesystem\Path;

class WindowsDirectoryProvider implements Definitions\StandardDirectoryProvider
{
    use Traits\HomeBased\CommonPathProvider;
    use Traits\HomeBased\DesktopPathProvider;
    use Traits\HomeBased\PublicPathProvider;
    use Traits\HomeBased\TemplatesPathProvider;

    public function getHomePath(): string
    {
        return Util::returnNonNull(
            Env::get('UserProfile') ?? $this->getHomeDriveHomePath(),
            ExceptionMessageFactory::buildCannotFindPath('home folder'),
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
            ExceptionMessageFactory::buildCannotFindPath('AppData folder'),
        );
    }

    private function getLocalDataPathNullable(): ?string
    {
        return Env::get('LocalAppData');
    }

    public function getLocalDataPath(): string
    {
        return Util::returnNonNull(
            $this->getLocalDataPathNullable(),
            ExceptionMessageFactory::buildCannotFindPath('LocalAppData folder'),
        );
    }

    private function getTemporaryPathNullable(): ?string
    {
        return Env::get('Temp');
    }

    public function getTemporaryPath(): string
    {
        return Util::returnNonNull(
            $this->getTemporaryPathNullable(),
            ExceptionMessageFactory::buildCannotFindPath('temporary folder'),
        );
    }

    public function getCachePath(): string
    {
        return $this->getLocalDataPathNullable() ??
            $this->getTemporaryPathNullable();
    }

    public function getConfigPath(): string
    {
        return $this->getDataPath();
    }
}
