<?php

namespace MAChitgarha\Phirs\PlatformSpecific;

use MAChitgarha\Phirs\Interfaces;
use MAChitgarha\Phirs\Traits;
use Symfony\Component\Filesystem\Path;

class LinuxDirectoryProvider implements Interfaces\StandardDirectoryProvider
{
    use Traits\XdgBasedirSpec;
    use Traits\HomeBased\CommonPathProvider;
    use Traits\HomeBased\TemplatesPathProvider;

    public function getFontsPath(): string
    {
        return Path::join($this->getDataPath(), 'fonts');
    }

    public function getExecutablesPath(): string
    {
        return $this->getHomeChildPath('.local', 'bin');
    }
}
