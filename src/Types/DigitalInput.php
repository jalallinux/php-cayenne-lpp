<?php

namespace JalalLinuX\CayenneLpp\Types;

const LPP_DIGITAL_INPUT = 0;
const LPP_DIGITAL_INPUT_SIZE = 3;

trait DigitalInput
{
    public function addDigitalInput(int $channel, bool $value): self
    {
        $this->addData($channel, LPP_DIGITAL_INPUT, [
            (int) $value,
        ]);

        return $this;
    }

    public function decodeDigitalInput(string $bin): array
    {
        return [
            'value' => bin2hex($bin) === '01',
        ];
    }

    public function getDigitalInputLPPType(): int
    {
        return LPP_DIGITAL_INPUT;
    }

    public function getDigitalInputLPPSize(): int
    {
        return LPP_DIGITAL_INPUT_SIZE;
    }
}
