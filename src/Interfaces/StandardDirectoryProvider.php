<?php

namespace MAChitgarha\Phirs\Interfaces;

/**
 * Providing user directory paths.
 */
interface StandardDirectoryProvider
{
    public function getHomePath(): string;

    public function getCachePath(): string;
    public function getConfigPath(): string;
    public function getDataPath(): string;

    public function getDesktopPath(): string;
    public function getDocumentPath(): string;
    public function getDownloadPath(): string;
    public function getMusicPath(): string;
    public function getPicturePath(): string;
    public function getPublicPath(): string;
    public function getVideoPath(): string;
}
