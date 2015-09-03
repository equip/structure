# Destrukt

Simple, immutable data structures.

[![Source Code](http://img.shields.io/badge/source-shadowhand/destrukt.svg?style=flat-square)](https://github.com/shadowhand/destrukt)
[![Latest Version](https://img.shields.io/github/release/shadowhand/destrukt.svg?style=flat-square)](https://github.com/shadowhand/destrukt/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](https://github.com/shadowhand/destrukt/blob/master/LICENSE)
[![Build Status](https://img.shields.io/travis/shadowhand/destrukt/master.svg?style=flat-square)](https://travis-ci.org/shadowhand/destrukt)
[![HHVM Status](https://img.shields.io/hhvm/shadowhand/destrukt.svg?style=flat-square)](http://hhvm.h4cc.de/package/shadowhand/destrukt)
[![Coverage Status](https://img.shields.io/coveralls/shadowhand/destrukt/master.svg?style=flat-square)](https://coveralls.io/r/shadowhand/destrukt?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/shadowhand/destrukt.svg?style=flat-square)](https://packagist.org/packages/shadowhand/destrukt)

---

Provides a number of common data structures that are not natively supported by PHP.
Each structure is represented by an immutable object that can be counted and
serialized to JSON.

This package is compliant with [PSR-1][], [PSR-2][], and [PSR-4][]. If you notice
compliance oversights, please send a patch via pull request.

[PSR-1]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md
[PSR-2]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md
[PSR-4]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md

## Structures

**`HashStruct`** is an implementation of a [hash table][wiki-hash] that maps keys
to values. Only associative arrays can be used to initialize a hash. Any key/value
pair may be added to the hash.

**`ListStruct`** is an implementation of a [list][wiki-list] that keeps an
ordered list of values. The same value may appear more than once. Only an
indexed array can be used to initialize a list. Any value can be added to
the list.

**`SetStruct`** is an implementation of a [set][wiki-set] that keeps an unordered
list of values. The same value may *not* appear more than once. Only an indexed
array of unique values can be used to initialize a set. Only values that do not
already exist in the set can be added.

[wiki-hash]: https://en.wikipedia.org/wiki/Hash_table
[wiki-list]: https://en.wikipedia.org/wiki/List_(abstract_data_type)
[wiki-set]: https://en.wikipedia.org/wiki/Set_(abstract_data_type)

## Requirements

The following versions of PHP are supported.

* PHP 5.4
* PHP 5.5
* PHP 5.6
* PHP 7.0
* HHVM

## Install

Via Composer

```bash
$ composer require shadowhand/destrukt
```

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
