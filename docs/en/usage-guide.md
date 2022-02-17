# Usage Guide

**Note:** In the examples, some of the `use` statements are eliminated.

## Overview of the Main Concepts

Let's start with defining two important concepts:

-   **(Directory) Provider:** A class providing the path of directories for one or more platforms. For instance, `LinuxDirectoryProvider` or `WindowsDirectoryProvider`.

-   **(Directory) Provider Type:** An interface defining what a provider must implement. In other words, it specifies what directories must a provider provide the path of. It may be referred to as type.

    For example, `StandardDirectoryProvider` is a type enforcing providers to provide paths of directories available across (almost) all platforms. The term standard is in the context of the library, not a real standard or specification. You could call it `CrossPlatformDirectoryProvider` in your mind.

In the examples above, Linux and Windows (and also Darwin) providers are all of standard type (i.e. implements `StandardDirectoryProvider` interface).

**Note:** Providers and provider types are under namespaces `PlatformSpecific` and `Type`, respectively.

## Creating a Provider Object

The main method to get a provider is via `DirectoryProviderFactory`. The other way is to instantiate the dedicated provider directly.

### Using `DirectoryProviderFactory` Static Class

The class helps you creating provider of a specific type, for a specific platform. For example, let's create a standard provider for Darwin (e.g. Mac OS) platform:

```php
$dirProvider = DirectoryProviderFactory::createStandard(Platform::DARWIN);
```

A better approach is to get provider based on the current platform:

```php
$dirProvider = DirectoryProviderFactory::createStandard(Platform::autoDetect());
```

You can also pass the provider type manually to the `create()` method:

```php
$dirProvider = DirectoryProviderFactory::create(
    StandardDirectoryProvider::class,
    Platform::autoDetect()
);
```

**Note:** By default, only standard provider type mappings are defined. To extend the functionality, see [Extending `DirectoryProviderFactory`](#extending-directoryproviderfactory).

### Instantiating Dedicated Provider

Let's create a Linux provider directly:

```php
$dirProvider = new LinuxDirectoryProvider();
```

**Tip:** If you want to target a specific platform, both previous and current methods work. However, each has its benefits. The first one makes porting your application to other platforms more easily. The second one enables you to use paths of platform-specific directories more confidently.

## Getting Path of Directories

Based on which method you used to create a provider, you can use one of `get*Path()` methods to get path of a specific directory.

```php
// Get cache directory path
$cacheDir = $dirProvider->getCachePath();
```

If you instantiated a provider directly, e.g. Linux provider, you may use platform-specific path getters, however:

```php
// Not available on Windows or Mac OS
$executables = $dirProvider->getExecutablesPath();
```

**Important Note:** The returning paths are not checked to exist, be accessible (readable or writeable), or be absolute (i.e. not relative), because different users may have different needs.

## Exception Handling

All getter methods throw `PathNotFoundException` if the path cannot be built. There may be different reasons to this. For example, neither `%UserProfile%` nor `%HomeDrive%` environment variables defined on a Windows platform.

`DirectoryProviderFactory` class throws `Exception`s (library-defined) in certain conditions, like wrong input arguments, or a provider not set for the requested platform and type.

## Extending `DirectoryProviderFactory`

Using `map*()` methods, you could introduce new providers and types, map them to platforms, or even bring support for a new custom platform.

### Example: Android Platform Support

Let's say you want to make a standard provider for Android platform, and set `DirectoryProviderFactory` if the platform is Android. Here are the steps:

1.  **Create a New Provider.** Create a class and put your provider logic there. As your provider is of a standard type, you must implement it. You may use traits defined by Phirs, or extend one of the existing providers.

    ```php
    use MAChitgarha\Phirs\Type;
    use MAChitgarha\Phirs\Traits;

    class AndroidDirectoryProvider implements Type\StandardDirectoryProvider
    {
        use Traits\HomeBased\CommonPathProvider;

        public function getHomePath(): string
        {
            // Get the home directory, e.g. /sdcard
        }

        // ...
    }
    ```

1.  **Introduce A New Platform.** For `Platform::autoDetect()` to work, you have to define a new platform. Currently, the only method is the following:

    ```php
    class MyPlatform extends MAChitgarha\Phirs\Util\Platform
    {
        public const ANDROID = 'Android';

        protected static array $customDetectors = [
            self::ANDROID => fn() => self::isAndroid()
        ];

        private static function isAndroid(): bool
        {
            // Logic to determine whether current platform is Android or not
        }
    }
    ```

    **Note:**Don't forget to use `MyPlatform::autoDetect` `insteadof` `Platform`!

1.  **Map the Platform to the Provider.**

    ```php
    DirectoryProviderFactory::mapStandard(
        MyPlatform::ANDROID,
        AndroidDirectoryProvider::class,
    );
    ```

1.  **Use It and Enjoy!**

    ```php
    $dirProvider = DirectoryProviderFactory::createStandard(
        MyPlatform::autoDetect()
    );
    ```

    Now, if Android platform is detected by your `MyPlatform::isAndroid()`, a class instance of `AndroidDirectoryProvider` will be returned.

    But hey, if you really did this, or something cool alike, don't forget to merge changes back!

### Example: Define a Custom Provider Type

Suppose you want to make a desktop application. The standard provider type is not appropriate, as there may be some desktop-centric directories you want to use. The best example is the `Desktop` directory. So, what you should do?

The steps are simple:

1.  **Create Your Custom Provider Type.** Your type may extend other types as well.

    ```php
    use MAChitgarha\Phirs\Type;

    interface DesktopDirectoryProvider extends Type\StandardDirectoryProvider
    {
        public function getDesktopPath(): string;
    }
    ```

1.  **Create New Providers and Platforms, If Needed.** Refer to the previous example for more details.

1.  **Register Your Mappings.** Using `DirectoryProviderFactory::map()`, introduce your new type and map your providers to platforms. Obviously, all your providers must implement your type, otherwise `map()` will throw an exception. You can use static method chaining trick also:

    ```php
    DirectoryProviderFactory
        ::map(
            DesktopDirectoryProvider::class,
            MyPlatform::WINDOWS,
            WindowsDirectoryProvider::class,
        )
        ::map(
            DesktopDirectoryProvider::class,
            MyPlatform::MAC_OS,
            MacOsDirectoryProvider::class,
        )
        ::map(
            DesktopDirectoryProvider::class,
            MyPlatform::LINUX,
            LinuxDirectoryProvider::class,
        )
    ;
    ```

    Or shorter with `DirectoryProviderFactory::mapMany()`:

    ```php
    DirectoryProviderFactory::mapMany(DesktopDirectoryProvider::class, [
        MyPlatform::WINDOWS => WindowsDirectoryProvider::class,
        MyPlatform::MAC_OS => MacOsDirectoryProvider::class,
        MyPlatform::LINUX => LinuxDirectoryProvider::class,
    ]);
    ```

1.  **Use It and Enjoy!**

    ```php
    $dirProvider = DirectoryProviderFactory::create(
        DesktopDirectoryProvider::class,
        MyPlatform::autoDetect(),
    );
    ```

    And again, if you did something look like this, we ask you to share your code with us!
