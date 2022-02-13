<?php

namespace MAChitgarha\Phirs\Traits;

use MAChitgarha\Phirs\Util\Env;

trait UnixLikeHomePath
{
    public function getHomePath(): ?string
    {
        return Env::get('HOME') ?? $this->getHomePathByPosixUid();
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
