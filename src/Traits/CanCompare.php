<?php

namespace Destrukt\Traits;

use Destrukt\StructureInterface;

trait CanCompare
{
    public function isSimilar(StructureInterface $target)
    {
        return $target instanceof self;
    }
}
