Acme PHP SSL
=============

[![Build Status](https://travis-ci.org/acmephp/ssl.svg?branch=master)](https://travis-ci.org/acmephp/ssl)
[![StyleCI](https://styleci.io/repos/51226077/shield)](https://styleci.io/repos/51226077)

> Note : this repository is in development

This repository provide tools to generate, dump and load SSL entities

- KeyPair: represent a couple of public and private key
- Distinguished Names: contains required data used to generate a Certificate Request Signing
- Parsed Certificate: contains metadata extracted from a certificate
- Certificate: represent a PEM certificate string
- Certificate Chain: use recurcivity to follow a chain of certificate
- Certificate Request: contains required data used to request a certificate
- Certificate Response: is the result of a certificate request
