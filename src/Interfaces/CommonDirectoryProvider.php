<?php

namespace MAChitgarha\Phirs\Interfaces;

/**
 * Provide common well-known paths for storing media files, documents, etc.
 */
class CommonDirectoryProvider
{
    public function getDocumentsPath(): string;
    public function getDownloadsPath(): string;
    public function getMusicPath(): string;
    public function getPicturesPath(): string;
    public function getVideosPath(): string;
}
