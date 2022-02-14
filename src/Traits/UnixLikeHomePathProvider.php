<?php

namespace MAChitgarha\Phirs\Traits;

use MAChitgarha\Phirs\Util\Env;
use MAChitgarha\Phirs\Util\Util;
use MAChitgarha\Phirs\Util\ExceptionMessageFactory;

trait UnixLikeHomePathProvider
{
    use HomeChildPathProvider;

    public function getHomePath(): string
    {
        return Util::returnNonNull(
            Env::get('HOME') ?? $this->getHomePathByPosixUid(),
            ExceptionMessageFactory::buildCannotFindPath('home directory'),
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
