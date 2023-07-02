# Php [Cayenne](https://docs.mydevices.com/docs/lorawan/cayenne-lpp) Encoder & Decoder

<a href="https://github.com/jalallinux/cayenne-lpp">  
    <p align="center"><img src="cover.png" width="100%"></p>    
</a>



[![Latest Stable Version](https://poser.pugx.org/jalallinux/cayenne-lpp/v)](https://packagist.org/packages/jalallinux/cayenne-lpp)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/jalallinux/cayenne-lpp.svg?style=flat-square)](https://packagist.org/packages/jalallinux/cayenne-lpp)
[![Tests](https://github.com/jalallinux/cayenne-lpp/actions/workflows/run-tests.yml/badge.svg?branch=main)](https://github.com/jalallinux/cayenne-lpp/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/jalallinux/cayenne-lpp.svg?style=flat-square)](https://packagist.org/packages/jalallinux/cayenne-lpp)
<!--delete-->
---
This library can encode and decode data stream for LoraWan and SigFox devices which use Cayenne LPP encoding.




## Installation

You can install the package via composer:

```bash
composer require jalallinux/cayenne-lpp
```




## Usage

### Encoder
```php
$encoder = new Encoder();
$encoder->addTemperature(0, 23.0)
    ->addTemperature(1, 16.0)
    ->addAccelerometer(4, 43.53);

$buffer = $encoder->getBuffer();
$size = $encoder->getSize();
```

### Decoder
```php

```




## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.




## Credits

- [JalalLinuX](https://github.com/jalallinux)
- [All Contributors](../../contributors)




## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
