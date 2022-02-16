# Phirs

A library providing platform-specific user-accessible directory paths, such as config and cache. Inspired by [dirs-rs](https://github.com/dirs-dev/dirs-rs).

## Features

-   **Multiple platform**. Providing cross-platform paths, plus platform-specific ones. Make your app run-everywhere or target a specific platform. See [Platform Support](#platform-support) for more details.

-   **Hackable**. Adding support for a specific platform [is easy](#). <!-- TODO: Add a link to contributions describing this. -->

-   **Well-designed**. Provide good design and simple abstractions (with the help of powerful PHP interfaces and traits).

## Why?

When writing a console application (or even a graphical one; who knows, people might start writing graphical applications in PHP in near future), sometimes you need to have a location to:

-   store your configurations, and possibly re-use them in the future runs,
-   make cache files and improve the performance of your application,
-   create a media and put it somewhere reasonable,
-   etc.

For the best results, the location has to be cross-platform, permanent, accessible, well-known and non-relative.

Phirs can to help you in these situations.

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
$dirProvider = DirectoryProviderFactory::createStandard(
    Platform::autoDetect()
);

// Let's get some paths!
$configPath = $dirProvider->getConfigPath();
$docsPath = $dirProvider->getDocumentsPath();

// Load or save something…!
```

What a provider is? Why we use `createStandard`? Can I extend it and map a specific platform to my own provider? (Consider give your code back if you did it BTW.) See [Usage Guide](./docs/en/usage-guide.md) for more details.

## Platform Support

|Platform|Having a Provider?|Supported?|Working?|Having a Specialized Provider?|
|:-:|:-:|:-:|:-:|:-:|
|GNU/Linux distributions|✅|✅|✅|✅|
|Windows|✅|✅|✅|✅|
|Mac OS|✅|✅|✅|✅|
|[Termux](https://termux.com) on Android|✅|✅|✅❕|❌|
|BSD|✅|❌|❔|❌|
|Solaris|✅|❌|❔|❌|
|Android|✅|❌|❓|❌|
|iOS|✅|❌|❔|❌|

❕: Have notes.
❔: Not known or depends on the environment.
❓: Like ❔, but most likely no.

### Notes

-   It might not be exactly what you or users expect; e.g. pictures directory path is inside Termux home, not the internal SDCard (i.e. `/sdcard`).

### Fork and Improve It!

By the way, if you can improve support for a specific platform, why not?

## License

The project is licensed under [Apache 2.0 License](./LICENSE.md).
