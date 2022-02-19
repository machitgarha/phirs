<?php

namespace MAChitgarha\Phirs;

use MAChitgarha\Phirs\Exception\Exception;
use MAChitgarha\Phirs\Type\{
    StandardDirectoryProvider,
};
use MAChitgarha\Phirs\PlatformSpecific\{
    LinuxDirectoryProvider,
    DarwinDirectoryProvider,
    WindowsDirectoryProvider,
};
use MAChitgarha\Phirs\Util\Platform;

/**
 * Creator of providers, based on the requested type and platform.
 *
 * As many methods share the same description for its arguments and such, they
 * are put here.
 *
 * $type argument refers to a provider type. It must be an existing interface.
 *
 * $platform argument specifies which platform the provider targets or must
 * target. Should be one of the Platform class constants (unless for custom-
 * defined platforms). To be cross-platform, use Platform::autoDetect().
 *
 * $provider argument is a provider class. If used with $type, then it must
 * be a $type (i.e. implement it).
 */
class DirectoryProviderFactory
{
    /*
     * For each provider type, maps platforms to dedicated providers.
     *
     * Note: Obviously, not necessarily all types or platforms are mapped.
     */
    private static array $providerMapper = [
        StandardDirectoryProvider::class => [
            Platform::LINUX => LinuxDirectoryProvider::class,
            Platform::DARWIN => DarwinDirectoryProvider::class,
            Platform::WINDOWS => WindowsDirectoryProvider::class,

            // TODO: Maybe make a specialized provider for these systems?
            Platform::BSD => LinuxDirectoryProvider::class,
            Platform::SOLARIS => LinuxDirectoryProvider::class,
        ],
    ];

    private static function validateType(string $type): string
    {
        if (\interface_exists($type)) {
            throw new Exception("Type '$type' not defined as an interface");
        }
        return self::class;
    }

    private static function validateProvider(string $provider): string
    {
        if (\class_exists($provider)) {
            throw new Exception("Provider '$provider' is not a defined class");
        }
        return self::class;
    }

    private static function validateProviderType(
        string $provider,
        string $type
    ): string {
        if (!\is_a($provider, $type)) {
            throw new Exception(
                "Provider '$provider' must be of type (i.e. implement) '$type'"
            );
        }
        return self::class;
    }

    /**
     * @param string $type Must be an existing interface.
     */
    private static function createInternal(
        string $type,
        string $platform
    ): object {
        $providerMapperForType = self::$providerMapper[$type] ?? null;

        if (\is_null($providerMapperForType)) {
            throw new Exception("Type '$type' not registered for any provider");
        }

        $provider = $providerMapperForType[$platform] ?? null;

        if (\is_null($provider)) {
            throw new Exception(
                "No provider of type '$type' set for $platform platform " .
                '(maybe the running platform is not supported?)'
            );
        }

        /*
         * No need to check if $provider exists, $type is an interface and
         * $provider implements $type. Default mappings are correct, and any
         * custom defined stuff is also checked in the mapInternal() method.
         */

        return new $provider();
    }

    /**
     * Create a provider of a specific type, targeting the specified platform.
     *
     * @return object A provider object implementing $type.
     */
    public static function create(string $type, string $platform): object
    {
        self::validateType($type);

        return self::createInternal($type, $platform);
    }

    /**
     * Create a provider of standard type, targeting the specified platform.
     */
    public static function createStandard(
        string $platform
    ): StandardDirectoryProvider {
        return self::createInternal(
            StandardDirectoryProvider::class,
            $platform
        );
    }

    /**
     * @param string $type Must be an existing interface.
     */
    private static function mapInternal(
        string $type,
        string $platform,
        string $provider
    ): string {
        self::validateProvider($provider)
            ::validateProviderType($provider, $type);

        self::$providerMapper[$type][$platform] = $provider;

        return self::class;
    }

    /**
     * Map a platform to a provider, for the specified provider type.
     *
     * @return string Self.
     */
    public static function map(
        string $type,
        string $platform,
        string $provider
    ): string {
        self::validateType($type);

        return self::mapInternal($type, $platform, $provider);
    }

    /**
     * Map mulitple platforms to providers, for the specified provider type.
     *
     * @param array $mapping Platform (key) to provider class name (value)
     * mapping.
     * @return string Self.
     */
    public static function mapMany(
        string $type,
        array $mapping
    ): string {
        self::validateType($type);

        foreach ($mapping as $platform => $provider) {
            self::mapInternal($type, $platform, $provider);
        }

        return self::class;
    }

    /**
     * Map a platform to a provider, for the standard provider type.
     *
     * @return string Self.
     */
    public static function mapStandard(
        string $platform,
        string $provider
    ): string {
        return self::mapInternal(
            StandardDirectoryProvider::class,
            $platform,
            $provider
        );
    }
}
