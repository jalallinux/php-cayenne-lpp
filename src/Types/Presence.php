<?php

namespace JalalLinuX\CayenneLpp\Types;

const LPP_PRESENCE = 102;
const LPP_PRESENCE_SIZE = 3;

trait Presence
{
    public function addPresence(int $channel, bool $value): self
    {
        $this->addData($channel, LPP_PRESENCE, [
            (int) $value,
        ]);

        return $this;
    }

    public function decodePresence(string $bin): array
    {
        return [
            'value' => bin2hex($bin) === '01',
        ];
    }

    public function getPresenceLPPType(): int
    {
        return LPP_PRESENCE;
    }

    public function getPresenceLPPSize(): int
    {
        return LPP_PRESENCE_SIZE;
    }
}
