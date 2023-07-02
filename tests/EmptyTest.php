<?php declare(strict_types=1);

namespace JalalLinuX\CayenneLpp\Tests;

use JalalLinuX\CayenneLpp\Encoder;
use JalalLinuX\CayenneLpp\Decoder;

use PHPUnit\Framework\TestCase;

class EmptyTest extends TestCase
{
    public function testCreateEncoder()
    {
        $lpp = new Encoder;
        $this->assertInstanceOf(Encoder::class, $lpp);
    }

    public function testCreateDecoder()
    {
        $lpp = new Decoder('');
        $this->assertInstanceOf(Decoder::class, $lpp);
    }
}