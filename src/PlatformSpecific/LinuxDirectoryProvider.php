<?php

namespace MAChitgarha\Phirs\PlatformSpecific;

use MAChitgarha\Phirs\Type;
use MAChitgarha\Phirs\Traits;
use Symfony\Component\Filesystem\Path;

class LinuxDirectoryProvider implements Type\StandardDirectoryProvider
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
}
