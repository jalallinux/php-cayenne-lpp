<?php

namespace JalalLinuX\CayenneLpp\Tests;

use JalalLinuX\CayenneLpp\Decoder;
use JalalLinuX\CayenneLpp\Encoder;
use PHPUnit\Framework\TestCase;

class HelperTest extends TestCase
{
    public function testDecoder()
    {
        $decoder = cayenne()->decoder(hex2bin('000001'.'010000'.'020000'.'030001'));
        $this->assertInstanceOf(Decoder::class, $decoder);
    }

    public function testEncoder()
    {
        $encoder = cayenne()->encoder();
        $encoder->addDigitalInput(0, true);
        $encoder->addDigitalInput(1, false);
        $encoder->addDigitalInput(2, false);
        $encoder->addDigitalInput(3, true);

        $this->assertInstanceOf(Encoder::class, $encoder);
    }
}
