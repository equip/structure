<?php

namespace Destrukt\Traits;

trait CanArray /* implements StructureInterface */
{
    public function toArray()
    {
        return $this->values;
    }
}
