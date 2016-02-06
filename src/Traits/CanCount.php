<?php

namespace Equip\Structure\Traits;

trait CanCount /* implements Countable */
{
    public function count()
    {
        return count($this->values);
    }
}
