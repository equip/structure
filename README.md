# Destrukt

Simple, immutable data structures.

[![Source Code](http://img.shields.io/badge/source-destruktphp/destrukt.svg)](https://github.com/destruktphp/destrukt)
[![Latest Version](https://img.shields.io/github/release/destruktphp/destrukt.svg)](https://github.com/destruktphp/destrukt/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](https://github.com/destruktphp/destrukt/blob/master/LICENSE)
[![Build Status](https://travis-ci.org/destruktphp/destrukt.svg)](https://travis-ci.org/destruktphp/destrukt)
[![HHVM Status](https://img.shields.io/hhvm/destrukt/destrukt.svg)](http://hhvm.h4cc.de/package/destrukt/destrukt)
[![Code Coverage](https://scrutinizer-ci.com/g/destruktphp/destrukt/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/destruktphp/destrukt/?branch=master)
[![Code Quality](https://scrutinizer-ci.com/g/destruktphp/destrukt/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/destruktphp/destrukt/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/destrukt/destrukt.svg)](https://packagist.org/packages/destrukt/destrukt)

---

Provides a number of common data structures that are not natively supported by PHP.
Each structure is represented by an immutable object that can be counted and
serialized to JSON. All of the structures also be used as [iterators][php-iterator].
You can read more about [the "why" on my blog][blog-post].

[php-iterator]: http://php.net/manual/en/class.iterator.php
[blog-post]: http://shadowhand.me/immutable-data-structures-in-php/

This package is compliant with [PSR-1][], [PSR-2][], and [PSR-4][]. If you notice
compliance oversights, please send a patch via pull request.

[PSR-1]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md
[PSR-2]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md
[PSR-4]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md

## Structures

**`Dictionary`** is an implementation of a [associative array][wiki-dict] that
stores values identified by a key. Only associative arrays can be used to
initialize the structure. Any value can be defined by a string key.

**`OrderedList`** is an implementation of a [list][wiki-list] that stores ordered
values. Only an indexed array can be used to initialize the structure. Any value
can be added. When the list is exposed it will be sorted by the defined callable.
By default the [`sort`][php-sort] function will be used.

**`UnorderedList`** is an implementation of a [list][wiki-list] that stores
unordered values. The same value may appear more than once. Only an indexed array
can be used to initialize the structure. Any value can be added.

**`Set`** is an implementation of a [set][wiki-set] that stores a unique values.
The same value will *not* appear more than once. Only an indexed array can be used
to initialize the structure. Adding an existing value to the set will have no effect.
A set also also be added to before or after an existing element.

[wiki-dict]: https://en.wikipedia.org/wiki/Associative_array
[wiki-list]: https://en.wikipedia.org/wiki/List_(abstract_data_type)
[wiki-set]: https://en.wikipedia.org/wiki/Set_(abstract_data_type)

[php-sort]: http://php.net/sort

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
$ composer require destrukt/destrukt
```

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
