# Column Parser
[![Build Status](https://travis-ci.org/traderinteractive/column-parser-php.svg?branch=master)](https://travis-ci.org/traderinteractive/column-parser-php)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/traderinteractive/column-parser-php/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/traderinteractive/column-parser-php/?branch=master)
[![Coverage Status](https://coveralls.io/repos/github/traderinteractive/column-parser-php/badge.svg?branch=master)](https://coveralls.io/github/traderinteractive/column-parser-php?branch=master)

[![Latest Stable Version](https://poser.pugx.org/traderinteractive/column-parser/v/stable)](https://packagist.org/packages/traderinteractive/column-parser)
[![Latest Unstable Version](https://poser.pugx.org/traderinteractive/column-parser/v/unstable)](https://packagist.org/packages/traderinteractive/column-parser)
[![License](https://poser.pugx.org/traderinteractive/column-parser/license)](https://packagist.org/packages/traderinteractive/column-parser)

[![Total Downloads](https://poser.pugx.org/traderinteractive/column-parser/downloads)](https://packagist.org/packages/traderinteractive/column-parser)
[![Daily Downloads](https://poser.pugx.org/traderinteractive/column-parser/d/daily)](https://packagist.org/packages/traderinteractive/column-parser)
[![Monthly Downloads](https://poser.pugx.org/traderinteractive/column-parser/d/monthly)](https://packagist.org/packages/traderinteractive/column-parser)

A PHP library that parses columnar data from a string, e.g. from CLI output.

## Requirements
This library requires PHP 7.0, or newer.

## Installation
This package uses [composer](https://getcomposer.org) so you can just add `traderinteractive/column-parser` as a dependency to your `composer.json` file.
```sh
composer require traderinteractive/column-parser
```

## Formats Supported
This library parses input that has to conform to a supported format.

### Multispaced Headers
This parses a string where there are at least two spaces between the columns.
The first line in the string is the headers.  Each header is expected to be
separated by at least two spaces.  A single space is treated as interior space
of the header (i.e. multiple-word headers).

#### Example
For example, given the following `$contents`:
```
Name     Age  City of Birth
James    17   San Francisco, CA
Mary     18   Washington, D.C.
William  22   Dallas, TX
```
and the following code:
```php
$parser = new MultispacedHeadersParser($contents);
$data = $parser->getRows();
```

would result in `$data` containing:
```php
array(
    array(
        'Name' => 'James',
        'Age' => '17',
        'City of Birth' => 'San Francisco, CA',
    ),
    array(
        'Name' => 'Mary',
        'Age' => '18',
        'City of Birth' => 'Washington, D.C.',
    ),
    array(
        'Name' => 'William',
        'Age' => '22',
        'City of Birth' => 'Dallas, TX',
    ),
);
```

## Contributing
If you would like to contribute, please use our build process for any changes
and after the build passes, send us a pull request on github!
```sh
./vendor/bin/phpunit
./vendor/bin/phpcs
```

There is also a [docker](http://www.docker.com/)-based
[fig](http://www.fig.sh/) configuration that will execute the build inside a
docker container.  This is an easy way to build the application:
```sh
fig run build
```
