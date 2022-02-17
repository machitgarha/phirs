# Usage Guide

**Note**: In the examples, the `use` statements are eliminated.

## Overview of the Main Concepts

Let's start with defining two important concepts:

-   **(Directory) Provider**: A class providing the path of directories for one or more platforms. For instance, `LinuxDirectoryProvider` or `WindowsDirectoryProvider`.

-   **(Directory) Provider Type**: An interface defining what a provider must implement. In other words, it specifies what directories must a provider provide the path of. It may be referred to as type.

    For example, `StandardDirectoryProvider` is a type enforcing providers to provide paths of directories available across (almost) all platforms. The term standard is in the context of the library, not a real standard or specification. You could call it `CrossPlatformDirectoryProvider` in your mind.

In the examples above, Linux and Windows (and also Darwin) providers are all of standard type (i.e. implements `StandardDirectoryProvider` interface).

**Note**: Providers and provider types are under namespaces `PlatformSpecific` and `Type`, respectively.

## Creating a Provider Object

The main method to get a provider is via `DirectoryProviderFactory`. The other way is to instantiate the dedicated provider directly.

**Tip**: Want to target a specific platform? Each method has its benefits. The first one makes porting your application to other platforms easy. The second one enables you to use paths of platform-specific directories confidently.

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

**Note**: By default, only standard provider type mappings are defined. However, you may extend the types using `map*()` methods.

### Instantiaing Dedicated Provider

Let's create a Linux provider directly:

```php
$dirProvider = new LinuxDirectoryProvider();
```
