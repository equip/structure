<?php

namespace Equip\Structure\Traits;

use Equip\Structure\ImmutableException;

trait CanAccess /* implements ArrayAccess */
{
    public function offsetExists($offset)
    {
        return isset($this->values[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->values[$offset];
    }

    public function offsetSet($offset, $value)
    {
        throw ImmutableException::cannotModify(get_class($this));
    }

    public function offsetUnset($offset)
    {
        throw ImmutableException::cannotModify(get_class($this));
    }
}
