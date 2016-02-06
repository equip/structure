<?php

namespace Destrukt\Traits;

trait CanSerializeJson /* implements JsonSerializable */
{
    /**
     * @see \Destrukt\Traits\CanArray
     */
    abstract public function toArray();

    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
