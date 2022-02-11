<?php

namespace MAChitgarha\Phirs;

/**
 * Providing user directory paths.
 */
interface DirectoryProviderInterface
{
    public function getHomePath(): string;

    public function getCachePath(): string;
    public function getConfigPath(): string;
    public function getDataPath(): string;

    public function getDesktop(): string;
    public function getDocumentPath(): string;
    public function getDownloadPath(): string;
    public function getMusicPath(): string;
    public function getPicturePath(): string;
    public function gePublicPath(): string;
    public function getVideoPath(): string;
}
