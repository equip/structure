<?php

namespace Equip\Structure\Traits;

trait CanIterate /* implements Iterator */
{
    public function current()
    {
        return current($this->values);
    }

    public function key()
    {
        return key($this->values);
    }

    public function next()
    {
        next($this->values);
    }

    public function rewind()
    {
        reset($this->values);
    }

    public function valid()
    {
        $key = $this->key();
        return isset($this->values[$key]);
    }
}
