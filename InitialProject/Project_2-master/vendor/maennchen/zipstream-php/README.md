# ZipStream-PHP

<<<<<<< HEAD
[![Build Status](https://travis-ci.org/maennchen/ZipStream-PHP.svg?branch=master)](https://travis-ci.org/maennchen/ZipStream-PHP)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/maennchen/ZipStream-PHP/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/maennchen/ZipStream-PHP/)
[![Code Coverage](https://scrutinizer-ci.com/g/maennchen/ZipStream-PHP/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/maennchen/ZipStream-PHP/)
[![Latest Stable Version](https://poser.pugx.org/maennchen/zipstream-php/v/stable)](https://packagist.org/packages/maennchen/zipstream-php)
[![Total Downloads](https://poser.pugx.org/maennchen/zipstream-php/downloads)](https://packagist.org/packages/maennchen/zipstream-php)
[![Financial Contributors on Open Collective](https://opencollective.com/zipstream/all/badge.svg?label=financial+contributors)](https://opencollective.com/zipstream) [![License](https://img.shields.io/github/license/maennchen/zipstream-php.svg)](LICENSE)

## Overview

A fast and simple streaming zip file downloader for PHP. Using this library will save you from having to write the Zip to disk. You can directly send it to the user, which is much faster. It can work with S3 buckets or any PSR7 Stream.
=======
[![Main Branch](https://github.com/maennchen/ZipStream-PHP/actions/workflows/branch_main.yml/badge.svg)](https://github.com/maennchen/ZipStream-PHP/actions/workflows/branch_main.yml)
[![Coverage Status](https://coveralls.io/repos/github/maennchen/ZipStream-PHP/badge.svg?branch=main)](https://coveralls.io/github/maennchen/ZipStream-PHP?branch=main)
[![Latest Stable Version](https://poser.pugx.org/maennchen/zipstream-php/v/stable)](https://packagist.org/packages/maennchen/zipstream-php)
[![Total Downloads](https://poser.pugx.org/maennchen/zipstream-php/downloads)](https://packagist.org/packages/maennchen/zipstream-php)
[![OpenSSF Best Practices](https://www.bestpractices.dev/projects/9524/badge)](https://www.bestpractices.dev/projects/9524)
[![OpenSSF Scorecard](https://api.scorecard.dev/projects/github.com/maennchen/ZipStream-PHP/badge)](https://scorecard.dev/viewer/?uri=github.com/maennchen/ZipStream-PHP)

## Unstable Branch

The `main` branch is not stable. Please see the
[releases](https://github.com/maennchen/ZipStream-PHP/releases) for a stable
version.

## Overview

A fast and simple streaming zip file downloader for PHP. Using this library will
save you from having to write the Zip to disk. You can directly send it to the
user, which is much faster. It can work with S3 buckets or any PSR7 Stream.
>>>>>>> main

Please see the [LICENSE](LICENSE) file for licensing and warranty information.

## Installation

<<<<<<< HEAD
Simply add a dependency on maennchen/zipstream-php to your project's composer.json file if you use Composer to manage the dependencies of your project. Use following command to add the package to your project's dependencies:
=======
Simply add a dependency on maennchen/zipstream-php to your project's
`composer.json` file if you use Composer to manage the dependencies of your
project. Use following command to add the package to your project's dependencies:
>>>>>>> main

```bash
composer require maennchen/zipstream-php
```

<<<<<<< HEAD
## Usage and options

Here's a simple example:
=======
## Usage

For detailed instructions, please check the
[Documentation](https://maennchen.github.io/ZipStream-PHP/).
>>>>>>> main

```php
// Autoload the dependencies
require 'vendor/autoload.php';

<<<<<<< HEAD
// enable output of HTTP headers
$options = new ZipStream\Option\Archive();
$options->setSendHttpHeaders(true);

// create a new zipstream object
$zip = new ZipStream\ZipStream('example.zip', $options);

// create a file named 'hello.txt'
$zip->addFile('hello.txt', 'This is the contents of hello.txt');

// add a file named 'some_image.jpg' from a local file 'path/to/image.jpg'
$zip->addFileFromPath('some_image.jpg', 'path/to/image.jpg');

// add a file named 'goodbye.txt' from an open stream resource
$fp = tmpfile();
fwrite($fp, 'The quick brown fox jumped over the lazy dog.');
rewind($fp);
$zip->addFileFromStream('goodbye.txt', $fp);
fclose($fp);
=======
// create a new zipstream object
$zip = new ZipStream\ZipStream(
    outputName: 'example.zip',

    // enable output of HTTP headers
    sendHttpHeaders: true,
);

// create a file named 'hello.txt'
$zip->addFile(
    fileName: 'hello.txt',
    data: 'This is the contents of hello.txt',
);

// add a file named 'some_image.jpg' from a local file 'path/to/image.jpg'
$zip->addFileFromPath(
    fileName: 'some_image.jpg',
    path: 'path/to/image.jpg',
);
>>>>>>> main

// finish the zip stream
$zip->finish();
```

<<<<<<< HEAD
You can also add comments, modify file timestamps, and customize (or
disable) the HTTP headers. It is also possible to specify the storage method when adding files,
the current default storage method is 'deflate' i.e files are stored with Compression mode 0x08.

See the [Wiki](https://github.com/maennchen/ZipStream-PHP/wiki) for details.

## Known issue

The native Mac OS archive extraction tool might not open archives in some conditions. A workaround is to disable the Zip64 feature with the option `$opt->setEnableZip64(false)`. This limits the archive to 4 Gb and 64k files but will allow Mac OS users to open them without issue. See #116.

The linux `unzip` utility might not handle properly unicode characters. It is recommended to extract with another tool like [7-zip](https://www.7-zip.org/). See #146.

## Upgrade to version 2.0.0

* Only the self opened streams will be closed (#139)
If you were relying on ZipStream to close streams that the library didn't open,
you'll need to close them yourself now.

## Upgrade to version 1.0.0

* All options parameters to all function have been moved from an `array` to structured option objects. See [the wiki](https://github.com/maennchen/ZipStream-PHP/wiki/Available-options) for examples.
* The whole library has been refactored. The minimal PHP requirement has been raised to PHP 7.1.

## Usage with Symfony and S3

You can find example code on [the wiki](https://github.com/maennchen/ZipStream-PHP/wiki/Symfony-example).

## Contributing

ZipStream-PHP is a collaborative project. Please take a look at the [CONTRIBUTING.md](CONTRIBUTING.md) file.

## About the Authors

* Paul Duncan <pabs@pablotron.org> - https://pablotron.org/
* Jonatan Männchen <jonatan@maennchen.ch> - https://maennchen.dev
* Jesse G. Donat <donatj@gmail.com> - https://donatstudios.com
* Nicolas CARPi <nico-git@deltablot.email> - https://www.deltablot.com
* Nik Barham <nik@brokencube.co.uk> - https://www.brokencube.co.uk

## Contributors

### Code Contributors

This project exists thanks to all the people who contribute. [[Contribute](CONTRIBUTING.md)].
<a href="https://github.com/maennchen/ZipStream-PHP/graphs/contributors"><img src="https://opencollective.com/zipstream/contributors.svg?width=890&button=false" /></a>

### Financial Contributors

Become a financial contributor and help us sustain our community. [[Contribute](https://opencollective.com/zipstream/contribute)]

#### Individuals

<a href="https://opencollective.com/zipstream"><img src="https://opencollective.com/zipstream/individuals.svg?width=890"></a>

#### Organizations

Support this project with your organization. Your logo will show up here with a link to your website. [[Contribute](https://opencollective.com/zipstream/contribute)]

<a href="https://opencollective.com/zipstream/organization/0/website"><img src="https://opencollective.com/zipstream/organization/0/avatar.svg"></a>
<a href="https://opencollective.com/zipstream/organization/1/website"><img src="https://opencollective.com/zipstream/organization/1/avatar.svg"></a>
<a href="https://opencollective.com/zipstream/organization/2/website"><img src="https://opencollective.com/zipstream/organization/2/avatar.svg"></a>
<a href="https://opencollective.com/zipstream/organization/3/website"><img src="https://opencollective.com/zipstream/organization/3/avatar.svg"></a>
<a href="https://opencollective.com/zipstream/organization/4/website"><img src="https://opencollective.com/zipstream/organization/4/avatar.svg"></a>
<a href="https://opencollective.com/zipstream/organization/5/website"><img src="https://opencollective.com/zipstream/organization/5/avatar.svg"></a>
<a href="https://opencollective.com/zipstream/organization/6/website"><img src="https://opencollective.com/zipstream/organization/6/avatar.svg"></a>
<a href="https://opencollective.com/zipstream/organization/7/website"><img src="https://opencollective.com/zipstream/organization/7/avatar.svg"></a>
<a href="https://opencollective.com/zipstream/organization/8/website"><img src="https://opencollective.com/zipstream/organization/8/avatar.svg"></a>
<a href="https://opencollective.com/zipstream/organization/9/website"><img src="https://opencollective.com/zipstream/organization/9/avatar.svg"></a>
=======
## Upgrade to version 3.1.2

- Minimum PHP Version: `8.2`

## Upgrade to version 3.0.0

### General

- Minimum PHP Version: `8.1`
- Only 64bit Architecture is supported.
- The class `ZipStream\Option\Method` has been replaced with the enum
  `ZipStream\CompressionMethod`.
- Most clases have been flagged as `@internal` and should not be used from the
  outside.
  If you're using internal resources to extend this library, please open an
  issue so that a clean interface can be added & published.
  The externally available classes & enums are:
  - `ZipStream\CompressionMethod`
  - `ZipStream\Exception*`
  - `ZipStream\ZipStream`

### Archive Options

- The class `ZipStream\Option\Archive` has been replaced in favor of named
  arguments in the `ZipStream\ZipStream` constuctor.
- The archive options `largeFileSize` & `largeFileMethod` has been removed. If
  you want different `compressionMethods` based on the file size, you'll have to
  implement this yourself.
- The archive option `httpHeaderCallback` changed the type from `callable` to
  `Closure`.
- The archive option `zeroHeader` has been replaced with the option
  `defaultEnableZeroHeader` and can be overridden for every file. Its default
  value changed from `false` to `true`.
- The archive option `statFiles` was removed since the library no longer checks
  filesizes this way.
- The archive option `deflateLevel` has been replaced with the option
  `defaultDeflateLevel` and can be overridden for every file.
- The first argument (`name`) of the `ZipStream\ZipStream` constuctor has been
  replaced with the named argument `outputName`.
- Headers are now also sent if the `outputName` is empty. If you do not want to
  automatically send http headers, set `sendHttpHeaders` to `false`.

### File Options

- The class `ZipStream\Option\File` has been replaced in favor of named
  arguments in the `ZipStream\ZipStream->addFile*` functions.
- The file option `method` has been renamed to `compressionMethod`.
- The file option `time` has been renamed to `lastModificationDateTime`.
- The file option `size` has been renamed to `maxSize`.

## Upgrade to version 2.0.0

https://github.com/maennchen/ZipStream-PHP/tree/2.0.0#upgrade-to-version-200

## Upgrade to version 1.0.0

https://github.com/maennchen/ZipStream-PHP/tree/2.0.0#upgrade-to-version-100

## Contributing

ZipStream-PHP is a collaborative project. Please take a look at the
[.github/CONTRIBUTING.md](.github/CONTRIBUTING.md) file.

## Version Support

Versions are supported according to the table below.

Please do not open any pull requests contradicting the current version support
status.

Careful: Always check the `README` on `main` for up-to-date information.

| Version | New Features | Bugfixes | Security |
|---------|--------------|----------|----------|
| *3*     | ✓            | ✓        | ✓        |
| *2*     | ✗            | ✗        | ✓        |
| *1*     | ✗            | ✗        | ✗        |
| *0*     | ✗            | ✗        | ✗        |

This library aligns itself with the PHP core support. New features and bugfixes
will only target PHP versions according to their current status.

See: https://www.php.net/supported-versions.php

## About the Authors

- Paul Duncan <pabs@pablotron.org> - https://pablotron.org/
- Jonatan Männchen <jonatan@maennchen.ch> - https://maennchen.dev
- Jesse G. Donat <donatj@gmail.com> - https://donatstudios.com
- Nicolas CARPi <nico-git@deltablot.email> - https://www.deltablot.com
- Nik Barham <nik@brokencube.co.uk> - https://www.brokencube.co.uk
>>>>>>> main
