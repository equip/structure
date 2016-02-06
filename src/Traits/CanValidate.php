<?php

namespace Equip\Structure\Traits;

trait CanValidate
{
    /**
     * @throws \Equip\Structure\StructureException
     *  If the array is not usable for this structure.
     *
     * @param array $values
     *
     * @return void
     */
    abstract protected function assertValid(array $values);
}
