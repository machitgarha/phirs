# Phirs

A library providing platform-specific user-accessible directory paths, such as config and cache. Inspired mostly by [dirs-rs](https://github.com/dirs-dev/dirs-rs).

## Why?

When writing a console application (or even graphical one; who knows, people might start writing graphical applications in PHP in near future), sometimes you need to have a location to:

-   store your configurations, and possibly re-use them in the future runs,
-   make cache files and improve the performance of your application,
-   create a media and put it somewhere reasonable,
-   etc.

For the best results, the location has to be cross-platform, permanent, well-known and non-relative.

Phirs can to help you in these situations.

## Installation

Easy like every other PHP library:

```
composer install machitgarha/phirs
```

## License

The project is licensed under [Apache 2.0 License](./LICENSE.md).
