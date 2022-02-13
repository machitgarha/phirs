<?php

namespace MAChitgarha\Phirs\PlatformSpecific;

use MAChitgarha\Phirs\Interfaces;
use MAChitgarha\Phirs\Traits;

class LinuxDirectoryProvider implements Interfaces\StandardDirectoryProvider
{
    use Traits\XdgBasedirSpec;
    use Traits\HomeBasedCommonPathProvider;
    use Traits\TemplatesPathProvider;
}
