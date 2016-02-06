<?php

namespace Equip\Structure\Traits;

trait CanSerializeJson /* implements JsonSerializable */
{
    /**
     * @see \Equip\Structure\Traits\CanArray
     */
    abstract public function toArray();

    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
