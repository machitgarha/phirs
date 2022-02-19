# Contribution Guidelines

## Code of Conduct

For a better community, please read and follow the [code of conduct](./CODE_OF_CONDUCT.md).

## Issues

It is great to include examples in your issues, like what fails or what you want to achieve.

## Branching Model

There are two branches available, `master` and `develop`. All stable changes will go into the `master`, and all unstables to `develop`.

As a result, you always have to make changes on `develop`, and merge back to the same branch, in the case of any PRs. Any requests to merge into `master` directly is likely to be rejected.

## Warming Up

For the development process, install dependencies first:

```bash
composer install
```

## Tests, Tests and Tests

Make unit-tests for the new code. Make sure all current tests pass by invoking PHPUnit:

```bash
./vendor/bin/phpunit
```

## Documentation

We will be thankful if you update the related documentations along with any changes.

## Static Analysis

We use [Phan](https://github.com/phan/phan) static analyser.

Newly-added code must have no errors reported by Phan. You may suppress an error, if you think it's not applicable. Globally suppressing errors is not a good idea, so make sure you make the suppression as limited and small as possible.

To run Phan, do:

## Coding Guidelines

You should use the [PSR-2](https://www.php-fig.org/psr/psr-2/) and [PSR-12](https://www.php-fig.org/psr/psr-12/) style guides in your code.

## Versioning

This project follows the [semantic versioning](https://semver.org/) guidelines.
