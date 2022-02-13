<?php

namespace MAChitgarha\Phirs\Interfaces;

/**
 * Providing user directory paths.
 */
interface StandardDirectoryProvider extends
    HomeDirectoryProvider,
    CommonDirectoryProvider
{
    public function getCachePath(): ?string;
    public function getConfigPath(): ?string;
    public function getDataPath(): ?string;

    public function getDesktopPath(): ?string;
    public function getPublicPath(): ?string;
}
