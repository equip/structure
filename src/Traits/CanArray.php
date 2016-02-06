<?php

namespace Equip\Structure\Traits;

trait CanArray /* implements StructureInterface */
{
    public function toArray()
    {
        return $this->values;
    }
}
