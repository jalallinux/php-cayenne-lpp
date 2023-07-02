<?php

namespace JalalLinuX\CayenneLpp\Types;

const LPP_DIGITAL_OUTPUT = 1;
const LPP_DIGITAL_OUTPUT_SIZE = 3;

trait DigitalOutput
{
    public function addDigitalOutput(int $channel, bool $value): self
    {
        $this->addData($channel, LPP_DIGITAL_OUTPUT, [
            (int) $value,
        ]);

        return $this;
    }

    public function decodeDigitalOutput(string $bin): array
    {
        return [
            'value' => bin2hex($bin) === '01',
        ];
    }

    public function getDigitalOutputLPPType(): int
    {
        return LPP_DIGITAL_OUTPUT;
    }

    public function getDigitalOutputLPPSize(): int
    {
        return LPP_DIGITAL_OUTPUT_SIZE;
    }
}
