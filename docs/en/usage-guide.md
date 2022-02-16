# Usage Guide

## Overview of the Main Concepts

Let's start with defining two important concepts:

-   **(Directory) Provider**: A class providing the path of directories for one or more platforms. For instance, `LinuxDirectoryProvider` or `WindowsDirectoryProvider`.

-   **(Directory) Provider Type**: An interface defining what a provider must implement. In other words, it specifies what directories must a provider provide the path of.

    For example, `StandardDirectoryProvider` is a type enforcing providers to provide paths of directories available across (almost) all platforms. The term standard is in the context of the library, not a real standard or specification. You could call it `CrossPlatformDirectoryProvider` in your mind.

In the examples above, Linux and Windows (and also Darwin) providers are all of standard type (i.e. implements `StandardDirectoryProvider` interface).

**Note**: Providers and provider types are under namespaces `PlatformSpecific` and `Types`, respectively.
