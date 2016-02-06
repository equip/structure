<?php

namespace Destrukt\Traits;

trait CanCount /* implements Countable */
{
    public function count()
    {
        return count($this->values);
    }
}
