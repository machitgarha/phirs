# Phirs

A library providing platform-specific user-accessible directory paths, such as config and cache. Inspired by [dirs-rs](https://github.com/dirs-dev/dirs-rs).

## Features

-   **Cross-platform**. Supporting multiple platforms, including GNU/Linux, Windows and Mac OS. Providing paths available on all platforms, plus specific paths for each platform. This means, you could target a specific platform, stick to it and look nowhere else.

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

## Installation

Easy like every other PHP library:

```
composer install machitgarha/phirs
```

## License

The project is licensed under [Apache 2.0 License](./LICENSE.md).
