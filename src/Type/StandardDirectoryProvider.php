<?php

namespace MAChitgarha\Phirs\Type;

/**
 * Providing standard paths, tends to be cross-platform.
 */
interface StandardDirectoryProvider extends
    HomeDirectoryProvider,
    CommonDirectoryProvider
{
    public function getCachePath(): string;
    public function getConfigPath(): string;
    public function getDataPath(): string;
}

/*
 * As it tends to be cross-platform, and by it, we mean not to restrict into
 * desktop space, it has to be minimal. Not meaning adding features are
 * impossible, but care must be taken in the case of any changes.
 *
 * But hey, nothing is ideal, so this is not going to be 100% cross-platform.
 */
