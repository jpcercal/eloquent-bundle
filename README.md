# Cekurte\EloquentBundle

[![Build Status](https://img.shields.io/travis/jpcercal/eloquent-bundle/master.svg?style=square)](http://travis-ci.org/jpcercal/eloquent-bundle)
[![Code Climate](https://codeclimate.com/github/jpcercal/eloquent-bundle/badges/gpa.svg)](https://codeclimate.com/github/jpcercal/eloquent-bundle)
[![Coverage Status](https://coveralls.io/repos/github/jpcercal/eloquent-bundle/badge.svg?branch=master)](https://coveralls.io/github/jpcercal/eloquent-bundle?branch=master)
[![Latest Stable Version](https://img.shields.io/packagist/v/cekurte/eloquentbundle.svg?style=square)](https://packagist.org/packages/cekurte/eloquentbundle)
[![License](https://img.shields.io/packagist/l/cekurte/eloquentbundle.svg?style=square)](https://packagist.org/packages/cekurte/eloquentbundle)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/26e42923-9ae6-4572-910f-18566acca2e1/mini.png)](https://insight.sensiolabs.com/projects/26e42923-9ae6-4572-910f-18566acca2e1)

- A simple bridge to use the Eloquent ORM with Symfony 2 (with all methods covered by php unit tests), **contribute with this project**!

**If you liked of this library, give me a *star =)*.**

## Installation

- The package is available on [Packagist](http://packagist.org/packages/cekurte/eloquentbundle).
- The source files is [PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md) compatible.
- Autoloading is [PSR-4](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md) compatible.

```shell
composer require cekurte/eloquentbundle
```

After, register the bundle in your AppKernel like this:

```php
// app/AppKernel.php

// ...
public function registerBundles()
{
    $bundles = array(
        // ...
        new Cekurte\EloquentBundle\CekurteEloquentBundle(),
        // ...
    );

    // ...
    return $bundles;
}
```

## Configuration

All reference to configure this bundle is bellow, add this in your config file.

```yml
# app/config/config.yml

# ...
cekurte_eloquent:
    connection:
        driver:     "mysql"           # Default is mysql. Available too: postgres, sqlserver and sqlite.
        host:       "127.0.0.1"       # Required
        database:   "dbname"          # Required
        username:   "user"            # Required
        password:   "pass"            # Optional, default is ""
        charset:    "utf8"            # Optional, default is "utf8"
        collation:  "utf8_unicode_ci" # Optional, default is "utf8_unicode_ci"
        prefix:     ""                # Optional, default is ""
```

## How to use

See the [documentation of the Eloquent ORM](http://laravel.com/docs/5.0/eloquent).

Contributing
------------

1. Give me a star **=)**
1. Fork it
2. Create your feature branch (`git checkout -b my-new-feature`)
3. Make your changes
4. Run the tests, adding new ones for your own code if necessary (`vendor/bin/phpunit`)
5. Commit your changes (`git commit -am 'Added some feature'`)
6. Push to the branch (`git push origin my-new-feature`)
7. Create new Pull Request
