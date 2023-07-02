<?php

namespace JalalLinuX\CayenneLpp;

class Raw implements \Countable
{
    private int $channel;
    private int $type;
    private EnumCayenneName $typeName;
    private array $data;

    public function __construct(int $channel, int $type, string $typeName, array $data)
    {
        $this->channel = $channel;
        $this->type = $type;
        $this->typeName = EnumCayenneName::from($typeName);
        $this->data = $data;
    }

    public function channel(): int
    {
        return $this->channel;
    }

    public function type(): int
    {
        return $this->type;
    }

    public function typeName(): EnumCayenneName
    {
        return $this->typeName;
    }

    public function data(): array
    {
        return $this->data;
    }

    public function count(): int
    {
        return count($this->data);
    }

    public function toArray(): array
    {
        return [
            'channel' => $this->channel,
            'type' => $this->type,
            'typeName' => $this->typeName,
            'data' => $this->data,
        ];
    }
}
