<?php

namespace MAChitgarha\Phirs\Interfaces;

interface PublicDirectoryProvider
{
    public function getPublicPath(): ?string;
}
