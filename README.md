Acme PHP SSL
============

[![Build Status](https://img.shields.io/travis/acmephp/ssl/master.svg?style=flat-square)](https://travis-ci.org/acmephp/ssl)
[![Quality Score](https://img.shields.io/scrutinizer/g/acmephp/ssl.svg?style=flat-square)](https://scrutinizer-ci.com/g/acmephp/ssl)
[![StyleCI](https://styleci.io/repos/51226077/shield)](https://styleci.io/repos/51226077)
[![Packagist Version](https://img.shields.io/packagist/v/acmephp/ssl.svg?style=flat-square)](https://packagist.org/packages/acmephp/ssl)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)

> Note : this repository is in alpha stage but only to follow the same versionning as the CLI
> client. This library's API won't change in the near future (we don't want BC breaks now).

> This library is a part of the [Acme PHP initiative](https://github.com/acmephp),
> aiming to intregrate [Let's Encrypt](https://github.com/acmephp)
> in the PHP world at the application level.

Acme PHP SSL is a PHP wrapper around OpenSSL extension providing SSL encoding,
decoding, parsing and signing features.

It uses the recommended security settings and let you interact in a OOP
manner with SSL entities (public/private keys, certificates, ...).

## Why use Acme PHP SSL?

Acme PHP SSL provides various useful tools solving different use-cases:
- generate public and private keys (see the `Generator\KeyPairGenerator`) ;
- sign data using a private key (see `Signer\DataSigner`) ;
- parse certificates to extract informations about them (see `Parser\CertificateParser`) ;

There are many more possible use-cases, don't hesitate to dig a bit deeper in the
documentation to find out if this library can solve your problem!

## Documentation

Read the official [Acme PHP SSL documentation](https://acmephp.github.io/ssl/).

## Launch the Test suite

In the Acme PHP SSL root directory:

```
# Get the dev dependencies
composer update

# Run the tests
vendor/bin/phpunit
```

A JUnit build is created when the test suite is ran.
