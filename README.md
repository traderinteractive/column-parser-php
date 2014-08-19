# Column Parser
[![Build Status](http://img.shields.io/travis/dominionenterprises/column-parser-php.svg?style=flat)](https://travis-ci.org/dominionenterprises/column-parser-php)
[![Scrutinizer Code Quality](http://img.shields.io/scrutinizer/g/dominionenterprises/column-parser-php.svg?style=flat)](https://scrutinizer-ci.com/g/dominionenterprises/column-parser-php/)
[![Code Coverage](http://img.shields.io/scrutinizer/coverage/g/dominionenterprises/column-parser-php.svg?style=flat)](https://scrutinizer-ci.com/g/dominionenterprises/column-parser-php/)

[![Latest Stable Version](http://img.shields.io/packagist/v/dominionenterprises/column-parser.svg?style=flat)](https://packagist.org/packages/dominionenterprises/column-parser)
[![Total Downloads](http://img.shields.io/packagist/dt/dominionenterprises/column-parser.svg?style=flat)](https://packagist.org/packages/dominionenterprises/column-parser)
[![License](http://img.shields.io/packagist/l/dominionenterprises/column-parser.svg?style=flat)](https://packagist.org/packages/dominionenterprises/column-parser)

A PHP library that parses columnar data from a string, e.g. from CLI output.

## Requirements
This library requires PHP 5.4, or newer.

## Installation
This package uses [composer](https://getcomposer.org) so you can just add
`dominionenterprises/column-parser` as a dependency to your `composer.json`
file.

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
./build.php
```

There is also a [docker](http://www.docker.com/)-based
[fig](http://www.fig.sh/) configuration that will execute the build inside a
docker container.  This is an easy way to build the application:
```sh
fig run build
```
