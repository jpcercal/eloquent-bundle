# Cekurte\EloquentBundle

[![Build Status](https://img.shields.io/travis/jpcercal/CekurteEloquentBundle/master.svg?style=flat-square)](http://travis-ci.org/jpcercal/CekurteEloquentBundle)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/jpcercal/CekurteEloquentBundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/jpcercal/CekurteEloquentBundle/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/jpcercal/CekurteEloquentBundle/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/jpcercal/CekurteEloquentBundle/?branch=master)
[![Latest Stable Version](https://img.shields.io/packagist/v/cekurte/eloquentbundle.svg?style=flat-square)](https://packagist.org/packages/cekurte/eloquentbundle)
[![Total Downloads](https://img.shields.io/packagist/dt/cekurte/eloquentbundle.svg?style=flat-square)](https://packagist.org/packages/cekurte/eloquentbundle)
[![License](https://img.shields.io/packagist/l/cekurte/eloquentbundle.svg?style=flat-square)](https://packagist.org/packages/cekurte/eloquentbundle)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/26e42923-9ae6-4572-910f-18566acca2e1/mini.png)](https://insight.sensiolabs.com/projects/26e42923-9ae6-4572-910f-18566acca2e1)

- See also the [CekurteGeneratorBundle](https://github.com/jpcercal/CekurteGeneratorBundle) to build CRUD's automatically 
with custom templates.
- See also the [CekurteComponentBundle](https://github.com/jpcercal/CekurteComponentBundle) to manage resources.

## Installation

The package is available on [Packagist](http://packagist.org/packages/cekurte/eloquentbundle).
Autoloading is [PSR-4](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md) compatible.

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
