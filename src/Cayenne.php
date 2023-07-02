<?php

namespace JalalLinuX\CayenneLpp;

class Cayenne
{
    public function encoder(): Encoder
    {
        return new Encoder();
    }
    public function decoder(string $payload): Decoder
    {
        return new Decoder($payload);
    }
}
