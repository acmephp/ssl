Acme PHP SSL
============

[![Build Status](https://travis-ci.org/acmephp/ssl.svg?branch=master)](https://travis-ci.org/acmephp/ssl)
[![StyleCI](https://styleci.io/repos/51226077/shield)](https://styleci.io/repos/51226077)

> Note : this repository is in alpha stage.

This PHP library is a wrapper around OpenSSL features to improve its usability and
extendibility.

It implements classes for the basic SSL entities (public and private keys, certificates,
etc.) and let you generate, load and dump these entities.

## Installation

You will need OpenSSL extension.

Use Composer:

```
composer require acmephp/ssl
```

## Usage

### SSL entities

This library provides the following SSL entities representations:

- **PrivateKey**: a private key
- **PublicKey**: a public key
- **ParsedKey**: data resulting of the decoding of a parsed key
- **KeyPair**: a couple of public and private key
- **Certificate**: a PEM certificate string (an encoded certificate)
- **CertificateChain**: chain of certificates
- **ParsedCertificate**: data resulting of the decoding of a parsed certificate
- **DistinguishedName**: required data used to generate a Certificate Request Signing
- **CertificateRequest**: required data used to request a certificate
- **CertificateResponse**: the result of a certificate request

### Formatters

Formatters let you combine in different ways certificates in order to build certificate files 
for usage in other softwares (web servers, ...). They all implement the interface
`AcmePhp\Ssl\Formatter\FormatterInterface`.

- **CertificateFormatter**: most basic formatter, simply dump a certificate as PEM
- **IssuerChainFormatter**: dump the issuer certificate chain as PEM
- **FullChainFormatter**: dump the full chain (issuer certificate + your certificate) as PEM
- **KeyPairFormatter**: dump the private key used to request a certificate
- **CombinedFormatter**: dump the full chain of a certificate with the private key

### Generators

Generators are under `AcmePhp\Ssl\Generator` namespace.

- **KeyPairGenerator** let you create `KeyPair` entites using OpenSSL functions

### Parsers

Parsers are under `AcmePhp\Ssl\Parser` namespace.

- **CertificateParser** parse certificates (**Certificate** entities) and return **ParsedCertificate** entities
- **KeyParser** parse keys (**PrivateKey or PublicKey** entities) and return **ParsedKey** entities

### Signers

Signers are under `AcmePhp\Ssl\Signer` namespace.

- **CertificateRequestSigner** signs Certificate requests (CSR)
- **DataSigner** signs custom data using a private key
