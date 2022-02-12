# Phirs

A library providing platform-specific user-accessible directory paths, such as config and cache. Inspired by [dirs-rs](https://github.com/dirs-dev/dirs-rs).

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

The library is already good to be used. However, there are some reasons you might prefer this library:

-   With the help of simple abstractions, adding support for a specific platform should be easy. <!-- TODO: Add a link to contributions describing this. --> The abstractions are designed with performance in mind.

    **Note:** For having something like this in Basedir, a major rewrite and huge backward-compatibility break would be required.

-   If you want or have to, you can target a specific platform and stick to it.

-   Support for more platforms.

-   Support for more directories.

-   Basedir is [no longer available](https://packagist.org/search/?q=basedir) on Packagist for some reason.

## Installation

Easy like every other PHP library:

```
composer install machitgarha/phirs
```

## License

The project is licensed under [Apache 2.0 License](./LICENSE.md).
