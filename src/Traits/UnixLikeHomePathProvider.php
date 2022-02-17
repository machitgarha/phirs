<?php

namespace MAChitgarha\Phirs\Traits;

use MAChitgarha\Phirs\Util\Env;
use MAChitgarha\Phirs\Util\Path;

trait UnixLikeHomePathProvider
{
    use HomeChildPathProvider;

    public function getHomePath(): string
    {
        return Path::returnNonEmpty(
            Env::get('HOME') ?? $this->getHomePathByPosixUid(),
            'home directory',
        );
    }

    /**
     * Thanks to https://stackoverflow.com/a/30926828/4215651.
     */
    private function getHomePathByPosixUid(): ?string
    {
        if (!\function_exists('posix_getuid')) {
            return null;
        }

        $userInfo = posix_getpwuid(posix_getuid());
        if (!$userInfo) {
            return null;
        }

        return $userInfo['dir'];
    }
}
