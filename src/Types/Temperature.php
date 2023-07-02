<?php

namespace JalalLinuX\CayenneLpp\Types;

const LPP_TEMPERATURE = 103;
const LPP_TEMPERATURE_SIZE = 4;

trait Temperature
{
    public function addTemperature(int $channel, float $value): self
    {
        if ($value > 6553.5) {
            throw new Exception('Value is too big to be encoded in Temperature (max = 6553.5)');
        }

        $value = round($value * 10);

        $this->addData($channel, LPP_TEMPERATURE, [
            ($value >> 8) & 0xFF,
            $value & 0xFF,
        ]);

        return $this;
    }

    public function decodeTemperature(string $bin): array
    {
        if ($this->isLittleEndian()) {
            $bin = $this->swap16($bin);
        }

        $t = unpack('s', $bin)[1];

        return [
            'value' => 0.1 * $t,
        ];
    }

    public function getTemperatureLPPType(): int
    {
        return LPP_TEMPERATURE;
    }

    public function getTemperatureLPPSize(): int
    {
        return LPP_TEMPERATURE_SIZE;
    }
}
