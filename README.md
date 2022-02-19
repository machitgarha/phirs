# Phirs

[![Continuous Integration](https://github.com/machitgarha/phirs/actions/workflows/ci.yml/badge.svg)](https://github.com/machitgarha/phirs/actions/workflows/ci.yml)

A library providing platform-specific user directory paths, such as config and cache. Inspired by [dirs-rs](https://github.com/dirs-dev/dirs-rs).

## Features

-   **Multiple Platform.** Providing cross-platform paths, plus platform-specific ones. Make your app run-everywhere or target a specific platform. See [Platform Support](#platform-support) for more details.

-   **Hackable.** Adding support for a specific platform [is easy](./docs/en/usage-guide.md#example-android-platform-support).

-   **Well-Designed.** Provide good design and simple abstractions (with the help of powerful PHP interfaces and traits).

-   **Well-Tested.** Many pieces of the library are covered by unit tests. With the help of CI tools also, it is continuously tested againts major platforms.

## Why?

When writing a console application (or even a graphical one; who knows, people might start writing graphical applications in PHP in near future), sometimes you need to have a location to:

-   store your configurations, and possibly re-use them in the future runs,
-   make cache files and improve the performance of your application,
-   create a media and put it somewhere reasonable,
-   etc.

For the best results, the locations should be cross-platform, permanent, accessible (i.e. both readable and writable), well-known and non-relative.

Phirs can help you in these situations.

**Note:** The library does not guarantee that all provided paths meet all the conditions above, although it helps you achieving them. The reason is performance, and the fact that different users may have different needs (e.g. one may check for a path to exist, one may suppose it to exist). Theoretically, in a standard environment and for standard paths, all these conditions are met (although the directories might not actually exist).

### But There Is Another Library!

Why not just using [Basedir](https://github.com/clue-labs/php-basedir)?

Go back and see [features](#features). Having these there would require a major rewrite and huge backward-compatibility break. Plus, Basedir is [no longer available on Packagist](https://packagist.org/search/?q=basedir), for some unknown reason.

## Requirements

PHP 7.4+ only.

## Installation

Easy like every other PHP library:

```
composer install machitgarha/phirs
```

## Basic Usage

A simple use for most common cases is the following:

```php
use MAChitgarha\Phirs\DirectoryProviderFactory;
use MAChitgarha\Phirs\Util\Platform;

// Get a provider for the current platform
$dirProvider = DirectoryProviderFactory::createStandard(Platform::autoDetect());

// Let's get some paths!
$configPath = $dirProvider->getConfigPath();
$docsPath = $dirProvider->getDocumentsPath();

// Load or save something…!
```

What a provider is? Why we use `createStandard()`? Can I extend it and map a specific platform to my own provider? See [Usage Guide](./docs/en/usage-guide.md) for more details.

## Platform Support

|Platform|Having a Provider?|Supported?|Working?|Having a Specialized Provider?|
|:-:|:-:|:-:|:-:|:-:|
|GNU/Linux distributions|✅|✅|✅|✅|
|Windows|✅|✅|✅|✅|
|Mac OS|✅|✅|✅|✅|
|[Termux](https://termux.com) on Android|✅|✅|✅❕(1)|❌|
|BSD|✅|❌|❔|❌|
|Solaris|✅|❌|❔|❌|
|Android|✅|❌|❓|❌|
|iOS|✅|❌|❓|❌|

-   ❕: Has notes.
-   ❔: Not known or depends on the environment.
-   ❓: Like ❔, but most likely no.

### Notes

1.  It might not be exactly what you or users expect; e.g. pictures directory path is inside Termux home, not the internal SDCard (i.e. `/sdcard`).

## Contribute!

In a world like this, everyone should be a contributor. So, start helping this project by creating an issue, forking and improving it, or simply introducing it to your PHP developer friends!

If you want to get an overall overview of the code, go and read [Usage Guide](#usage-guide).

For the best results, see [Contribution Guidelines](./.github/CONTRIBUTING.md).

## License

The project is licensed under [Apache 2.0 License](./LICENSE.md).
