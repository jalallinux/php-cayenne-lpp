<?php

namespace JalalLinuX\CayenneLpp\Types;

const LPP_ANALOG_INPUT = 2;
const LPP_ANALOG_INPUT_SIZE = 4;

trait AnalogInput
{
    public function addAnalogInput(int $channel, float $value): self
    {
        if ($value > 655.35) {
            throw new Exception('Value is too big to be encoded in AnalogInput (max = 655.35)');
        }

        $value = round($value * 100);

        $this->addData($channel, LPP_ANALOG_INPUT, [
            ($value >> 8) & 0xFF,
            $value & 0xFF,
        ]);

        return $this;
    }

    public function decodeAnalogInput(string $bin): array
    {
        if ($this->isLittleEndian()) {
            $bin = $this->swap16($bin);
        }

        $v = unpack('s', $bin)[1];

        return [
            'value' => 0.01 * $v,
        ];
    }

    public function getAnalogInputLPPType(): int
    {
        return LPP_ANALOG_INPUT;
    }

    public function getAnalogInputLPPSize(): int
    {
        return LPP_ANALOG_INPUT_SIZE;
    }
}
