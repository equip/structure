## Equip Structure

[![Latest Stable Version](https://img.shields.io/packagist/v/equip/structure.svg)](https://packagist.org/packages/equip/structure)
[![License](https://img.shields.io/packagist/l/equip/structure.svg)](https://github.com/equip/structure/blob/master/LICENSE)
[![Build Status](https://travis-ci.org/equip/structure.svg)](https://travis-ci.org/equip/structure)
[![Code Coverage](https://scrutinizer-ci.com/g/equip/structure/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/equip/structure/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/equip/structure/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/equip/structure/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/destrukt/destrukt.svg)](https://packagist.org/packages/destrukt/destrukt)

Provides a number of common data structures in [Equip](http://equip.github.io/)
that are not natively supported by PHP. Each structure is represented by an
immutable object that can be counted and serialized to JSON. All of the structures
also be used as [iterators][php-iterator] and as [arrays][php-arrayaccess], but
cannot be modified using array functions.

[php-iterator]: http://php.net/manual/en/class.iterator.php
[php-arrayaccess]: http://php.net/manual/en/class.arrayaccess.php

For more information, see [the documentation][docs].

[docs]: http://equipframework.readthedocs.org/en/latest/structure

This package is compliant with [PSR-1][], [PSR-2][], and [PSR-4][]. If you notice
compliance oversights, please send a patch via pull request.

[PSR-1]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md
[PSR-2]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md
[PSR-4]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md

## Structures

**`Dictionary`** is an implementation of a [associative array][wiki-dict] that
stores values identified by a key. Only associative arrays can be used to
initialize the structure. Any value can be defined by a string key.

**`SortedDictionary`** is an implementation of a [associative array][wiki-dict]
that also sorts the array. When the dictionary is modified it will be sorted.
By default the [`asort`][php-asort] function is used.

**`OrderedList`** is an implementation of a [list][wiki-list] that stores ordered
values. Only an indexed array can be used to initialize the structure. Any value
can be added. When the list is modified it will be sorted. By default the
[`sort`][php-sort] function will be used.

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
[php-asort]: http://php.net/asort

## Requirements

The following versions of PHP are supported.

* PHP 5.5
* PHP 5.6
* PHP 7.0
* HHVM

## Install

Via Composer

```bash
$ composer require equip/structure
```

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
