<?php

namespace MAChitgarha\Phirs\PlatformSpecific;

use MAChitgarha\Phirs\Types;
use MAChitgarha\Phirs\Traits;
use Symfony\Component\Filesystem\Path;

class LinuxDirectoryProvider implements Types\StandardDirectoryProvider
{
    use Traits\XdgBasedirSpec;
    use Traits\HomeBased\CommonPathProvider;
    use Traits\HomeBased\DesktopPathProvider;
    use Traits\HomeBased\PublicPathProvider;
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
