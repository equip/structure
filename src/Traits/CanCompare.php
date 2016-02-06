<?php

namespace Equip\Structure\Traits;

use Equip\Structure\StructureInterface;

trait CanCompare
{
    public function isSimilar(StructureInterface $target)
    {
        return $target instanceof self;
    }
}
