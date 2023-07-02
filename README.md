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
$encoder->addAnalogInput(2, 4.2)
    ->addRelativeHumidity(3, 32.0)
    ->addTemperature(4, 28.7)
    ->addBarometricPressure(5, 851.3)
    ->addAnalogOutput(6, 4.45);

$hex = bin2hex($encoder->getBuffer());
/**
 * RESULT
 * 020201a40368400467011f05732141060301bd
 */
```

### Decoder
```php
$decoder = new Decoder(hex2bin('020201a40368400467011f05732141060301bd'));
$data = $decoder->data;
/**
 * RESULT
 * [
 *  0 => [
 *    "channel" => 2
 *    "type" => 2
 *    "typeName" => "analogInput"
 *    "data" => [
 *      "value" => 4.2
 *    ]
 *  ]
 *  1 => [
 *    "channel" => 3
 *    "type" => 104
 *    "typeName" => "humidity"
 *    "data" => [
 *      "value" => 32.0
 *    ]
 *  ]
 *  2 => [
 *    "channel" => 4
 *    "type" => 103
 *    "typeName" => "temperature"
 *    "data" => [
 *      "value" => 28.7
 *    ]
 *  ]
 *  3 => [
 *    "channel" => 5
 *    "type" => 115
 *    "typeName" => "pressure"
 *    "data" => [
 *      "value" => 851.3
 *    ]
 *  ]
 *  4 => [
 *    "channel" => 6
 *    "type" => 3
 *    "typeName" => "analogOutput"
 *    "data" => [
 *      "value" => 4.45
 *   ]
 * ]
 */
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
